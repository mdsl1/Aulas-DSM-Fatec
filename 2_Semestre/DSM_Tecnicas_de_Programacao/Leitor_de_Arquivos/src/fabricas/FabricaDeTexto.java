package fabricas;

public class FabricaDeTexto extends FabricaDeArquivos {
    @Override
    public Arquivo criarArquivo() {
        Arquivo a = new ArquivoTxt();
        return a;
    }
}
