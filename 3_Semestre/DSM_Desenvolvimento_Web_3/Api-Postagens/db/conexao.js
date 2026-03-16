import mongoose from "mongoose";

export function connectDB() {
    const URI_BANCO = "mongodb://localhost:27017/redesocial";

    mongoose.connection.on("open", () => {
        console.log("Conectado com sucesso ao MongoDB.");
    });
}

const conexao = mongoose.connect(URI_BANCO);

return conexao;