#ifndef _CLOUD2HAN9_INSTRUCTION_H
#define _CLOUD2HAN9_INSTRUCTION_H

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


#endif
