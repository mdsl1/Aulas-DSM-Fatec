// CRUD para usuário no banco de dados MongoDB
import { Usuario } from "../modelos/usuario.js";

// C: Create (inclusão)
export async function criarUsuario({ username, email, senha, nome }) {
    const usuario = new Usuario({ username, email, senha, nome });
    return await usuario.save();
}

// R: Read (Consulta)
export async function listarUsuarios() {
    return await Usuario.find({});
}

// R: Read (Consulta usuário pelo seu id)
export async function obterUsuarioPorId(id) {
    return await Usuario.find({ _id : id });
}

// U: Update (Alteração)
export async function alterarUsuario(userId, { username, email, 
    senha, nome }) {
    return await Usuario.findByIdAndUpdate({ _id: userId }, 
        { $set: { username, email, senha, nome } },
        { new: true }
    );
}

// D: Delete (Exclusão)
export async function excluirUsuario(userId) {
    return await Usuario.findByIdAndDelete({ _id : userId });
}

