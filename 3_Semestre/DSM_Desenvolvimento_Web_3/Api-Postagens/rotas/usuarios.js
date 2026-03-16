// Rota/endpoint /api/usuarios

import { criarUsuario, listarUsuarios, 
    alterarUsuario, excluirUsuario, 
    obterUsuarioPorId} from "../servicos/usuarios.js";

export function rotasUsuarios(app) {
    // GET - rota para obter todos os usuários
    app.get("/api/usuarios", async (req, res) => {
        return res.json(await listarUsuarios());
    });

    // GET - rota para obter um usuário pelo seu id
    app.get("/api/usuarios/:id", async (req, res) => {
        return res.json(await obterUsuarioPorId(req.params.id));
    });

    // POST - rota para incluir um usuário
    app.post("/api/usuarios", async (req, res) => {
        const usuarioIncluido = await criarUsuario(req.body);
        return res.status(201).json(usuarioIncluido);
    });

    // PATCH - rota para modificar os dados de um usuário pelo seu id
    app.patch("/api/usuarios/:id", async (req, res) => {
        const usuarioAlterado = await alterarUsuario(
            req.params.id, req.body);
        return res.json(usuarioAlterado);
    });

    // DELETE - rota para exlcuir um usuário pelo seu id
    app.delete("/api/usuarios/:id", async (req, res) => {
        const { deletedCount } = await excluirUsuario(req.params.id);
        if (deletedCount > 0) {
            return res.json({ "excluido" : true });
        }
        return res.status(404).json({ "excluido" : false });
    });
}