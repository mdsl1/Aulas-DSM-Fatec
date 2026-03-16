package dados;

public class Gato extends Animal {
    private String raca;

    public Gato(String n, int i, String e, String h, String r) {
        super(n, i, e, h);
        this.raca = r;
    }

    public void setRaca(String r) {
        this.raca = r;
    }
    public String getRaca() {
        return this.raca;
    }

    @Override
    public String obterDetalhes() {
        return super.obterDetalhes() + "\nRaça: " + this.raca;
    }

}
