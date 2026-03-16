// CRUD para as postagens em MongoDB
import { Postagem } from "../modelos/postagem.js";

// C:  Create (Inclusão)
export async function criarPostagem({ titulo, conteudo, autor, tags}) {
    const postagem = new Postagem({ titulo, conteudo, autor, tags });
    return postagem.save();
}

// R: Read (Consulta)
export async function listarPostagens() {
    return await Postagem.find({});
}

// R: Read (Consulta postagem pelo seu id)
export async function obterPostagemPorId(id) {
    return await Postagem.find({ _id : id });
}

// U: Update (Alteração)
export async function alterarPostagem(postagemId, { 
    titulo, conteudo, autor, tags }) {
    return await Postagem.findByIdAndUpdate({ _id : postagemId },
        { $set : { titulo, conteudo, autor, tags } },
        { new : true}
    );
}

// D: Delete (Exclusão)
export async function excluirPostagem(postagemId) {
    return await Postagem.findByIdAndDelete({ _id : postagemId });
}