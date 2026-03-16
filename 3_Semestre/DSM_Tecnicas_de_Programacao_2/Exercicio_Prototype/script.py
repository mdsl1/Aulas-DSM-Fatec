import copy


# --- CLASSE PROTOTYPE ---
# A classe 'Texto' é o Protótipo. Ela conhece como se clonar.
class Texto:
    # O objeto é inicializado com um conteúdo, sendo ele por padrão uma string vazia.
    def __init__(self, conteudo=""):
        self.conteudo = conteudo

    # Método para adicionar mais texto ao conteúdo existente.
    def adicionar(self, texto):
        self.conteudo += texto

    # --- IMPLEMENTAÇÃO DO PROTOTYPE ---
    # Este é o coração do padrão Prototype. O método 'clone' cria e retorna uma cópia exata e independente deste objeto 'Texto'.
    # O 'copy.deepcopy()' serve para garantir que todos os dados internos (neste caso, a string 'conteudo') também serão copiados.
    def clone(self):
        return copy.deepcopy(self)

    # O método especial __str__ define como o objeto será representado como string.
    # Isso permite usar 'print(objeto_texto)' e ver o conteúdo diretamente.
    def __str__(self):
        return self.conteudo


# --- CLASSE CLIENTE ---
# A classe 'Editor' é o cliente que utiliza o protótipo 'Texto'.
# Ela gerencia o estado atual do texto e o histórico de alterações para o Undo/Redo.
class Editor:
    def __init__(self):
        # 'estado_atual' armazena o objeto 'Texto' que o usuário está editando no momento.
        self.estado_atual = Texto()

        # 'historico' é uma lista que funcionará como uma pilha para a função "Desfazer" (Undo).
        self.historico = []

        # 'futuro' é uma lista que funcionará como uma pilha para a função "Refazer" (Redo).
        self.futuro = []

    # Método chamado quando o usuário digita algo no editor.
    def escrever(self, texto):
        # Antes de modificar o estado atual, ele é clonado e salvo na pilha de histórico.
        # Isso cria um "ponto de salvamento" do estado exato antes da mudança.
        self.historico.append(self.estado_atual.clone())
        
        # Agora sim, é adicionando o novo texto.
        self.estado_atual.adicionar(texto)

    # Método para desfazer a última ação.
    def desfazer(self):
        # Só é possível desfazer se houver algo no histórico.
        if self.historico:
            # Antes de reverter para um estado anterior, o estado atual é salvo na pilha de futuro
            # Isso permite refazer a ação de desfazer.
            self.futuro.append(self.estado_atual.clone())
            
            # O último estado salvo no histórico é restaurado como o estado atual.
            self.estado_atual = self.historico.pop()

    # Método para refazer uma ação que foi desfeita.
    def refazer(self):
        # Só é possível refazer se houver algo na pilha 'futuro'.
        if self.futuro:
            # Antes de avançar para um estado futuro, o estado ATUAL é salvo na pilha de histórico.
            # Isso permite desfazer a ação de refazer.
            self.historico.append(self.estado_atual.clone())
            
            # O último estado da pilha 'futuro' é restaurado como o estado atual.
            self.estado_atual = self.futuro.pop()

    # Define como o objeto Editor será representado como string.
    # Ele simplesmente mostra o conteúdo do estado atual do texto.
    def __str__(self):
        return str(self.estado_atual)


# --- SIMULAÇÃO DE USO ---

# 1. Cria uma nova instância do Editor.
editor = Editor()

# 2. Escreve "Primeira frase. ".
#    - O estado "" é clonado e salvo no histórico.
#    - O estado atual se torna "Primeira frase. ".
editor.escrever("Primeira frase. ")

# 3. Escreve "Segunda frase. ".
#    - O estado "Primeira frase. " é clonado e salvo no histórico.
#    - O estado atual se torna "Primeira frase. Segunda frase. ".
editor.escrever("Segunda frase. ")

# Imprime o estado atual.
print(editor)

# 4. Desfaz a última ação.
#    - O estado atual "Primeira frase. Segunda frase. " é clonado e salvo no 'futuro'.
#    - O estado "Primeira frase. " é pego do histórico e se torna o estado atual.
editor.desfazer()
print(editor)

# 5. Desfaz novamente.
#    - O estado atual "Primeira frase. " é clonado e salvo no 'futuro'.
#    - O estado "" é pego do histórico e se torna o estado atual.
editor.desfazer()
print(editor)

# 6. Refaz a última ação desfeita.
#    - O estado atual "" é clonado e salvo no histórico.
#    - O estado "Primeira frase. " é pego do 'futuro' e se torna o estado atual.
editor.refazer()
print(editor)

# 7. Refaz novamente.
#    - O estado atual "Primeira frase. " é clonado e salvo no histórico.
#    - O estado "Primeira frase. Segunda frase. " é pego do 'futuro' e se torna o estado atual.
editor.refazer()
print(editor)