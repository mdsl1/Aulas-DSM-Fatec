import { conectarBanco } from "./bd/conexao.js";
import { Usuario } from "./modelos/usuario.js";
import { Postagem } from "./modelos/postagem.js";

async function testar() {
    await conectarBanco();

    const novoUsuario = new Usuario({
        username: "querino",
        email: "querino@me.com",
        senha: "1234",
        nome: "Luiz Carlos Querino Filho"
    });

    const usuario = await novoUsuario.save();

    const novaPostagem = new Postagem({
        titulo: "Primeira postagem!",
        conteudo: "Esta é a primeira postagem neste site!",
        autor: usuario,
        tags: ["#novo", "#post"]
    });

    const postagem = await novaPostagem.save();

    const usuarios = await Usuario.find();
    console.log(usuarios);

    const postagens = await Postagem.find();
    console.log(postagens);
}

testar();