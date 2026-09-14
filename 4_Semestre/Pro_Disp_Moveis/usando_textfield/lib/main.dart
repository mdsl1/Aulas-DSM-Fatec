import 'package:flutter/material.dart';

void main() {
  runApp(TextFieldApp());
}

class TextFieldApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: "Usando TextField",
      home: Tela()
    );
  }
}

class Tela extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Usando TextField"),
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
      ),
      body: Center(child: Pergunta()),
    );
  }
}

class Pergunta extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _PerguntaState();
  }

}

class _PerguntaState extends State<Pergunta> {

  String _mensagem = "Mensagem original";

  var _nomeController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Text("Qual o seu nome?"),
        SizedBox(height: 20),
        SizedBox(
          width: 250,
          child: TextField(
            controller: _nomeController,
            decoration: InputDecoration(
              border: OutlineInputBorder(),
              labelText: "Seu nome" 
            ),
          )
        ),
        SizedBox(height: 20),
        ElevatedButton(onPressed: () {
          setState(() {
            if (_nomeController.text.isEmpty) {
              _mensagem = "Informe seu nome, arrombado";
            }
            else {
              _mensagem = "Prazer em conhecê-lo(a), ${ _nomeController.text }!";
              _nomeController.text = "";
            }
          });
        }, child: Text("Cumprimentar")),
        SizedBox(height: 20),
        Text(_mensagem)
      ],
    );
  }

}