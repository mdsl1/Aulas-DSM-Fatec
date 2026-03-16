import mongoose, { Schema } from "mongoose";

export const usuarioSchema = new Schema({
    username: String,
    email: String,
    senha: String,
    nome: String,
    criado: {
        type: Date,
        default: Date.now
    }
});

export const Usuario = mongoose.model("Usuario", usuarioSchema);