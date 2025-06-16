#include <stdio.h>

int soma(int n) {
	if (n==0) {
		return 0;
	}
	else {
		return n + soma(n-1);
	}
}

main() {
	int n, r;
	
	printf("\nDigite o ultimo valor da soma: ");
	 scanf("%d", &n);
	 
	r = soma(n);
	
	printf("\nSoma: %d", r);
}
