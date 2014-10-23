#include <stdio.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>

/* identifier max length */
#define IDENT_MAX_LEN 80

#define LABEL_MAX_LEN      IDENT_MAX_LEN
#define MEMONIC_MAX_LEN    IDENT_MAX_LEN
#define DEST_MAX_LEN       IDENT_MAX_LEN
#define SRC_MAX_LEN        IDENT_MAX_LEN
#define COMMENT_MAX_LEN    IDENT_MAX_LEN

struct instruction
{
	char label[LABEL_MAX_LEN];
	char memonic[MEMONIC_MAX_LEN];
	char dest[DEST_MAX_LEN];
	char src[SRC_MAX_LEN];
  char comment[COMMENT_MAX_LEN];
};

struct instruction current_inst;
char current_stmt[IDENT_MAX_LEN * 4];

int is_ident_char(char c)
{
	return isalnum(c) || c == '_'; 
}

int main(int argc, char**argv)
{
	char *p_cur,   /* current parsation pos of the instruction */
			 *p_prev;

	while(NULL != gets(current_stmt)) {
		puts(current_stmt);
		
		p_cur = current_stmt;
		while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
		p_prev = p_cur;

		/* label or memonic */
		while ('\0' != *p_cur && ' ' != *p_cur && '\t' != *p_cur
			&& ':' != *p_cur) p_cur++;

		if (*p_cur == ':') {
		  /* label */
			strncpy(current_inst.label, p_prev, p_cur - p_prev);
			current_inst.label[p_cur - p_prev] = '\0';
			p_cur = p_cur + 1;

		  while ('\0' != *p_cur && (' ' == *p_cur || '\t' == *p_cur)) p_cur++;
		  p_prev = p_cur;

      while ('\0' != *p_cur && is_ident_char(*p_cur)) p_cur++;
		}


		/* memonic */
		if (p_prev != p_cur)
		{
		  strncpy(current_inst.memonic, p_prev, p_cur - p_prev);
			current_inst.memonic[p_cur - p_prev] = '\0';
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
			strncpy(current_inst.comment, p_cur, COMMENT_MAX_LEN);
			*p_cur = '\0';
		} else {
			current_inst.comment[0] = '\0';
		}

		/* operands */
		p_cur = p_prev;
		while ('\0' != *p_cur 
				&& ' ' != *p_cur && '\t' != *p_cur 
				&& ',' != *p_cur)
			p_cur++;
		/* dest */
		if (p_prev != p_cur) {
		  strncpy(current_inst.dest, p_prev, p_cur - p_prev);
			current_inst.dest[p_cur - p_prev] = '\0';

			while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
			p_prev = p_cur;

			/* src */
      if (',' == *p_prev)
			{
			  p_cur = p_prev + 1;
				while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
			  p_prev = p_cur;
			  while ('\0' != *p_cur && is_ident_char(*p_cur)) p_cur++;
				strncpy(current_inst.src, p_prev, p_cur - p_prev);
				current_inst.src[p_cur - p_prev] = '\0';

				while ('\0' != *p_cur && isspace(*p_cur)) p_cur++;
				if ('\0' != *p_cur) {
					printf("Syntax Error!!!\n");
					exit(EXIT_FAILURE);
				}
			} else if ('\0' == *p_prev) {
				current_inst.src[0] = '\0';
			} else {
				printf("Syntax Error!!!\n");
				exit(EXIT_FAILURE);
			}
		} else {
			current_inst.dest[0] = '\0';
			current_inst.src[0] = '\0';
		}

		/* debug */
		printf("[%s]\n", current_inst.label);	
		printf("[%s]\n", current_inst.memonic);	
		printf("[%s]\n", current_inst.dest);	
		printf("[%s]\n", current_inst.src);	
		printf("[%s]\n", current_inst.comment);	

	}

	exit(EXIT_SUCCESS);
}
