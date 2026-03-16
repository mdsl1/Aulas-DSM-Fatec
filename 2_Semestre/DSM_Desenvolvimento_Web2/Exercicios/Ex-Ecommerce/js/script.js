
    let id = document.getElementById("id");
    let qtde = document.getElementById("qtdeItem");
    let preco = document.getElementById("precoFinal");
    let btnAdd = document.getElementById("addItem");
    let btnRmv = document.getElementById("rmvItem");

    function addItem () {
        let q = parseInt(qtde.value);
        qtde.value = q + 1;
        atualizarPreco();
    }

    function rmvItem () {
        let q = parseInt(qtde.value);
        if (q > 1) qtde.value = q - 1;
        atualizarPreco();
    }

    function atualizarPreco () {
        let precoUnitario = parseFloat(document.getElementById("preco").value); // valor vindo do PHP
        let qtdeAtual = parseInt(qtde.value);
        let total = precoUnitario * qtdeAtual;
        preco.textContent = `R$ ${total.toFixed(2).replace(".", ",")}`;
    }   

    function adicionarAoCarrinho () {
        fetch("adiciona_carrinho.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `produto_id=${id.value}&qtde=${qtde.value}`
        })
        .then(res => res.text())
        .then(data => {
            console.log(data);
            alert("Produto adicionado ao carrinho!");
        });
    }
    function comprarAgora () {
        fetch("adiciona_carrinho.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `produto_id=${id.value}&qtde=${qtde.value}`
        })
        .then(res => res.text())
        .then(data => {
            console.log(data);
            // Redireciona após adicionar com sucesso
            window.location.href = "carrinho.php";
        });
    }
    
    window.onload = () => {
        atualizarPreco();
    }

    btnAdd.addEventListener("click", () => addItem());
    btnRmv.addEventListener("click", () => rmvItem());
