from calculadora.operacoes import soma, subtracao, multiplicacao, divisao

def test_soma():
  assert soma(2,3) == 5

def test_subtracao():
  assert subtracao(5,3) == 2

def test_multiplicacao():
  assert multiplicacao(4,2) == 8

def test_divisao():
  assert divisao(10,2) == 5