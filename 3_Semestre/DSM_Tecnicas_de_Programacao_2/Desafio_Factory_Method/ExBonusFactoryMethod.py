from abc import ABC, abstractmethod

# PASSO 1 e 2: INTERFACE E CLASSES DE PRODUTO

# A Interface Comum de Produto (classe abstrata)
class Produto(ABC):
    @abstractmethod
    def exibir_informacoes(self):
        pass

# Produto Concreto
class Eletronico(Produto):
    def __init__(self, nome: str, numero_serie: str):
        self.nome = nome
        self.numero_serie = numero_serie

    def exibir_informacoes(self):
        print(f"Eletrônico: {self.nome}, Número de Série: {self.numero_serie}")

# Produto Concreto
class Roupa(Produto):
    def __init__(self, nome: str, tamanho: str, cor: str):
        self.nome = nome
        self.tamanho = tamanho
        self.cor = cor

    def exibir_informacoes(self):
        print(f"Roupa: {self.nome}, Tamanho: {self.tamanho}, Cor: {self.cor}")

# Produto Concreto
class Alimento(Produto):
    def __init__(self, nome: str, data_validade: str):
        self.nome = nome
        self.data_validade = data_validade

    def exibir_informacoes(self):
        print(f"Alimento: {self.nome}, Data de Validade: {self.data_validade}")


# PASSO 3: IMPLEMENTAR A FACTORY

# Essa é a Factory Abstrata que cria de fato os produtos
class ProdutoFactory(ABC):
    # Função que cria os produtos (Factory Method), com base nas subclasses dos produtos
    @abstractmethod
    def criar_produto(self, **kwargs) -> Produto:
        pass

    def registrar_no_pedido(self, **kwargs) -> Produto:
        produto = self.criar_produto(**kwargs)
        print(f"Produto '{produto.nome}' adicionado com sucesso!")
        return produto


# Cada factory é especialista em criar um tipo específico de produto.
# Utiliza do Factory Method para criar Eletrônicos
class EletronicoFactory(ProdutoFactory):
    def criar_produto(self, **kwargs) -> Produto:
        return Eletronico(nome=kwargs.get('nome'), numero_serie=kwargs.get('numero_serie'))

# Utiliza do Factory Method para criar Roupas
class RoupaFactory(ProdutoFactory):
    def criar_produto(self, **kwargs) -> Produto:
        return Roupa(nome=kwargs.get('nome'), tamanho=kwargs.get('tamanho'), cor=kwargs.get('cor'))

# Utiliza do Factory Method para criar Alimentos
class AlimentoFactory(ProdutoFactory):
    def criar_produto(self, **kwargs) -> Produto:
        return Alimento(nome=kwargs.get('nome'), data_validade=kwargs.get('data_validade'))


# PASSO 4: SIMULAR O SISTEMA DE PEDIDOS

# O cliente usa a factory para criar e registrar produtos sem se preocupar com os detalhes de implementação
def simular_sistema(factory: ProdutoFactory, **kwargs):
    produto = factory.registrar_no_pedido(**kwargs)
    return produto

# Exemplo de uso do sistema
if __name__ == "__main__":
    # Cria um array para armazenar os produtos do pedido
    pedido = []
    print("\n--- Sistema de Pedidos Online ---")

    # O cliente decide qual factory usar para qual tipo de produto
    print("\n1. Adicionando um eletrônico ao pedido...")
    smartphone = simular_sistema(EletronicoFactory(), nome="Smartphone Xiaomi Redmi Note 12", numero_serie="SN12345ABC")
    pedido.append(smartphone)

    print("\n2. Adicionando uma roupa ao pedido...")
    camiseta = simular_sistema(RoupaFactory(), nome="Camiseta de Algodão", tamanho="M", cor="Preta")
    pedido.append(camiseta)
    
    print("\n3. Adicionando um alimento ao pedido...")
    chocolate = simular_sistema(AlimentoFactory(), nome="Barra de Chocolate", data_validade="31/12/2025")
    pedido.append(chocolate)

    # Exibindo os itens finais no pedido uttilizando o método comum da interface Produto
    print("\n\n--- Itens Finais no Pedido ---")
    for item in pedido:
        item.exibir_informacoes()
    print("----------------------------\n")


# PASSO 5: TESTAR E EXPANDIR

print("\n\n--- Testando a Expansão do Sistema com 'Livro' ---")

# 1. Adicionar a nova classe de produto
class Livro(Produto):
    def __init__(self, nome: str, autor: str):
        self.nome = nome
        self.autor = autor

    def exibir_informacoes(self):
        print(f"Livro: {self.nome}, Autor: {self.autor}")

# 2. Adicionar a nova factory concreta
class LivroFactory(ProdutoFactory):
    def criar_produto(self, **kwargs) -> Produto:
        return Livro(nome=kwargs.get('nome'), autor=kwargs.get('autor'))

# 3. O cliente agora pode usar a nova factory
print("\n4. Adicionando um livro ao pedido...")
livro = simular_sistema(LivroFactory(), nome="Crime e Castigo", autor="Fiodor Dostoiévski")
pedido.append(livro)

print("\n\n--- Pedido Atualizado com o Novo Item ---")
for item in pedido:
    item.exibir_informacoes()
print("----------------------------------------")