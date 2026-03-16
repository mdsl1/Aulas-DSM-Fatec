import mongoose, { Schema } from "mongoose";
import { usuarioSchema } from "./usuario.js";

export const postagemSchema = new Schema({
    titulo: String,
    conteudo: String,
    autor: usuarioSchema,
    curtidas: {
        type: Number,
        default: 0
    },
    tags: [ String ],
    criado: {
        type: Date,
        default: Date.now
    } 
});

export const Postagem = mongoose.model("Postagem", postagemSchema, "postagens");