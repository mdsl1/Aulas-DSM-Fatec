import memory_profiler

# Exemplo: Salve o código como 'atividade_flyweight.py'
from memory_profiler import profile

from script import criar_e_usar_com_flyweight, criar_e_usar_sem_flyweight
# ... (Classes e Funções de cima) ...

@profile
def medir_memoria_sem_flyweight(n):
    return criar_e_usar_sem_flyweight(n)

@profile
def medir_memoria_com_flyweight(n):
    return criar_e_usar_com_flyweight(n)

if __name__ == '__main__':
    # Execute o script no terminal com: python -m memory_profiler atividade_flyweight.py
    medir_memoria_sem_flyweight(100000)
    medir_memoria_com_flyweight(100000)