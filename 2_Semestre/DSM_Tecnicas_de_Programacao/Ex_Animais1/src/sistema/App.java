package sistema;

import dados.Cachorro;
import dados.Gato;
import dados.Passaro;

public class App {
    public static void main(String[] args) {
        
        Abrigo abrigoPatasFelizes = new Abrigo();

        Cachorro c1 = new Cachorro("Rex", 3, "Cachorro", "Vacinado e saudável", "Pastor Alemão");
        Gato g1 = new Gato("Mia", 2, "Gato", "Vacinado e saudável", "Siamês");
        Passaro p1 = new Passaro("Loro", 5, "Papagaio", "Vacinado e saudável");

        Cachorro c2 = new Cachorro("Teste", 4, "Cachorro", "Vacinado e saudável", "Vira-lata");

        System.out.println("\nBem-vindo ao Abrigo Patas Felizes!\n");
        abrigoPatasFelizes.adicionarAnimal(c1);
        abrigoPatasFelizes.adicionarAnimal(g1);
        abrigoPatasFelizes.adicionarAnimal(p1);
        abrigoPatasFelizes.adicionarAnimal(c2);

        abrigoPatasFelizes.listarAnimais();

        System.out.println("\n");
        abrigoPatasFelizes.removerAnimal(c2);
        p1.adotar();

        abrigoPatasFelizes.listarAnimais();
    }
}
