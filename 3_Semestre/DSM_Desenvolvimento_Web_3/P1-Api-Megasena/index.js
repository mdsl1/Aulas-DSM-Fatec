const express = require("express");
const app = express();
const port = 3000;

app.use(express.json());

function sortearN() {
    return Math.floor(Math.random() * 60) + 1;
};

let sorteio = [];
function criarSorteio() {

    for(let i = 0; i < 6; i++) {

        let v = sortearN();

        while(sorteio.includes(v)) {
            let v = sortearN();
        }
        
        if(!sorteio.includes(v)) {
            sorteio.push(v)
        }
    }

    // Organiza os valores de forma crescente
    sorteio.sort((a, b) => a - b);
}

app.get("/api/megasena", (req, res) => {
    // Limpa o array antes de sortear valores
    sorteio.splice(0,sorteio.length);

    criarSorteio();

    res.json({ "numeros": sorteio });
});

app.listen(port, () => {
    console.log("Servidor rodando em 127.0.0.1:" + port);
});

