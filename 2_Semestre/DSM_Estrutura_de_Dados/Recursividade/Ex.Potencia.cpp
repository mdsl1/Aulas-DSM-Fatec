#include <stdio.h>

int potencia(int a, int b) {
	if(b == 1) {
		return a;
	}
	else {
		return a * potencia(a, b-1);
	}
}

main () {
	int a, b, r;
	
	printf("\nDigite o 1o valor: ");
	 scanf("%d", &a);
	printf("\nDigite o 2o valor: ");
	 scanf("%d", &b);
	 
	r = potencia(a,b);
	printf("\nResultado: %d", r);
}
