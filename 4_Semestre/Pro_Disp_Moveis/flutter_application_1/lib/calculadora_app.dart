import 'package:flutter/material.dart';
import 'package:flutter_application_1/tela_calculadora.dart';

class CalculadoraApp extends StatelessWidget {
  @override
  Widget build( BuildContext context ) {
    return MaterialApp(
      title: "Calculadora",
      home: TelaCalculadora()
    );
  }
}