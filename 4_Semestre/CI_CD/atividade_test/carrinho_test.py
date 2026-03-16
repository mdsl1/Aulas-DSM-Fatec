from carrinho import calcular_total, aplicar_desconto

# Comando pra testar o projeto: pytest -v carrinho_test.py

def test_calcular_total ():
    result = calcular_total(10,3)
    assert result == 30

def test_aplicar_desconto ():
    total = 100
    desconto = 0.1
    result = aplicar_desconto( total, desconto )
    assert result == 90