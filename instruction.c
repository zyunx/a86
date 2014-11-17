#include "instruction.h"

#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>


static char current_stmt[IDENT_MAX_LEN * 4];

#define eatspace(p) while('\0' != *(p) && isspace(*(p))) (p)++
#define spitspace(p, l) do {                 \
	while ((l) != (p) && isspace(*(p))) (p)--; \
	p++;                                       \
} while(0)

int next_instruction(struct instruction *pcurrent_inst)
{
	char *p_cur,   /* current parsation pos of the instruction */
			 *p_left, *p_right, *p_tmp;

	if (NULL == gets(current_stmt)) return 0;

	p_cur = current_stmt;
	eatspace(p_cur);
	p_left = p_cur;

	/* label or memonic */
	while ('\0' != *p_cur && !isspace(*p_cur)
			&& ':' != *p_cur) p_cur++;

	if (*p_cur == ':') {
		/* label */
		p_right = p_cur - 1;
		spitspace(p_right, p_left);
		strncpy(pcurrent_inst->label, p_left, p_right - p_left);
		pcurrent_inst->label[p_right - p_left] = '\0';
		p_cur = p_cur + 1;

		eatspace(p_cur);
		p_left = p_cur;

		while ('\0' != *p_cur && !isspace(*p_cur)) p_cur++;
	}

	/* memonic */
	if (p_left != p_cur)
	{
		p_right = p_cur;
		strncpy(pcurrent_inst->memonic, p_left, p_right - p_left);
		pcurrent_inst->memonic[p_right - p_left] = '\0';
	} else {
		printf("No memonic!!!\n");
		exit(EXIT_FAILURE);
	}

	/* eat blank */
	eatspace(p_cur);
	p_left = p_cur;

	/* find comment begining char */
	while ('\0' != *p_cur && ';' != *p_cur) p_cur++;

	/* comment */
	if (*p_cur == ';') {
		strncpy(pcurrent_inst->comment, p_cur, COMMENT_MAX_LEN);
		*p_cur = '\0';
	} else {
		pcurrent_inst->comment[0] = '\0';
	}

	/* operands */
	p_cur = p_left;
	while ('\0' != *p_cur 
			&& ',' != *p_cur)
		p_cur++;

	/* dest */
	if (*p_cur == ',') {
		p_right = p_cur - 1;
		spitspace(p_right, p_left);
		strncpy(pcurrent_inst->dest, p_left, p_right - p_left);
		pcurrent_inst->dest[p_right - p_left] = '\0';

		p_cur++;
		eatspace(p_cur);
		p_left = p_cur;

		while('\0' != *p_cur) p_cur++;
		p_right = p_cur - 1 > p_left ? p_cur - 1 : p_left;
		spitspace(p_right, p_left);
	
		/* src */
		if (p_right != p_left)
		{
			strncpy(pcurrent_inst->src, p_left, p_right - p_left);
			pcurrent_inst->src[p_right - p_left] = '\0';
		} else {
			pcurrent_inst->src[0] == '\0';
		}

	} else if (*p_cur == '\0') {
		p_right = p_cur;
		spitspace(p_right, p_left);
		strncpy(pcurrent_inst->dest, p_left, p_right - p_left);
		pcurrent_inst->dest[p_right - p_left] = '\0';

		pcurrent_inst->src[0] = '\0';
	}

	return 1;
}
