import express from "express";
import cors from "cors";
import { conectarBanco } from "./bd/conexao.js";
import { rotasUsuarios } from "./rotas/usuarios.js";

const app = express();
app.use(express.json());
app.use(cors());

// exportamos o objeto app para poder passá-lo à função de criação
// de rotas
export { app };

app.get("/", (req, res) => {
    res.send("Endpoints desta API são /api/usuarios e /api/postagens");
});

rotasUsuarios(app); // inicializamos as rotas para os usuários

try {
    await conectarBanco();
    const PORTA_API = 3000;
    app.listen(PORTA_API);
    console.log("Aguardando conexões à API na porta " + PORTA_API);
} catch (erro) {
    console.log("Erro: " + erro.message);
}