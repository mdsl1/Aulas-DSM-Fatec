import 'package:flutter/material.dart';

class Calculadora extends StatefulWidget {
  @override
  State<StatefulWidget> createState() {
    return _CalculadoraState();
  }
}
// ÷×-+
class _CalculadoraState extends State<Calculadora> {
  var styleBtn = TextStyle(
    fontSize: 22,
    fontWeight: FontWeight.bold
  );
  var _nc1 = TextEditingController();
  var _nc2 = TextEditingController();

  String _resultado = "Resultado";

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [

        Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [

            SizedBox(
              width: 120,
              child: TextField(
                controller: _nc1,
                decoration: InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: "Número 1"
                ),
              ),
            ),

            SizedBox(width: 20),

            SizedBox(
              width: 120,
              child: TextField(
                controller: _nc2,
                decoration: InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: "Número 2"
                )
              )
            )
          ],
        ),

        SizedBox(height: 20,),

        Row(
          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
          children: [

            ElevatedButton(
              onPressed: () {
                setState(() {
                  double n1 = double.tryParse(_nc1.text) ?? 0.0;
                  double n2 = double.tryParse(_nc2.text) ?? 0.0;
                  _resultado = (n1 + n2).toString();
                });
              },
              child: Text("+", style: styleBtn,)
            ),

            ElevatedButton(
              onPressed: () {
                setState(() {
                  double n1 = double.tryParse(_nc1.text) ?? 0.0;
                  double n2 = double.tryParse(_nc2.text) ?? 0.0;
                  _resultado = (n1 - n2).toString();
                });
              }, 
              child: Text("-", style: styleBtn,)
            ),

            ElevatedButton(
              onPressed: () {
                setState(() {
                  double n1 = double.tryParse(_nc1.text) ?? 0.0;
                  double n2 = double.tryParse(_nc2.text) ?? 0.0;

                  _resultado = (n1 * n2).toString();
                });
              }, 
              child: Text("×", style: styleBtn,)
            ),

            ElevatedButton(
              onPressed: () {
                setState(() {
                  double n1 = double.tryParse(_nc1.text) ?? 0.0;
                  double n2 = double.tryParse(_nc2.text) ?? 0.0;
                  
                  if( n2 == 0.0 ) {
                    _resultado = "Erro: Divisão por 0";
                  }
                  else {
                    _resultado = (n1 / n2).toString();
                  }
                });
              },
              child: Text("÷", style: styleBtn,)
            )

          ],
        ),

        SizedBox(height: 20,),

        Text(
          _resultado,
          style: TextStyle(
            fontSize: 32,
            fontWeight: FontWeight.bold
          ),
        )

      ],
    );
  }
}