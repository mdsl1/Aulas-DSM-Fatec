import "./Header.css";

export default function Header({titulo, slogan}) {
    return (
        <header>
            <h1> {titulo} </h1>
            <p> {slogan} </p>
        </header>
    );
}
