#include "instruction.h"

#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>


static char current_stmt[IDENT_MAX_LEN * 4];

static int _isident(char c)
{
	return isalnum(c) || c == '_'; 
}


int next_instruction(struct instruction *pcurrent_inst)
{
	char *p_cur,   /* current parsation pos of the instruction */
			 *p_prev;

	if (NULL == gets(current_stmt)) return 0;

	p_cur = current_stmt;
	while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
	p_prev = p_cur;

	/* label or memonic */
	while ('\0' != *p_cur && ' ' != *p_cur && '\t' != *p_cur
			&& ':' != *p_cur) p_cur++;

	if (*p_cur == ':') {
		/* label */
		strncpy(pcurrent_inst->label, p_prev, p_cur - p_prev);
		pcurrent_inst->label[p_cur - p_prev] = '\0';
		p_cur = p_cur + 1;

		while ('\0' != *p_cur && (' ' == *p_cur || '\t' == *p_cur)) p_cur++;
		p_prev = p_cur;

		while ('\0' != *p_cur && _isident(*p_cur)) p_cur++;
	}


	/* memonic */
	if (p_prev != p_cur)
	{
		strncpy(pcurrent_inst->memonic, p_prev, p_cur - p_prev);
		pcurrent_inst->memonic[p_cur - p_prev] = '\0';
	} else {
		printf("No memonic!!!\n");
		exit(EXIT_FAILURE);
	}

	/* eat blank */
	while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
	p_prev = p_cur;

	while ('\0' != *p_cur && ';' != *p_cur)
		p_cur++;

	/* comment */
	if (*p_cur == ';') {
		strncpy(pcurrent_inst->comment, p_cur, COMMENT_MAX_LEN);
		*p_cur = '\0';
	} else {
		pcurrent_inst->comment[0] = '\0';
	}

	/* operands */
	p_cur = p_prev;
	while ('\0' != *p_cur 
			&& ' ' != *p_cur && '\t' != *p_cur 
			&& ',' != *p_cur)
		p_cur++;
	/* dest */
	if (p_prev != p_cur) {
		strncpy(pcurrent_inst->dest, p_prev, p_cur - p_prev);
		pcurrent_inst->dest[p_cur - p_prev] = '\0';

		while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
		p_prev = p_cur;

		/* src */
		if (',' == *p_prev)
		{
			p_cur = p_prev + 1;
			while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
			p_prev = p_cur;
			while ('\0' != *p_cur && _isident(*p_cur)) p_cur++;
			strncpy(pcurrent_inst->src, p_prev, p_cur - p_prev);
			pcurrent_inst->src[p_cur - p_prev] = '\0';

			while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
			if ('\0' != *p_cur) {
				printf("Syntax Error!!!\n");
				exit(EXIT_FAILURE);
			}
		} else if ('\0' == *p_prev) {
			pcurrent_inst->src[0] = '\0';
		} else {
			printf("Syntax Error!!!\n");
			exit(EXIT_FAILURE);
		}
	} else {
		pcurrent_inst->dest[0] = '\0';
		pcurrent_inst->src[0] = '\0';
	}

	return 1;
}
