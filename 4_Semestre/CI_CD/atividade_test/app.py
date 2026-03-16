from carrinho import calcular_total, aplicar_desconto

preco = 50
qtde_produto = 3
desconto = 0.3

preco_total = calcular_total(preco, qtde_produto)
preco_final = aplicar_desconto(preco_total, desconto)

print( f"{qtde_produto} produtos comprados ao valor de {preco} cada. Valor total: {preco_total}" )
print( f"Aplicado {(desconto * 100)}% de desconto ao preço, compra sai por R$ {preco_final}." )