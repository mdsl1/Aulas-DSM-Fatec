import 'package:flutter/material.dart';
import 'item.dart';

class TelaLista extends StatefulWidget {
  const TelaLista({super.key});

  @override
  State<StatefulWidget> createState() {
    return _TelaListaState();
  }

}

class _TelaListaState extends State<TelaLista> {

  final List<Item> _lista = itensIniciais;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Lista de Compras"),
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
      ),
      body: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        children: [

          ListView.builder(
            shrinkWrap: true,
            itemCount: _lista.length,
            itemBuilder: (context, index) {
              return ListTile(
                leading: Icon(_lista[index].iscomprado ? Icons.check_box : Icons.check_box_outline_blank),
                title: Text(_lista[index].nome),
                subtitle: Text("Quantidade: ${ _lista[index].qtde }"),
                trailing: IconButton(onPressed: () {
                  setState(() {
                    _lista.removeAt(index);
                  });
                }, icon: Icon(Icons.delete)),
                onTap: () {
                  setState(() {
                    _lista[index].iscomprado = !_lista[index].iscomprado;
                  });
                },
              );
            }
          )

        ],
      ),
    );
  }

}