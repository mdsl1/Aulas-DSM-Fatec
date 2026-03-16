package dados;

public class Animal {
    private String nome;
    private int idade;
    private String especie;
    private String historicoSaude;
    private boolean statusAdocao;

    public Animal(String n, int i, String e, String h) {
        this.nome = n;
        this.idade = i;
        this.especie = e;
        this.historicoSaude = h;
        this.statusAdocao = false;
    }

    public void setNome(String n) {
        this.nome = n;
    }
    public String getNome() {
        return this.nome;
    }
    public void setIdade(int i) {
        this.idade = i;
    }
    public int getIdade() {
        return this.idade;
    }
    public void setEspecie(String e) {
        this.especie = e;
    }
    public String getEspecie() {
        return this.especie;
    }
    public void setHistoricoSaude(String h) {
        this.historicoSaude = h;
    }
    public String getHistoricoSaude() {
        return this.historicoSaude;
    }
    public String getStatusAdocao() {
        if(this.statusAdocao) {
            return "Animal já adotado";
        }
        else {
            return "Animal disponível para adoção";
        }
    }

    public void adotar() {
        this.statusAdocao = true;
        System.out.println(this.nome + " adotado(a) com sucesso!");
    }

    public String obterDetalhes() {
        return 
                "Nome: " + this.nome
                + "\nIdade: " + this.idade + " anos"
                + "\nEspécie: " + this.especie
                + "\nHistórico de Saúde: " + this.historicoSaude
                + "\nStatus de Adoção: " + this.getStatusAdocao();
    }
}
