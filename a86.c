#include "instruction.h"

#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>
#include "error.h"

struct instruction current_inst;

#define OPD_NULL    0
#define OPD_MEMORY  1
#define OPD_AX			2
char *operand_type[] = {
	"NULL",
	"MEMORY",
	"AX"
};

struct operand {
	int type;
	union {
		/* for OPD_MEMORY */
		struct {
			char addr_lo;
			char addr_hi;
		};
	};
};

struct operand opd_dest;
struct operand opd_src;

int is_register(char *opd)
{
	return opd[0] == '%';
}

int is_segment(char *opd)
{
	return opd[0] == '@';
}

int is_immediate(char *opd)
{
	return opd[0] == '#';
}

int is_number(char *n, int b, int e)
{
	int i;
	
	if (b == e) return 0;

	if (n[e-1] == 'H') {
		for (i = b; i < e - 1; i++) {
			if (!(isdigit(n[i]) || (n[i] >= 'A' && n[i] <= 'F')) return 0;
	  }
		return 0;
	}

	for (i = b; i < e; i++) {
		if (!isdigit(n[i])) return 0;
	}
	return 1;
}
int to_number(char *n, int b, int e)
{
	int s;
	int i;
	s = 0;

	for (i = b; i < e ;i++) {
		s = s * 10 + n[i] - '0';
	}
	return s;
}

int is_memory(char *opd)
{
	int len;
	int r;

	r = 0;
	len = strlen(opd);
	if(opd[0] == '[' && opd[len-1] == ']'
			&& is_number(opd, 1, len-1)) {
		return 1;
	}
	return 0;
}


#define is_xx(opd, r) ((opd)[0] == '%' && \
		(opd)[1] == (r) && (opd)[2] == 'x')
#define is_ax(opd) is_xx(opd, 'a')

int parse_operand(char *s, struct operand *opd)
{
	int t;

  /* no operand */
  if(s[0] == '\0') {
	  opd->type = OPD_NULL;
		return;
	}
	/* %ax, accumulator  */
	if(is_ax(s)) {
		opd->type = OPD_AX;
		return;
	}
	/* memory */
	if(is_memory(s)) {
		opd->type = OPD_MEMORY;
		t = to_number(s, 1, strlen(s)-1);
		opd->addr_lo = t & 0xFF;
		opd->addr_hi = (t >> 8) & 0xFF;
		return OPD_MEMORY;
	}
}

#define OPC_NULL 0
#define OPC_MOV  1
struct memonic {
	char *name;
	int code;
};
struct memonic memonic_table[] = {
	{"mov", OPC_MOV},
	{NULL, OPC_NULL}
};

struct memonic cur_memonic;

int parse_memonic(char *s)
{
	int i;
	i = 0;
	while (memonic_table[i].name != NULL) {
	  if(0 == strcmp(s, memonic_table[i].name)) {
			cur_memonic =  memonic_table[i];
			return cur_memonic.code;
		}
		i++;
	}
	cur_memonic = memonic_table[i];
	return OPC_NULL;
}

int parse_mov(struct instruction *inst)
{
	if(0 == strcmp(inst->memonic, "mov")) {
		if(is_ax(inst->dest) && is_memory(inst->src)) {
			puts("001000w lo hi");
		} else {
			error("S");

		}
	} else {
	}
}

int main(int argc, char**argv)
{
	int opc;
	while(next_instruction(&current_inst)) {
		/* debug */
		printf("Label [%s]\n", current_inst.label);	
		printf("Memonic [%s]\n", current_inst.memonic);	
		printf("Dest [%s]\n", current_inst.dest);	
		printf("Src [%s]\n", current_inst.src);	
		printf("Comment [%s]\n", current_inst.comment);	

		opc = parse_memonic(current_inst.memonic);
		parse_operand(current_inst.dest, &opd_dest);
		parse_operand(current_inst.src, &opd_src);

		printf("Machine: [%s %s %s]\n", cur_memonic.name, 
				operand_type[opd_dest.type], 
				operand_type[opd_src.type]);
	}

	exit(EXIT_SUCCESS);
}
