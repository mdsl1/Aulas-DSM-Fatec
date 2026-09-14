import numpy as np

def sigmoid(x):
    return 1 / (1 + np.exp(-x))

def sigmoidDerivada(x):
    return x * (1 - x)

def mse(yTrue,yPred):
    somatorio = 0
    for i in range(len(yTrue)):
        somatorio += (yTrue[i] - yPred[i])**2

    return somatorio / len(yTrue)

def mseDerivada(yTrue,yPredito):
    return 2 * (yPredito - yTrue) / len(yTrue)

def limiarDuro(z):
    vetRel = []
    for s in z:
        l = None
        if s < 0:
            l = 0
        else:
            l = 1
        vetRel.append(l)
    return np.array(vetRel)

def main():
    X = np.array([
        [0,0],
        [0,1],
        [1,0],
        [1,1]
    ])
    y = np.array([0,0,0,1])

    pesos = np.random.randn(2)
    bias = np.random.randn(1)

    menorMSE = +np.inf

    epocas = 10000
    for i in range(epocas):
        passo = 0.1
        pert = np.random.uniform(-passo,passo,size=2)
        print(f"Tamanho da perturbação = {pert}")
        print(f"Valor dos pesos atuais = {pesos}")
        pCandidato = pesos + pert
        print(f"Valor dos novos pesos (candidatos) = {pCandidato}")        
        bCandidato = bias + np.random.uniform(-passo,passo,size=1)

        z = bCandidato + np.dot(X, pCandidato)
        yPred = limiarDuro(z)

        print(f"Neuronio estimou = {yPred}")
        erroMSE = mse(y,yPred)
        print(f"Erro = {erroMSE}")
        if (erroMSE < menorMSE):
            pesos = pCandidato
            bias = bCandidato
            menorMSE = erroMSE

    print(f"Final====")
    print(f"Pesos = {pesos}")
    print(f"Bias = {bias}")
    print(f"Menor erro = {menorMSE}")

if __name__ == '__main__':
    main()