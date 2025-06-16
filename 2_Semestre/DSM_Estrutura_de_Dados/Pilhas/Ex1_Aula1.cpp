#include <stdio.h>
#include <stdlib.h>

// Cria uma variável constante chamada tam
#define tam 10

typedef struct{
	int topo;
	int info[tam];
} PILHA;

void Cria_Pilha(PILHA *p) {
	p->topo = -1;
}

int Cheia(PILHA *p) {
	return(p->topo ==tam-1);
}

int Vazia(PILHA *p) {
	return (p->topo == -1);
}

int Push(PILHA *p, int v) {
	if(Cheia(p)) {
		return 0;
	}
	p->info[++p->topo] = v;
	return 1;
}

int Pop(PILHA *p, int *v) {
	if(Vazia(p)) {
		return 0;
	}
	*v = p->info[p->topo--];
	return 1;
}

void Imprime(PILHA p) {
	int i;
	printf("\nPilha:\n");
	for(i=p.topo; i>=0; i--) {
		printf("[ %d ]\n", p.info[i]);
	}
};

main() {
	PILHA s;
	int op, val;
	
	Cria_Pilha(&s);
	
	do {
		system("cls");
		printf("\n1 - Inserir na Pilha");
		printf("\n2 - Remover da Pilha");
		printf("\n3 - Imprimir a Pilha");
		printf("\n0 - Sair do Programa");
		
		printf("\n\nDigite a opcao: ");
		scanf("%d", &op);
		
		switch(op) {
			case 1:
				printf("\nValor a inserir: ");
					scanf("%d", &val);
				
				if(Push(&s, val)){
					printf("\nInserido com sucesso.\n");
				}
				else {
					printf("\nPilha cheia.\n");
				}
				system("pause");
				break;
				
			case 2:
				if(Pop(&s, &val)) {
					printf("\nValor removido: %d\n", val);
				}
				else {
					printf("\nPilha vazia.\n");
				}
				system("pause");
				break;
				
			case 3:
				if(Vazia(&s)) {
					printf("\nPilha vazia.\n");
				}
				else {
					Imprime(s);
				}
				system("pause");
				break;
				
		}
			
	} while(op != 0);
}
