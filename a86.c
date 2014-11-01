#include "instruction.h"

#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>

struct instruction current_inst;

int main(int argc, char**argv)
{

	while(next_instruction(&current_inst)) {
		/* debug */
		printf("[%s]\n", current_inst.label);	
		printf("[%s]\n", current_inst.memonic);	
		printf("[%s]\n", current_inst.dest);	
		printf("[%s]\n", current_inst.src);	
		printf("[%s]\n", current_inst.comment);	

	}

	exit(EXIT_SUCCESS);
}
