package sistema;
import java.util.ArrayList;
import java.util.List;
import dados.Animal;

public class Abrigo {
    private List<Animal> animais;

    public Abrigo() {
        this.animais = new ArrayList<>();
    }

    public void adicionarAnimal(Animal a) {
        this.animais.add(a);
        System.out.println(a.getNome() + " adicionado(a) ao abrigo.");
    }
    public void listarAnimais() {
        if(this.animais.isEmpty()) {
            System.out.println("Nenhum animal no abrigo.\n");
        }
        else {
            System.out.println("\nAnimais no abrigo:\n");
            for(Animal a : this.animais) {
                System.out.println(a.obterDetalhes());
                System.out.println("---------------------");
            }
        }
    }
    public void removerAnimal(Animal a) {
        if(this.animais.remove(a)) {
            System.out.println(a.getNome() + " removido(a) do abrigo.");
        }
        else {
            System.out.println(a.getNome() + " não encontrado(a) no abrigo.");
        }
    }
}
