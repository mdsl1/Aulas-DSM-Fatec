import numpy as np
from sklearn.datasets import fetch_openml
import matplotlib.pyplot as plt

def simCos(v1, v2):
    dotProd = np.dot(v1, v2)
    normV1 = np.linalg.norm(v1)
    normV2 = np.linalg.norm(v2)

    return dotProd / (normV1 * normV2)


def main():
    #Instalar o numpy e o sklearn
    #pip install scikit-learn numpy
    print("Carregando o dataset MNIST...")
    mnist = fetch_openml("mnist_784", version=1, as_frame=False, parser="auto")
    X = mnist.data
    y = mnist.target.astype(np.uint8)


    probe = X[0]
    rotuloProbe = y[0]

    maiorSim = -np.inf
    rotuloMaisSimilar = None
    imagemParecida = None
    for idx, x in enumerate(X[1:]):
        simAtual = simCos(probe, x)
        if simAtual > maiorSim:
            maiorSim = simAtual
            rotuloMaisSimilar = y[idx + 1]
            imagemParecida = x

    fig, axes = plt.subplots(1, 2, figsize=(10, 2))
    ims = [probe, imagemParecida]
    for i in range(len(ims)):
        axes[i].imshow(X[i].reshape(28, 28), cmap='gray')
        axes[i].set_title(f"Label: {y[i]}")
        axes[i].axis('off')
    plt.show()

    # print(f"Shape de X: {X.shape}")
    # print(f"Shape de y: {y.shape}")

    # print("Exibindo algumas imagens do dataset MNIST...")
    # fig, axes = plt.subplots(1, 5, figsize=(10, 2))
    # for i in range(5):
    #     axes[i].imshow(X[i].reshape(28, 28), cmap='gray')
    #     axes[i].set_title(f"Label: {y[i]}")
    #     axes[i].axis('off')
    # plt.show()

if __name__ == "__main__":
    main()