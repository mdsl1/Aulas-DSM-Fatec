import "./Footer.css";

export default function Footer({redesSociais, endereco}) {

    return (
        <footer>

            <div id="smContainer">
                <p>Siga-nos nas nossas redes sociais!</p>
                <ul>
                    {redesSociais.map(r => (
                        <li><img src= {r.logo} alt="Logo"/> {r.nome} </li>
                    ))}
                </ul>
            </div>
            
            <address>
                <p> {endereco} </p>
                <p>teste@gmail.com</p>
            </address>

        </footer>
    );
}