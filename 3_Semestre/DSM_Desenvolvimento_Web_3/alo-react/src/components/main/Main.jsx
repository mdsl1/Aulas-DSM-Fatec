import "./Main.css";
import Article from "../article/Article.jsx";

export default function Main() {

    return(
        <main>
            <h2>Artigos</h2>
            < Article titulo="Artigo N.1" autor="Rodolfo Silva" texto="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit optio sint enim perferendis voluptatibus! Minima alias ea vitae, consequuntur fuga dolores aliquid obcaecati ex itaque dolorum cupiditate provident, in nesciunt." />
            < Article titulo="Artigo N.2" autor="Rodelinha Gamer" texto="Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit optio sint enim perferendis voluptatibus! Minima alias ea vitae, consequuntur fuga dolores aliquid obcaecati ex itaque dolorum cupiditate provident, in nesciunt." />

        </main>
    )
}