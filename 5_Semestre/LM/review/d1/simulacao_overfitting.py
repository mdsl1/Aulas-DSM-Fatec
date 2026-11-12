"""
    O PRINCIPAL PRO DIA DE HOJE É ENTENDER A DIFERENÇA ENTRE DECORAR E APRENDER:

    - O Objetivo da Generalização: O objetivo central do aprendizado de máquina não é apenas memorizar os exemplos de treinamento, mas sim construir um modelo que funcione bem em dados futuros e desconhecidos[cite: 2]. A generalização é a habilidade de inferir a classificação de novas instâncias não observadas.
    
    - Overfitting (Sobreajuste): Ocorre quando um modelo se ajusta tão bem aos dados de treinamento (decorando ruídos e peculiaridades) que sua precisão em dados novos diminui[cite: 2]. É como um aluno com "alta expressividade" que decora até o número da página do livro, mas erra a questão da prova se mudarem uma vírgula[cite: 1, 3].
    
    - Otimismo da Amostra (Viés de Estimativa): O erro calculado durante o treino é sempre uma estimativa otimista do erro real, pois a hipótese foi escolhida justamente para se ajustar àqueles dados específicos[cite: 2, 3].
    
    - Divisão de Dados (Treino vs Teste): Para obter uma estimativa verdadeira (não enviesada) da precisão futura, é estritamente necessário testar o modelo em um conjunto de exemplos independentes que ele nunca viu antes[cite: 2, 3].
        * Conjunto de Treino: Os dados usados pelo algoritmo para buscar a melhor hipótese no espaço de hipóteses[cite: 1, 2].
        * Conjunto de Teste: A parcela de dados guardada no "cofre" (nunca mostrada ao modelo) para simular o mundo real e avaliar o erro verdadeiro de generalização[cite: 1, 2, 3].

    ** Este código simula a catástrofe do Overfitting: a hipótese h1 tem 0% de erro no treino (decorou tudo), mas tem um erro terrível no teste (a realidade) **
"""

import numpy as np

# 1. A Experiência Total: 1 e-mails reais (0 = Não Spam, 1 = Spam)
dados_reais = np.random.randint(0, 2, size=1000)

# 2. A DIVISÃO DOS DADOS (O "Cofre")
# Separamos os primeiros 800 e-mails para TREINO e os 200 restantes para TESTE
y_treino = dados_reais[:800]
y_teste = dados_reais[800:]

# 3. Simulando as previsões de uma hipótese (h1) que sofreu OVERFITTING
# No treino, ela "decorou" os dados perfeitamente e acertou tudo (Copiamos o gabarito)
h1_previsoes_treino = y_treino.copy()

# Simulando as previsões de uma hipótese (h2) normal sem overfitting
# Ela tenta aprender, mas comete erros normais durante o treino
h2_previsoes_treino = np.random.randint(0, 2, size=800)


# Mas no teste (dados novos), como a h1 não aprendeu a lógica real (apenas memorizou o treino), ela só "chuta" aleatoriamente
y_real_teste = np.random.randint(0, 2, size=200)

# 4. A Performance (P): Função de Erro
def calcular_erro(y_true, y_pred):
    erros = (y_true != y_pred)
    return np.mean(erros)

# Medindo a diferença entre as avaliações no mundo fictício do treino e no mundo real do teste
erro_treino_h1 = calcular_erro(y_treino, h1_previsoes_treino)
erro_treino_h2 = calcular_erro(y_treino, h2_previsoes_treino)

# Avaliando a hipótese h1 no conjunto de teste (onde a máscara cai)
erro_teste = calcular_erro(y_teste, y_real_teste)

print("--- AVALIAÇÃO DAS HIPÓTESES ---")
print(f"Erro no Conjunto de Treino da h1: {erro_treino_h1:.4f} (Com overfitting - Ilusão de que é perfeita)")
print(f"Erro no Conjunto de Treino da h2: {erro_treino_h2:.4f} (Sem overfitting - Aprendizado real)")
print(f"Erro no Conjunto de Teste da h1:  {erro_teste:.4f} (A realidade - Erra quase metade porque não sabe generalizar)")