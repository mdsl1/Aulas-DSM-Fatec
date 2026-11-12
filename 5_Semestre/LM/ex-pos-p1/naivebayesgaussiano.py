import numpy as np
import math
import pandas as pd
from ucimlrepo import fetch_ucirepo

# CLASSE - NAIVE BAYES
class NaiveBayesGaussiano:

    def calcularProbabilidade(self, x, media, variancia):
        eps = 1e-6
        coeficiente = 1 / np.sqrt( 2* np.pi * variancia + eps)
        expoente = np.exp( - (math.pow(x - media, 2) / (2 * variancia + eps)) )
        return coeficiente * expoente

    def treinar(self, X, y):
        self.classes = np.unique(y)
        self.parametros = []

        for c in self.classes:
            X_c = X[y == c]
            stats = []
            for col in X_c.T:
                media = np.mean(col)
                variancia = np.var(col)
                stats.append({
                    'media' : media,
                    'variancia' : variancia
                })

            self.parametros.append({
                'stats' : stats,
                'prior' : len(X_c) / len(X)
            })

    def prever(self, X):
        previsoes = []
        todasPosteriores = []
        for x in X:
            posteriores = []
            for i, c in enumerate(self.classes):
                probabilidade_c = self.parametros[i]['prior']
                for j, stat in enumerate(self.parametros[i]['stats']):
                    # Multiplica as probabilidades individuais de cada característica
                    probabilidade_c *= self.calcularProbabilidade(x[j],stat['media'],stat['variancia'])
                posteriores.append(probabilidade_c)
            
            maiorProb = np.argmax(posteriores)
            
            previsoes.append(self.classes[maiorProb])
            todasPosteriores.append(posteriores)
            
        return np.array(previsoes), np.array(todasPosteriores)


if __name__ == '__main__':
    print("Conectando ao repositório UCI e baixando os dados...")
    metro_dataset = fetch_ucirepo(id=492) 
    df = metro_dataset.data.original
    print("Dataset importado com sucesso!\n")
    
    # Seleção dos dados climáticos do dataset.
    X_df = df[['temp', 'rain_1h', 'snow_1h', 'clouds_all']]
    X = X_df.values
    
    # Transformando o volume numérico (Regressão) em categorias (Classificação)
    print("Convertendo a variável alvo contínua para classes: baixo, médio e alto...")
    y_continuo = df['traffic_volume']
    y_categorico = pd.qcut(y_continuo, q=3, labels=['baixo', 'médio', 'alto'])
    y = np.array(y_categorico)

    # Separação da Base de testes e base de treino
    i_split = int(len(X) * 0.20)
    X_treino = X[i_split:]
    y_treino = y[i_split:]

    X_teste = X[:i_split]
    y_teste = y[:i_split]
    
    # TREINAMENTO DO MODELO
    print("Iniciando o treinamento do modelo Naive Bayes Gaussiano...")
    model = NaiveBayesGaussiano()
    model.treinar(X_treino, y_treino)
    print("Treinamento concluído com sucesso!\n")
    
    # TESTE DO MODELO
    prevs, posteriores = model.prever(X_teste)

    print("--- Resultados das Previsões ---")
    for i, p in enumerate(prevs):
        print(f"Previsto= {p}; Real= {y_teste[i]}; Posteriores= {posteriores[i]}")

    taxa_acerto_geral = np.mean(y_teste == prevs) * 100
    print(f"\nTaxa de acerto Geral= {taxa_acerto_geral:.2f}")

    print("\n--- Percentual de acerto por Classe ---\n")
    for c in np.unique(y_teste):
        indices_classe = (y_teste == c)
        total = np.sum(indices_classe)

        acertos = np.sum(prevs[indices_classe] == y_teste[indices_classe])

        if total > 0:
            taxa_acerto = (acertos / total) * 100
            print(f"Classe= {c}; Taxa de Acerto= {taxa_acerto}")