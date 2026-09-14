from typing import Union

Numero = Union[int, float]


def soma(a: Numero, b: Numero) -> Numero:
    """Retorna a soma de dois números."""
    return a + b


def subtracao(a: Numero, b: Numero) -> Numero:
    """Retorna a subtração entre dois números."""
    return a - b


def multiplicacao(a: Numero, b: Numero) -> Numero:
    """Retorna a multiplicação entre dois números."""
    return a * b


def divisao(a: Numero, b: Numero) -> Numero:
    """Retorna a divisão entre dois números.

    Levanta:
        ValueError: se o divisor for zero.
    """
    if b == 0:
        raise ValueError("Divisão por zero não é permitida")
    return a / b
