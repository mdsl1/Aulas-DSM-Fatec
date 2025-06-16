package fabricas;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

public class ArquivoTxt implements Arquivo {

    public String retornarConteudo(String pArquivo) {
        String retorno="";

        try {
            FileReader fr = new FileReader(pArquivo);
            BufferedReader br = new BufferedReader(fr);
            String linha;
            while((linha = br.readLine()) != null) {
                retorno += linha +"\n";
            }
            br.close();
            fr.close();
        }
        catch (IOException e) {
            e.printStackTrace();
        }
        return retorno;
    }
}
