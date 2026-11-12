"""
    O PRINCIPAL PRO DIA DE HOJE É ENTENDER A DEFINIÇÃO DE MITCHELL:

    "Todo aprendizado é programável se conseguir isolar 3 variáveis":

    - Tarefa (T): É o que o programa deve fazer. Nesse exemplo, classificar e-mails como "Spam" (1) ou "Não Spam" (0);

    - Medida de Performance (P): É a nota ou métrica que diz se o algoritmo está indo bem ou mal. Nesse caso, é a fração de exemplos classificados incorretamente;

    - Fonte de Experiência (E): São os dados, o ambiente ou o histórico de onde o programa vai extrair o conhecimento. Nesse caso, é um conjunto de dados contendo as etiquetas reais de 1000000 e-mails já catalogados; 

    
    -------------------
    

    - Espaço de Hipoteses (H): É o conjunto completo de hipóteses possíveis que o programa tem permissão para considerar na hora de aprender um conceito. Nesse exemplo, o Espaço de Hipoteses é o cardápio com todas as formas que o modelo poderia encontrar para classificar um e-mail como spam (ex: se o e-mail tiver mais de 3 exclamações "!!!", se o e-mail vier de um remetente com nome contendo "vendas");

    - Hipotese: É uma teoria/chute/palpite de regra que o modelo formula e testa para tentar advinhar a resposta certa pra um problema. Nesse caso, uma hipótese poderia ser uma regra criada pelo modelo de que "se o e-mail tiver mais de 3 exclamações (!!!), é spam".


    ** Esse código é apenas um exercício de treino para o modelo, então não representa como de fato o modelo se sairia com dados reais (dados diferentes dos dados de treinamento) **
"""


# Projeto que resolve o seguinte problema: se email contiver "promoção", mova para o lixo
import numpy as np

# 1. A Experiencia (E): Gera 1 milhão de rótulos reais de e-mails (0 ou 1)
y_real = np.random.randint(0,2, size=1000000)

# 2. As Hipoteses (H) (h1 e h2): Simulando as previsões das duas hipoteses do nosso espaço de hipoteses
h1_preds = np.random.randint(0, 2, size=1000000)
h2_preds = np.random.randint(0, 2, size=1000000)
h3_preds = np.random.randint(0, 2, size=1000000)


# 3. A Performance (P): Função pra calcular o erro
def calcular_erro_amostra(y_true, y_pred):
    # Vetorização: O numpy compara todos os 1000000 elementos de uma vez só
    erros = (y_true != y_pred)

    # Retorna a fração de erros (A medida P)
    return np.mean(erros)

# Medindo quem foi melhor
erro_h1 = calcular_erro_amostra(y_real, h1_preds)
erro_h2 = calcular_erro_amostra(y_real, h2_preds)
erro_h3 = calcular_erro_amostra(y_real, h3_preds)

print(f"Desempenho P (Erro) da Hipótese h1: {erro_h1:.4f}")
print(f"Desempenho P (Erro) da Hipótese h2: {erro_h2:.4f}")
print(f"Desempenho P (Erro) da Hipótese h3: {erro_h3:.4f}")