import 'package:flutter/material.dart';
import 'package:flutter_application_1/calculadora.dart';

class TelaCalculadora extends StatelessWidget {
  @override
  Widget build ( BuildContext context ) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Usando TextField"),
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
      ),
      body: Center(child: Calculadora())
    );
  } 
}