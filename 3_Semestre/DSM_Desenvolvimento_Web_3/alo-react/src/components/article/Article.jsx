import { useState } from "react";
import "./Article.css";

export default function Article({titulo, autor, texto}) {

    const [curtidas, setCurtidas] = useState(0);

    function curtir() {
        setCurtidas(curtidas + 1);
    }

    return(
        <article>
            <h3> {titulo} </h3>
            <span>Por {autor} </span>
            <p> {texto} </p>
            <div id="likeContainer">
                <span>{ curtidas }</span>
                <button type="button" onClick={curtir}>❤️</button>
            </div>
        </article>
    )
}