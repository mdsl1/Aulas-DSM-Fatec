// Rota/endpoint /api/postagens
import { criarPostagem, listarPostagens, alterarPostagem, excluirPostagem, obterPostagemPorId } from "../servicos/postagens";

export function rotasPostagens(app) {
    
    app.get("/api/postagens", async (req, res) => {
        return res.json(await listarPostagens());
    });

    app.get("/api/postagens/:id", async (req, res) => {
        return res.json( await obterPostagemPorId());
    });

    app.post("/api/postagens", async (req, res) => {
        const newPostagem = await criarPostagem(req.body);
        return res.status(201).json(newPostagem);
    });

    app.patch("/api/postagens/:id", async (req, res) => {
        const alterPostagem = await alterarPostagem( req.params.id, req.body );
        if (alterPostagem) {
            return res.json(alterPostagem);
        }
        else {
            return res.status(500).json({ "erro": "Falha na alteração." });
        }
    });

    app.delete("/api/postagens/:id", async (req, res) => {
        await excluirPostagem(req.params.id);
        return res.json({ "excluido": true });
    });
}

