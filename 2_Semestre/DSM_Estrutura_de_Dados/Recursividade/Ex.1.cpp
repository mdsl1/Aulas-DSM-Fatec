#include <stdio.h>

int 
produto(int a, int b) {
	if(a == 0) {
		return 0;
	}
	else {
		return b + produto(a-1, b);
	}
}

main() {
	int a, b, r;
	
	printf("\nDigite o 1o valor: ");
	 scanf("%d", &a);
	printf("\nDigite o 2o valor: ");
	 scanf("%d", &b);
	 
	r = produto(a,b);
	printf("\nResultado: %d", r);
}
