package principal;

import fabricas.Arquivo;
import fabricas.FabricaDeArquivos;
import fabricas.FabricaDeTexto;

public class principal {
    public static void main(String[] args) {
        FabricaDeArquivos fa = new FabricaDeTexto();
        Arquivo a = fa.criarArquivo();
        System.out.println(
            a.retornarConteudo(
            "C:\\Users\\markn\\GitHub\\Aulas_DSM_Fatec\\2_Semestre\\DSM_Tecnicas_de_Programacao\\Leitor_de_Arquivos\\aaa.txt"
            )
        );
    }
}
