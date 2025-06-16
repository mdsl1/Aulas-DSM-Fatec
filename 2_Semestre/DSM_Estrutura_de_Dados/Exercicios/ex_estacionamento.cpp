#include <stdio.h>
#include <stdlib.h>
//define --> cria uma constante chamada tam
#define tam 10

typedef struct
{
	int topo;
	int info[tam];
}PILHA;

void Cria_Pilha(PILHA *p)
{
	p->topo = -1;
}

int Cheia(PILHA *p)
{
	return (p->topo==tam-1);
}

int Vazia(PILHA *p)
{
	return (p->topo == -1);
}

int Push(PILHA *p, int v)
{
	if (Cheia(p))
		return 0;
	p->info[++p->topo] = v;
	return 1;
}

int Pop(PILHA *p, int *v)
{
	if (Vazia(p))
		return 0;
	*v = p->info[p->topo--];
	return 1;
}

void Imprime(PILHA p)
{
	int i;
	printf("\nPILHA:\n");
	for (i=p.topo; i>=0; i--) {
	    printf("[ %3d ]\n", p.info[i]);
	}  
	printf("\n\n");
}

void Rem_Veiculo(PILHA *S, int val)
{
	PILHA Aux;
	int v, existe = 0;
	
	Cria_Pilha(&Aux);
	
	// Tirar os carros até achar o desejado
	while (!Vazia(S)) {
		Pop(S, &v);
		// Se achar o carro, não empilha ele na Aux, simulando uma exclusao
		if (v == val) {
			printf("\nVeiculo %d removido.\n", val);
			existe = 1;
			break;
		}
		else {
			Push(&Aux, v);
		}
	}
	
	// Recolocar os carros de volta no estacionamento
	while (!Vazia(&Aux))
	{
		Pop(&Aux, &v);
		Push(S, v);
	}
	// Se ele nao encontrar o carro, exibe mensagem
	if (existe == 0) {
		printf("\nVeiculo %d nao encontrado.\n", val);
	}
}

void Consultar(int val, PILHA p)
{
	int i, pos = 0;

	for (i = p.topo; i >= 0; i--)
	{
		if (p.info[i] == val)
		{
			pos = (p.topo - i)+1;
			break;
		}
	}
	if (pos == 0)
		printf("\nVeiculo com tag %d nao encontrado!\n\n", val);
	else
		printf("\nVeiculo com tag %d encontrado na posicao %d a partir do topo.\n\n", val, pos);
}

main()
{
	PILHA S, Aux;  //Sao o estacionamento e Aux a rua para manobrar
	int op, val, bin;
	
	Cria_Pilha(&S);
	
	do
	{
		system("cls");
		printf("\n1 - Estacionar");
		printf("\n2 - Remover veiculo do Estacionamento");
		printf("\n3 - Imprimir o Estacionamento");
		printf("\n4 - Procurar veiculo no Estacionamento");
		
		printf("\n0 - Sair do programa");
		
		printf("\nDigite a opcao: ");
		scanf("%d", &op);
		
		switch(op)	
		{
			// Adicionar valor
			case 1: 
				printf("\nDigite a tag do veiculo: ");
		        scanf("%d", &val);
		        if (Push(&S, val))
		        	printf("\nInsercao com sucesso!\n");
		        else
		        	printf("\nPilha Cheia!\n");
		        	
		        system("pause");
		        break;
			
			// Remover valor   
			case 2: 
				printf("\nDigite a tag do veiculo a ser removido: ");
				scanf("%d", &val);
				Rem_Veiculo(&S, val);
				system("pause");
				break;
				
			// Imprimir lista
			case 3: 
				if (Vazia(&S)) 
					printf("\nPilha Vazia!\n");
				else
					Imprime(S);
					
				system("pause");
				break;
			
			// Procurar valor
			case 4:
				printf("\nDigite a tag a ser buscada: ");
				scanf("%d", &val);
				Consultar(val, S);
				system("pause");
				break;     
		}
	} while (op!=0);
}
