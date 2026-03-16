const express = require("express");

const app = express();
app.use(express.json());

const porta = 3000;

// Rota raiz
app.get("/", (requisição, resposta) => {
    resposta.send(`
        <html>
            <head>
                <title>Minha API</title>
                <meta charset="UTF-8">
                <style>
                    th, td {
                        padding: 1rem;
                    }
                </style>
            </head>
            <body style="display: flex; flex-flow: column nowrap; justify-content: center; align-items: center; height: 100vh;">
                <h1 style="text-align: center;">Bem-vindo(a) à minha API! Acesse os dados em:</h1>
                <table border="1" style="margin-top: 20px;">
                    <tr>
                        <th>Rota</th>
                        <th>Descrição</th>
                    </tr>
                    <tr>
                        <td>/api/produtos</td>
                        <td>Retorna uma lista de produtos em formato JSON.</td>
                    </tr>
                    <tr>
                        <td>/api/clientes</td>
                        <td>Retorna uma lista de clientes em formato JSON.</td>
                    </tr>
                    <tr>
                        <td>/api/postagens</td>
                        <td>Retorna uma lista de postagens em formato JSON.</td>
                    </tr>
                    <tr>
                        <td>/api/postagens/<i>num_id</i></td>
                        <td>Retorna uma postagem específica pelo ID.</td>
                    </tr>
                    <tr>
                        <td>/api/postagens (POST)</td>
                        <td>Cria uma nova postagem. Requer um corpo JSON com os campos "autor", "assunto" e "conteudo".</td>
                    </tr>
                </table>
            </body>
        </html>    
        `);
});

// ROTAS DE PRODUTOS

// Aqui são diferentes formas de criar objetos em JavaScript
// Declaramos um objeto produto vazio
let produto = {};

// Adicionamos atributos (campos) ao objeto
produto.id = 1;
produto.nome = "Impressora HP Deskjet ";
produto.descricao = "Impressora jato de tinta, multifuncional, com Wi-Fi integrado.";
produto.preco = 349.99;
produto.img = "https://pin.it/6ldmvWiQ6";

// Criamos um segundo objeto produto, dessa vez inserindo os valores direto na chave
let produto2 = {
    id: 2,
    nome: "Notebook Vaio Fe16",
    descricao: "Notebook com processador Ryzen 5, 16GB de RAM e 256GB SSD.",
    preco: 3200.99,
    img: "https://pin.it/6vYlyikhV"
};

// Juntamos os 2 produtos em um array
let produtos = [produto, produto2];

// Rota para retornar um produto
app.get("/api/produtos", (requisição, resposta) => {    
    // Retornamos os produtos em formato JSON, o colchete indica uma lista/ array
    resposta.json([produtos]);
});

// Rota para retornar um produto específico pelo ID
app.get("/api/produtos/:id", (requisição, resposta) => {
    const produto = produtos.find(produto => produto.id === parseInt(requisição.params.id));

    if(!produto) {
        resposta.status(404).json({ "erro": "Produto não encontrado" });
    }
    else {
        resposta.json(produto);
    }
});

// Rota para adicionar um produto
app.post("/api/produtos", (requisição, resposta) => {
    const dadosProduto = requisição.body;

    const newProduto = {
        id: produtos.length + 1,
        nome: dadosProduto.nome,
        descricao: dadosProduto.descricao,
        preco: dadosProduto.preco,
        img: dadosProduto.preco
    };

    produtos.push(newProduto);
    resposta.status(201).json(newProduto);
});

// Rota para deletar um produto
app.delete("/api/produtos/:id", (requisição, resposta) => {
    const indice = produtos.findIndex((produto) => produto.id === parseInt(requisição.params.id));

    if(indice < 0) {
        resposta.status(404).json({ "erro": "Produto não encontrado." });
    }
    else {
        produtos.splice(indice,1);
        resposta.status(200).json({ "mensagem": "Produto excluido com sucesso." })
    }
});

// Rota para modificar completamente um produto pelo id
app.put("/api/produtos/:id", (requisição, resposta) => {
    const indice = produtos.findIndex((produto) => produto.id === parseInt(requisição.params.id));

    if(indice <0 ) {
        resposta.status(404).json({ "erro": "Produto inexistente"})
    }
    else {
        let produtoAlterado = {
            id: requisição.body.id,
            nome: requisição.body.nome,
            descricao: requisição.body.descricao,
            preco: requisição.body.preco,
            img: requisição.body.img
        };

        produtos[indice] = produtoAlterado;
        resposta.status(200).json({ "mensagem": "Produto alterado com sucesso." });
    }
});

// ROTAS DE CLIENTES

// Array com os clientes
let clientes = [
    {
        id: 1,
        cpf: "123.456.789-00",
        nome: "Tututu Sahur",
        endereco: {
            rua: "Rua das Flores",
            bairro: "Jardim das Rosas",
            numero: 123,
            cep: "12345-678",
            cidade: "São Paulo",
            estado: "SP"
        }
    },
    {
        id: 2,
        cpf: "987.654.321-00",
        nome: "Tralahero Tralalla",
        endereco: {
            rua: "Avenida das Árvores",
            bairro: "Floresta Verde",
            numero: 456,
            cep: "87654-321",
            cidade: "Rio de Janeiro",
            estado: "RJ"
        }
    },
    {
        id: 3,
        nome: "Fulano D. Town",
        cpf: "111.222.333-44",
        endereco: {
            rua: "Rua do Sol",
            bairro: "Luz do Dia",
            numero: 789,
            cep: "11223-445",
            cidade: "Belo Horizonte",
            estado: "MG"
        }
    }
];

// Rota para retornar os clientes
app.get("/api/clientes", (requisição, resposta) => {
    resposta.json(clientes);
});

// Rota para retornar um cliente específico pelo ID
app.get("/api/clientes/:id", (requisição, resposta) => {
    const cliente = clientes.find(cliente => cliente.id === parseInt(requisição.params.id));

    if(!cliente) {
        resposta.status(404).json({ "erro": "Cliente não encontrado." });
    }
    else {
        resposta.json(cliente);
    }
});

// Rota para adicionar um cliente
app.post("/api/clientes", (requisição, resposta) => {
    const dadosCliente = requisição.body;

    if(!dadosCliente.nome || !dadosCliente.cpf || !dadosCliente.endereco) {
        resposta.status(400).json({ erro: "Nome, CPF e endereço são obrigatórios." });
        return;
    }

    const newCliente = {
        id: dadosCliente.length + 1,
        nome: dadosCliente.nome,
        cpf: dadosCliente.cpf,
        endereco: {
            rua: dadosCliente.endereco.rua,
            bairro: dadosCliente.endereco.bairro,
            numero: dadosCliente.endereco.numero,
            cep: dadosCliente.endereco.cep,
            cidade: dadosCliente.endereco.cidade,
            estado: dadosCliente.endereco.estado
        }
    };

    clientes.push(newCliente);
    resposta.status(201).json(newCliente);
});

app.put("/api/clientes/:id", (req, res) => {
    const indice = clientes.findIndex((cliente) => cliente.id === parseInt(req.params.id));
    const dadosCliente = req.body;

    if(indice < 0) {
        res.status(404).json({ "erro": "Cliente não encontrado."});
    }
    else {
        let clienteAlterado = {
            id: dadosCliente.length + 1,
            nome: dadosCliente.nome,
            cpf: dadosCliente.cpf,
            endereco: {
                rua: dadosCliente.endereco.rua,
                bairro: dadosCliente.endereco.bairro,
                numero: dadosCliente.endereco.numero,
                cep: dadosCliente.endereco.cep,
                cidade: dadosCliente.endereco.cidade,
                estado: dadosCliente.endereco.estado
            }
        };

        clientes[indice] = clienteAlterado;
        res.status(201).json({ "mensagem": "Cliente alterado com sucesso"});
    }
})

// Rota para deletar um cliente pelo ID
app.delete("/api/clientes/:id", (requisição, resposta) => {
    const indice = clientes.findIndex((cliente) => cliente.id === parseInt(requisição.params.id));

    if(indice < 0) {
        resposta.status(404).json({ "erro": "Cliente não encontrado." });
    }
    else {
        clientes.splice(indice, 1);
        resposta.status(200).json({ "mensagem": "Cliente excluido com sucesso."});
    }
});


// ROTAS DE POSTAGENS

// Array para armazenar as postagens
let postagens = [
    {
        id: 1,
        autor: "Fulano D. Town",
        assunto: "Dicas de programação",
        conteudo: "Aqui estão algumas dicas para melhorar suas habilidades de programação...",
        timedate_postagem: "19/09/2025, 10:30:00",
        curtidas: 150
    },
    {
        id: 2,
        autor: "Bombardeiro Bombardinno",
        assunto: "Novidades em tecnologia",
        conteudo: "Confira as últimas novidades e tendências no mundo da tecnologia...",
        timedate_postagem: "20/09/2025, 14:45:00",
        curtidas: 200
    },
    {
        id: 3,
        autor: "Fulana Da Silva",
        assunto: "Viagem dos sonhos",
        conteudo: "Compartilhando minha experiência incrível em uma viagem dos sonhos...",
        timedate_postagem: "21/09/2025, 09:15:00",
        curtidas: 300
    }
];

// Rota para retornar as postagens
app.get("/api/postagens", (requisição, resposta) => {
    // Retorna as postagens no array
    resposta.json(postagens);
});

// Rota para retornar uma postagem específica pelo ID
app.get("/api/postagens/:id", (requisição, resposta) => {
    // Capturamos o ID da postagem dos parâmetros da URL
    const id = parseInt(requisição.params.id);

    // Procuramos a postagem com o ID correspondente no array
    const postagem = postagens.find(p => p.id === id);

    // Se a postagem não for encontrada, retornamos um erro 404
    if(!postagem) {
        resposta.status(404).json({ erro: "Postagem não encontrada." });
    }
    // Caso contrário, retornamos a postagem encontrada
    else {
        resposta.json(postagem);
    }
});

// Rota para criar uma nova postagem
app.post("/api/postagens", (requisição, resposta) => {
    // Recebe os dados do corpo da requisição
    const dadosPostagem = requisição.body;

    // Se algum campo obrigatório estiver vazio, retorna erro
    if(!dadosPostagem.autor || !dadosPostagem.assunto || !dadosPostagem.conteudo) {
        resposta.status(400).json({ erro: "Autor, assunto e conteúdo são obrigatórios." });
        return;
    }

    // Cria a nova postagem com os dados recebidos
    const newPostagem = {
        id: postagens.length + 1,
        autor: dadosPostagem.autor,
        assunto: dadosPostagem.assunto,
        conteudo: dadosPostagem.conteudo,
        timedate_postagem: new Date().toLocaleString("pt-BR"),
        curtidas: 0
    };

    // Adiciona a nova postagem ao array
    postagens.push(newPostagem);
    // Retorna a nova postagem criada com status 201 (Criado)
    resposta.status(201).json(newPostagem);
});

// Rota para deletar uma postagem pelo ID
app.delete("/api/postagens/:id", (requisição, resposta) => {
    const indice = postagens.findIndex((postagem) => postagem.id === parseInt(requisição.params.id));

    if(indice < 0) {
        resposta.status(404).json({ "erro": "Postagem não encontrada." });
    }
    else {
        postagens.splice(indice, 1);
        resposta.status(200).json({ "mensagem" : "Postagem excluida com sucesso."});
    }
});



app.listen(porta, () => {
    console.log("Servidor rodando em 127.0.0.1:" + porta + ". Aguardando por conexões...");
});