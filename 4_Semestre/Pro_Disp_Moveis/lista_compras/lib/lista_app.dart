import 'package:flutter/material.dart';
import 'package:lista_compras/tela_lista.dart';

class ListaApp extends StatelessWidget {
  const ListaApp({super.key});

  @override
  Widget build (BuildContext context) {
    return MaterialApp(
      title: "Lista de Compras",
      home: TelaLista()
    );
  }
}