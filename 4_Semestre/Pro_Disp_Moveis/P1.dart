import "package:flutter/material.dart";

void main() {
  runApp(App());
}

class App extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: "Travel Flutter",
      home: TelaDestino(),
      theme: ThemeData(colorScheme: .fromSeed(seedColor: Colors.blueAccent)),
    );
  }
}

class TelaDestino extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: NavBar(),
      body: SingleChildScrollView(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Banner(
              urlImg:
                  "https://media.bookmundi.com/files/uploads/bookmundi/resized/cmsfeatured/places-to-visit-in-switzerland-1732683695-785X440.jpg?width=1536&quality=75",
            ),
            ListaBotoes(),
            Infos(
              nome: "Alpes de Berna, Suiça",
              estrelas: 4.8,
              avaliacoes: 355,
            ),
            Descricao(),
            ListaItensInclusos(
              itens: [
                {"icone": Icons.ac_unit, "texto": "Neve"},
                {"icone": Icons.fireplace, "texto": "Lareira"},
                {"icone": Icons.landscape, "texto": "Vista"},
                {"icone": Icons.coffee, "texto": "Café"},
              ],
            ),
            FinalizarCompra(preco: 115.95),
          ],
        ),
      ),
    );
  }
}

class NavBar extends StatelessWidget implements PreferredSizeWidget {
  @override
  Size get preferredSize => const Size.fromHeight(kToolbarHeight);

  @override
  Widget build(BuildContext context) {
    return AppBar(
      title: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Container(
            child: Row(
              children: [
                Text("Travel", style: TextStyle(color: Colors.white)),
                SizedBox(width: 5),
                Text("Flutter", style: TextStyle(color: Colors.blue)),
              ],
            ),
          ),

          Container(
            child: IconBotao(
              icone: Icons.person,
              cor: Colors.white,
              tamanho: 30.0,
              onClick: () {
                print("Você clicou nas configurações de usuário");
              },
            ),
          ),
        ],
      ),
      backgroundColor: Color(0XFF1f1f1f),
    );
  }
}

class Banner extends StatelessWidget {
  final String urlImg;

  Banner({super.key, required this.urlImg});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.fromLTRB(20, 15, 20, 0),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(15),
        child: Image.network(
          urlImg,
          width: double.infinity,
          height: 300,
          fit: BoxFit.cover,
        ),
      ),
    );
  }
}

class ListaBotoes extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.fromLTRB(0, 2, 30, 10),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.end,
        children: [
          IconBotao(
            icone: Icons.share,
            cor: Colors.black,
            tamanho: 25.0,
            onClick: () {
              print("Você clicou em compartilhar");
            },
          ),
          SizedBox(width: 15),
          IconBotao(
            icone: Icons.favorite,
            cor: Colors.black,
            tamanho: 25.0,
            onClick: () {
              print("Você clicou em favoritar");
            },
          ),
        ],
      ),
    );
  }
}

class Infos extends StatelessWidget {
  final String nome;
  final double estrelas;
  final int avaliacoes;

  Infos({
    super.key,
    required this.nome,
    required this.estrelas,
    required this.avaliacoes,
  });

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.fromLTRB(30, 5, 30, 20),
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: [
              Text(nome, style: TextStyle(fontSize: 25)),
              TextBotao(
                texto: "Ver mapa",
                cor: Colors.blue,
                tamanho: 15.0,
                onClick: () {
                  print("Você clicou em ver mapa");
                },
              ),
            ],
          ),
          Row(
            mainAxisAlignment: MainAxisAlignment.start,
            children: [
              Icon(Icons.star, color: Colors.yellow.shade600, size: 20),
              SizedBox(width: 5),
              Text(
                "${estrelas} (${avaliacoes} avaliações)",
                style: TextStyle(fontSize: 13),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

class Descricao extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.fromLTRB(40, 0, 40, 30),
      child: Column(
        children: [
          Text(
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id turpis eu turpis ultricies gravida. In in rutrum sapien. Fusce at turpis dolor. Quisque elementum libero tincidunt, efficitur ipsum non, tincidunt lacus. Nulla pretium, dolor sit amet viverra tempor, nulla tellus lacinia lacus, vel euismod diam justo at mi. Vestibulum dignissim sem placerat, suscipit libero nec, cursus sapien. Nunc suscipit neque enim, id eleifend arcu elementum in. Phasellus vitae metus sed est feugiat sodales id a nisi. Integer lectus elit, scelerisque a malesuada in, viverra non mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
            textAlign: TextAlign.justify,
            maxLines: 4,
            overflow: TextOverflow.ellipsis,
            style: TextStyle(
              fontSize: 14.0,
              color: Colors.black87,
              height: 1.4,
            ),
          ),
          SizedBox(height: 10),
          Row(
            children: [
              TextBotao(
                texto: "Leia mais",
                cor: Colors.blue,
                tamanho: 15.0,
                onClick: () {
                  print("Você clicou em leia mais");
                },
              ),
              Icon(Icons.keyboard_arrow_down, color: Colors.blue),
            ],
          ),
        ],
      ),
    );
  }
}

class ListaItensInclusos extends StatelessWidget {
  final List<Map<String, dynamic>> itens;

  ListaItensInclusos({super.key, required this.itens});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: EdgeInsets.fromLTRB(40, 0, 40, 30),
      child: Column(
        children: [
          Text("Incluso no Pacote", style: TextStyle(fontSize: 20)),
          SizedBox(height: 13),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: itens.map((item) {
              return Container(
                width: 80,
                height: 80,
                decoration: BoxDecoration(
                  color: Color(0xFF1f1f1f),
                  borderRadius: BorderRadius.circular(15),
                ),
                child: Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(item["icone"], size: 30, color: Colors.blue.shade300),
                    SizedBox(height: 8),
                    Text(
                      item["texto"],
                      style: TextStyle(fontSize: 12, color: Colors.blue),
                    ),
                  ],
                ),
              );
            }).toList(),
          ),
        ],
      ),
    );
  }
}

class FinalizarCompra extends StatelessWidget {
  final double preco;

  FinalizarCompra({super.key, required this.preco});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 10, vertical: 20),
      decoration: BoxDecoration(color: Colors.blue.shade300),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceAround,
        children: [
          Column(
            children: [
              Text("Preço:", style: TextStyle(fontSize: 14)),
              Text(
                "R\$ ${preco}",
                style: TextStyle(fontSize: 17, fontWeight: FontWeight.bold),
              ),
            ],
          ),
          ElevatedButton.icon(
            label: Icon(Icons.arrow_forward),
            icon: Text("Fazer reserva"),
            onPressed: () {
              print("Você clicou em Fazer reserva");
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: Color(0xFF1f1f1f),
              foregroundColor: Colors.blue.shade300,
              padding: EdgeInsets.symmetric(horizontal: 20, vertical: 20),
            ),
          ),
        ],
      ),
    );
  }
}

class IconBotao extends StatelessWidget {
  final IconData icone;
  final Color cor;
  final double tamanho;
  final VoidCallback onClick;

  IconBotao({
    super.key,
    required this.icone,
    required this.cor,
    required this.tamanho,
    required this.onClick,
  });

  @override
  Widget build(BuildContext context) {
    return IconButton(
      icon: Icon(icone, color: cor),
      alignment: Alignment.center,
      iconSize: tamanho,
      onPressed: onClick,
    );
  }
}

class TextBotao extends StatelessWidget {
  final String texto;
  final Color cor;
  final double tamanho;
  final VoidCallback onClick;

  TextBotao({
    super.key,
    required this.texto,
    required this.cor,
    required this.tamanho,
    required this.onClick,
  });

  @override
  Widget build(BuildContext context) {
    return TextButton(
      style: TextButton.styleFrom(
        foregroundColor: cor,
        textStyle: TextStyle(fontSize: tamanho),
      ),
      child: Text(texto),
      onPressed: onClick,
    );
  }
}
