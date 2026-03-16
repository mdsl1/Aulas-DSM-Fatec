
const express = require("express");

const app = express();

const porta = 3000;

app.get("/", (req, res) => {
    const pagina = `
        <html>
            <head>
                <title>Minha Página</title>
                <meta charset="UTF-8">
            </head>
            <body>
                <h1>Olá, Mundo!</h1>
            </body>
        </html>
    `
    res.send(pagina);
});

app.get("/segredo", (req, res) => {
    res.send("<h1>Esta é a página secreta!</h1>");
});

app.get("/login", (req, res) => {
    const pagina = `
        <html>
            <head>
                <title>Login</title>
                <meta charset="UTF-8">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
            </head>
            <body class="h-100 w-100 d-flex flex-column align-items-center bg-dark justify-content-center">
                <div class="d-flex flex-column align-items-center bg-light gap-4 border rounded-3 p-5">
                    <h1>Faça seu login</h1>
                    <form class="d-flex flex-column align-items-center gap-2">
                        <label for="usuario">Usuário:</label>
                        <input type="text" name="usuario" id="usuario">

                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha">

                        <button class="mt-2 py-2 px-4 border rounded-3">Entrar</button>
                    </form>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            </body>
        </html>
    `
    res.send(pagina);
});

app.listen(porta, () => {
    console.log(`Servidor rodando em http://localhost:${porta}`);
});