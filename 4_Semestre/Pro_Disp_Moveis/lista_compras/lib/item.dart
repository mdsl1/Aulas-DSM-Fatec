class Item {
  String nome;
  int qtde;
  bool iscomprado;

  Item ({
    required this.nome, required this.qtde, required this.iscomprado
  });
}

List<Item> itensIniciais = [
  Item(nome: "Leite Condensado", qtde: 1, iscomprado: false),
  Item(nome: "Creme de Leite", qtde: 1, iscomprado: false),
  Item(nome: "Leite em Pó", qtde: 1, iscomprado: false),
  Item(nome: "Manteiga", qtde: 1, iscomprado: false),
  Item(nome: "Coco Ralado", qtde: 1, iscomprado: false)
];