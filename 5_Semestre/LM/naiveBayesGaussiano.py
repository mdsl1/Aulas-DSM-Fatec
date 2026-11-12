import numpy as np, math
from sklearn.datasets import load_iris

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
                    probabilidade_c *= self.calcularProbabilidade(x[j],stat['media'],stat['variancia'])
                posteriores.append(probabilidade_c)
            maiorProb = np.argmax(posteriores)
            previsoes.append(maiorProb)
            todasPosteriores.append(posteriores)
        return np.array(previsoes), np.array(todasPosteriores)

if __name__ == '__main__':
    iris = load_iris()
    X, y = iris.data, iris.target

    model = NaiveBayesGaussiano()
    model.treinar(X, y)

    prevs, posteriores = model.prever(X)
    for i, p in enumerate(prevs):
        print(f"Previsto = {p}; Real = {y[i]}; Posteriores = {posteriores[i]}")