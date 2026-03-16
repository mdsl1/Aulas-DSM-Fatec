import sys
import random
import timeit
from memory_profiler import profile

# --- Implementação SEM Flyweight ---

class CircleSemFlyweight:
    """Objeto que armazena todas as propriedades (cor e raio)."""
    def __init__(self, color: str, radius: int):
        self.color = color  # Propriedade intrínseca duplicada
        self.radius = radius # Propriedade extrínseca

    def draw(self):
        # Apenas para simular a ação
        pass
        # print(f"Drawing a {self.color} circle with radius {self.radius}")

@profile
def criar_e_usar_sem_flyweight(num_objetos):
    """Cria e mede o tamanho dos objetos SEM Flyweight."""
    print("\n--- INÍCIO: Cenário SEM Flyweight ---")
    circles = []
    available_colors = ["Red", "Green", "Blue", "Yellow", "Black"]
    
    # Criando um grande número de objetos
    for _ in range(num_objetos):
        color = random.choice(available_colors)
        radius = random.randint(1, 100)
        circles.append(CircleSemFlyweight(color, radius))
    
    # Cálculo do uso de memória (aproximado)
    tamanho_total = sum(sys.getsizeof(c) + sys.getsizeof(c.color) for c in circles)
    print(f"Total de objetos criados: {len(circles)}")
    print(f"Uso de memória (aproximado) para todos os objetos e suas strings 'color': {tamanho_total / 1024:.2f} KB")
    print("--- FIM: Cenário SEM Flyweight ---\n")
    return circles

# --- Implementação COM Flyweight (Passos 3) ---

class ColorFlyweight:
    """O Flyweight Concreto (a parte intrínseca - compartilhada)."""
    def __init__(self, color: str):
        self.color = color
        # O print abaixo é útil para ver quantas vezes o objeto de cor é realmente criado
        print(f"Flyweight Color criado: {color}") 

    def get_color(self) -> str:
        return self.color

class ColorFactory:
    """A Flyweight Factory (gerencia o cache de Flyweights)."""
    _colors = {}

    @staticmethod
    def get_color(color_name: str) -> ColorFlyweight:
        """Retorna um Flyweight existente ou cria um novo."""
        if color_name not in ColorFactory._colors:
            ColorFactory._colors[color_name] = ColorFlyweight(color_name)
        return ColorFactory._colors[color_name]
    
    @staticmethod
    def get_cache_size():
        return len(ColorFactory._colors)

class CircleComFlyweight:
    """O Contexto (a parte extrínseca - única)."""
    def __init__(self, color_name: str, radius: int):
        # Armazena apenas a REFERÊNCIA para o Flyweight
        self.color_flyweight = ColorFactory.get_color(color_name)
        self.radius = radius # Propriedade extrínseca (única)

    def draw(self):
        # Para desenhar, o objeto extrínseco usa o objeto intrínseco compartilhado
        pass
        # print(f"Drawing a {self.color_flyweight.get_color()} circle with radius {self.radius}")

@profile
def criar_e_usar_com_flyweight(num_objetos):
    """Cria e mede o tamanho dos objetos COM Flyweight."""
    # Resetando a fábrica para a medição
    ColorFactory._colors = {} 
    
    print("\n--- INÍCIO: Cenário COM Flyweight ---")
    circles = []
    available_colors = ["Red", "Green", "Blue", "Yellow", "Black"]

    # Criando o mesmo número de objetos
    for _ in range(num_objetos):
        color = random.choice(available_colors)
        radius = random.randint(1, 100)
        circles.append(CircleComFlyweight(color, radius))

    # Cálculo do uso de memória (aproximado)
    # Aqui, a cor é um objeto Flyweight, precisamos medir o tamanho de todos os objetos Circle E o tamanho dos objetos Flyweight (apenas 5).
    
    tamanho_circulos = sum(sys.getsizeof(c) for c in circles)
    tamanho_flyweights = sum(sys.getsizeof(fw) + sys.getsizeof(fw.color) for fw in ColorFactory._colors.values())
    
    tamanho_total = tamanho_circulos + tamanho_flyweights
    
    print(f"Total de objetos criados (Circle): {len(circles)}")
    print(f"Total de objetos Flyweight (Color) no cache: {ColorFactory.get_cache_size()}")
    print(f"Uso de memória (aproximado) dos objetos Flyweight Color: {tamanho_flyweights / 1024:.2f} KB")
    print(f"Uso de memória (aproximado) dos objetos Circle: {tamanho_circulos / 1024:.2f} KB")
    print(f"Uso de memória (aproximado) TOTAL: {tamanho_total / 1024:.2f} KB")
    print("--- FIM: Cenário COM Flyweight ---\n")
    return circles

if __name__ == "__main__":
    NUM_CIRCLES = 100000  # Aumente este número para ver o impacto de forma mais clara
    
    print(f"--- ATIVIDADE FLYWEIGHT: Comparação de {NUM_CIRCLES} Círculos ---")
    
    # 1. SEM Flyweight
    circles_sem = criar_e_usar_sem_flyweight(NUM_CIRCLES)
    
    # 2. COM Flyweight
    circles_com = criar_e_usar_com_flyweight(NUM_CIRCLES)
    
    # Libera memória (opcional, mas bom para garantir a limpeza)
    del circles_sem
    del circles_com

def run_sem_flyweight(n):
    available_colors = ["Red", "Green", "Blue", "Yellow", "Black"]
    return [
        CircleSemFlyweight(random.choice(available_colors), random.randint(1, 100))
        for _ in range(n)
    ]

def run_com_flyweight(n):
    available_colors = ["Red", "Green", "Blue", "Yellow", "Black"]
    # Certifique-se de que a fábrica esteja limpa antes de cada medição
    ColorFactory._colors = {} 
    return [
        CircleComFlyweight(random.choice(available_colors), random.randint(1, 100))
        for _ in range(n)
    ]

N = 100000

time_sem = timeit.timeit(lambda: run_sem_flyweight(N), number=1)
time_com = timeit.timeit(lambda: run_com_flyweight(N), number=1)

print(f"\n--- ANÁLISE DE TEMPO ---")
print(f"Tempo SEM Flyweight (1 execução): {time_sem:.4f} segundos")
print(f"Tempo COM Flyweight (1 execução): {time_com:.4f} segundos")
# Geralmente o Flyweight pode ser um pouco mais lento devido ao lookup na factory.