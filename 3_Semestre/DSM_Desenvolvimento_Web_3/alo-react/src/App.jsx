import Header from "./components/header/Header.jsx"
import Footer from "./components/footer/Footer.jsx"
import Main from "./components/main/Main.jsx";

export default function App() {

  let redesSociais = 
  [
    {
      nome: "Instagram",
      logo: "https://www.svgrepo.com/show/452231/instagram.svg"
    },
    {
      nome: "Facebook",
      logo: "https://www.svgrepo.com/show/475647/facebook-color.svg"
    },
    {
      nome: "Twitter",
      logo: "https://www.svgrepo.com/show/452123/twitter.svg"
    }
  ];

  return (
    
    <>
      < Header titulo="Site em React" slogan="O melhor site em React já feito na humanidade humana!" />
      < Main />
      < Footer redesSociais={redesSociais} endereco="Rua São Sebastião da Boa Morte, 190"/>
    </>
    
  );
}