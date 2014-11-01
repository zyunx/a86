#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <sys/mman.h>


/* PLACEHOLDER */
#define REG8		"reg8"
#define REG8MEM8	"reg8mem8"
#define REG16		"reg16"
#define REG16MEM16	"reg16mem16"
#define MEM8		"mem8"
#define MEM16		"mem16"
#define IMMED8		"immed8"
#define IMMED16		"immed16"
#define SEGREG		"segreg"
#define SHORT_LABEL	"short_label"
#define NEAR_LABEL	"near_label"
#define FAR_LABEL	"far_label"
#define SEGOVERRIDE	"seg_override"
#define NONE		""
#define MOREINFO456	"moreinfo456"
#define MOREINFO4	"moreinfo4"
#define UNKNOWN		"unknown"
#define NOTUSED		"notused"
#define NUMBER1		"1"
#define NUMBER3		"3"

/* GENERAL REGISTER */
#define AL	"al"
#define AH	"ah"
#define AX	"ax"
#define CL	"cl"
#define CH	"ch"
#define CX	"cx"
#define DL	"dl"
#define DH	"dh"
#define DX	"dx"
#define BL	"bl"
#define BH	"bh"
#define BX	"bx"
#define SI	"si"
#define DI	"di"
#define BP	"bp"
#define SP	"sp"
/* SEGMENT REGISTER */
#define CS	"cs"
#define SS	"ss"
#define DS	"ds"
#define ES	"es"

/* DATA TRANSFER */
#define MOV	"mov"
#define PUSH	"push"
#define POP	"pop"
#define XCHG	"xchg"
#define IN	"in"
#define OUT	"out"
#define XLAT	"xlat"
#define LEA	"lea"
#define LDS	"lds"
#define LES	"les"
#define LAHF	"lahf"
#define SAHF	"sahf"
#define PUSHF	"pushf"
#define POPF	"popf"
/* ARITHMETIC */
#define ADD	"add"
#define ADC	"adc"
#define INC	"inc"
#define AAA	"aaa"
#define DAA	"daa"
#define SUB	"sub"
#define SBB	"sbb"
#define DEC	"dec"
#define NEG	"neg"
#define CMP	"cmp"
#define AAS	"aas"
#define DAS	"das"
#define MUL	"mul"
#define IMUL	"imul"
#define AAM	"aam"
#define DIV	"div"
#define IDIV	"idiv"
#define AAD	"aad"
#define CBW	"cbw"
#define CWD	"cwd"
/* LOGIC */
#define NOT	"not"
#define SHL	"shl"
#define SAL	"sal"
#define SHR	"shr"
#define SAR	"sar"
#define ROL	"rol"
#define ROR	"ror"
#define RCL	"rcl"
#define RCR	"rcr"

#define AND	"and"
#define TEST	"test"
#define OR	"or"
#define XOR	"xor"
/* STRING MANIPULATION */
#define REP	"rep"
#define REPZ	"repz"
#define REPNZ	"repnz"
#define MOVS	"movs"
#define MOVSB	"movsb"
#define MOVSW	"movsw"
#define CMPS	"cmps"
#define CMPSB	"cmpsb"
#define CMPSW	"cmpsw"
#define SCAS	"scas"
#define SCASB	"scasb"
#define SCASW	"scasw"
#define LODS	"lods"
#define LODSB	"lodsb"
#define LODSW	"lodsw"
#define STOS	"stos"
#define STOSB	"stosb"
#define STOSW	"stosw"
/* CONTROL TRANSFER */
#define CALL	"call"
#define JMP	"jmp"
#define RET	"ret"
#define JZ	"jz"
#define JE	"je"
#define JL	"jl"
#define JNGE	"jnge"
#define JLE	"jle"
#define JNG	"jng"
#define JB	"jb"
#define JNAE	"jnae"
#define JBE	"jbe"
#define JNA	"jna"
#define JP	"jp"
#define JPE	"jpe"
#define JO	"jo"
#define JS	"js"
#define JNE	"jne"
#define JNZ	"jnz"
#define JNL	"jnl"
#define JGE	"jge"
#define JNLE	"jnle"
#define JG	"jg"
#define JNB	"jnb"
#define JAE	"jae"
#define JNBE	"jnbe"
#define JA	"ja"
#define JNP	"jnp"
#define JPO	"jpo"
#define JNO	"jno"
#define JNS	"jns"
#define LOOP	"loop"
#define LOOPZ	"loopz"
#define LOOPE	"loope"
#define LOOPNZ	"loopnz"
#define LOOPNE	"loopne"
#define JCXZ	"jcxz"
#define INT	"int"
#define INTO	"into"
#define IRET	"iret"
/* PROCESSOR CONTROL */
#define CLC	"clc"
#define CMC	"cmc"
#define STC	"stc"
#define CLD	"cld"
#define STD	"std"
#define CLI	"cli"
#define STI	"sti"
#define HLT	"hlt"
#define WAIT	"wait"
#define ESC	"esc"
#define LOCK	"lock"
#define NOP	"nop"

struct memonic
{
	char * op;
	char * dest;
	char * src;
};

struct memonic memo_all[256] = {
	/* 0_ */
	{ ADD,		REG8MEM8,	REG8 },
	{ ADD,		REG16MEM16,	REG16 },
	{ ADD,		REG8,		REG8MEM8 },
	{ ADD,		REG16,		REG16MEM16 },
	{ ADD,		AL,		IMMED8 },
	{ ADD,		AX,		IMMED16 },
	{ PUSH,		ES,		NONE },
	{ POP,		ES,		NONE },

	{ OR,		REG8MEM8,	REG8 },
	{ OR,		REG16MEM16,	REG16 },
	{ OR,		REG8,		REG8MEM8 },
	{ OR,		REG16,		REG16MEM16 },
	{ OR,		AL,		IMMED8 },
	{ OR,		AX,		IMMED16 },
	{ PUSH,		CS,		NONE },
	{ NOTUSED,	NOTUSED,	NOTUSED },

	/* 1_ */
	{ ADC,		REG8MEM8,	REG8 },
	{ ADC,		REG16MEM16,	REG16 },
	{ ADC,		REG8,		REG8MEM8 },
	{ ADC,		REG16,		REG16MEM16 },
	{ ADC,		AL,		IMMED8 },
	{ ADC,		AX,		IMMED16 },
	{ PUSH,		SS,		NONE },
	{ POP,		SS,		NONE },

	{ SBB,		REG8MEM8,	REG8 },
	{ SBB,		REG16MEM16,	REG16 },
	{ SBB,		REG8,		REG8MEM8 },
	{ SBB,		REG16,		REG16MEM16 },
	{ SBB,		AL,		IMMED8 },
	{ SBB,		AX, 		IMMED16 },
	{ PUSH,		DS,		NONE },
	{ POP,		DS,		NONE },
	
	/* 2_ */
	{ AND,		REG8MEM8,	REG8 },
	{ AND,		REG16MEM16,	REG16 },
	{ AND,		REG8,		REG8MEM8 },
	{ AND,		REG16,		REG16MEM16 },
	{ AND,		AL,		IMMED8 },
	{ AND,		AX,		IMMED16 },
	{ SEGOVERRIDE,	ES,		NONE },
	{ DAA,		NONE,		NONE },

	{ SUB,		REG8MEM8,	REG8 },
	{ SUB,		REG16MEM16,	REG16 },
	{ SUB,		REG8,		REG8MEM8 },
	{ SUB,		REG16,		REG16MEM16 },
	{ SUB,		AL,		IMMED8 },
	{ SUB,		AX,		IMMED16 },
	{ SEGOVERRIDE,	CS,		NONE },
	{ DAS,		NONE,		NONE },

	/* 3_ */
	{ XOR,		REG8MEM8,	REG8 },
	{ XOR,		REG16MEM16,	REG16 },
	{ XOR,		REG8,		REG8MEM8 },
	{ XOR,		REG16,		REG16MEM16 },
	{ XOR,		AL,		REG8 },
	{ XOR,		AX,		REG16 },
	{ SEGOVERRIDE,	SS,		NONE },
	{ AAA,		NONE,		NONE },

	{ CMP,		REG8MEM8,	REG8 },
	{ CMP,		REG16MEM16,	REG16 },
	{ CMP,		REG8,		REG8MEM8 },
	{ CMP,		REG16,		REG16MEM16 },
	{ CMP,		AL,		IMMED8 },
	{ CMP,		AX,		IMMED16 },
	{ SEGOVERRIDE,	DS,		NONE },
	{ AAS,		NONE,		NONE },

	/* 4_ */
	{ INC,		AX,		NONE },
	{ INC,		CX,		NONE },
	{ INC,		DX,		NONE },
	{ INC,		BX,		NONE },
	{ INC,		SP,		NONE },
	{ INC,		BP,		NONE },
	{ INC,		SI,		NONE },
	{ INC,		DI,		NONE },

	{ DEC,		AX,		NONE },
	{ DEC,		CX,		NONE },
	{ DEC,		DX,		NONE },
	{ DEC,		BX,		NONE },
	{ DEC,		SP,		NONE },
	{ DEC,		BP,		NONE },
	{ DEC,		SI,		NONE },
	{ DEC,		DI,		NONE },

	/* 5_ */
	{ PUSH,		AX,		NONE },
	{ PUSH,		CX,		NONE },
	{ PUSH,		DX,		NONE },
	{ PUSH,		BX,		NONE },
	{ PUSH,		SP,		NONE },
	{ PUSH,		BP,		NONE },
	{ PUSH,		SI,		NONE },
	{ PUSH,		DI,		NONE },

	{ POP,		AX,		NONE },
	{ POP,		CX,		NONE },
	{ POP,		DX,		NONE },
	{ POP,		BX,		NONE },
	{ POP,		SP,		NONE },
	{ POP,		BP,		NONE },
	{ POP,		SI,		NONE },
	{ POP,		DI,		NONE },

	/* 6_ */
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },

	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },

	/* 7_ */
	{ JO,		SHORT_LABEL,	NONE },
	{ JNO,		SHORT_LABEL,	NONE },
	{ JB,		SHORT_LABEL,	NONE },
	{ JNB,		SHORT_LABEL,	NONE },
	{ JZ,		SHORT_LABEL,	NONE },
	{ JNZ,		SHORT_LABEL,	NONE },
	{ JBE,		SHORT_LABEL,	NONE },
	{ JNBE,		SHORT_LABEL,	NONE },

	{ JS,		SHORT_LABEL,	NONE },
	{ JNS,		SHORT_LABEL,	NONE },
	{ JP,		SHORT_LABEL,	NONE },
	{ JNP,		SHORT_LABEL,	NONE },
	{ JL,		SHORT_LABEL,	NONE },
	{ JNL,		SHORT_LABEL,	NONE },
	{ JLE,		SHORT_LABEL,	NONE },
	{ JNLE,		SHORT_LABEL,	NONE },

	/* 8_ */
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ TEST,		REG8MEM8,	REG8 },
	{ TEST,		REG16MEM16,	REG16 },
	{ XCHG,		REG8,		REG8MEM8 },
	{ XCHG,		REG16,		REG16MEM16 },
	
	{ MOV,		REG8MEM8,	REG8 },
	{ MOV,		REG16MEM16,	REG16 },
	{ MOV,		REG8,		REG8MEM8 },
	{ MOV,		REG16,		REG16MEM16 },
	{ MOREINFO4,	MOREINFO4,	MOREINFO4 },
	{ LEA,		REG16,		REG16MEM16 },
	{ MOREINFO4,	MOREINFO4,	MOREINFO4 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },

	/* 9_ */
	{ NOP,		NONE,		NONE },
	{ XCHG,		AX,		CX },
	{ XCHG,		AX,		DX },
	{ XCHG,		AX,		BX },
	{ XCHG,		AX,		SP },
	{ XCHG,		AX,		BP },
	{ XCHG,		AX,		SI },
	{ XCHG,		AX,		DI },

	{ CBW,		NONE,		NONE },
	{ CWD,		NONE,		NONE },
	{ CALL,		FAR_LABEL,	NONE },
	{ WAIT,		NONE,		NONE },
	{ PUSHF,	NONE,		NONE },
	{ POPF,		NONE,		NONE },
	{ SAHF,		NONE,		NONE },
	{ LAHF,		NONE,		NONE },

	/* A_ */
	{ MOV,		AL,		MEM8 },
	{ MOV,		AX,		MEM16 },
	{ MOV,		MEM8,		AL },
	{ MOV,		MEM16,		AX },
	{ MOVSB,	NONE,		NONE },
	{ MOVSW,	NONE,		NONE },
	{ CMPSB,	NONE,		NONE },
	{ CMPSW,	NONE,		NONE },
	
	{ TEST,		AL,		IMMED8 },
	{ TEST,		AX,		IMMED16 },
	{ STOSB,	NONE,		NONE },
	{ STOSW,	NONE,		NONE },
	{ LODSB,	NONE,		NONE },
	{ LODSW,	NONE,		NONE },
	{ SCASB,	NONE,		NONE },
	{ SCASW,	NONE,		NONE },

	/* B_ */
	{ MOV,		AL,		IMMED8 },
	{ MOV,		CL,		IMMED8 },
	{ MOV,		DL,		IMMED8 },
	{ MOV,		BL,		IMMED8 },
	{ MOV,		AH,		IMMED8 },
	{ MOV,		CH,		IMMED8 },
	{ MOV,		DH,		IMMED8 },
	{ MOV,		BH,		IMMED8 },

	{ MOV,		AX,		IMMED16 },
	{ MOV,		CX,		IMMED16 },
	{ MOV,		DX,		IMMED16 },
	{ MOV,		BX,		IMMED16 },
	{ MOV,		SP,		IMMED16 },
	{ MOV,		BP,		IMMED16 },
	{ MOV,		SI,		IMMED16 },
	{ MOV,		DI,		IMMED16 },

	/* C_ */
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ RET,		IMMED16,	NONE },
	{ RET,		NONE,		NONE },
	{ LES,		REG16,		REG16MEM16 },
	{ LDS,		REG16,		REG16MEM16 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },

	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ RET,		IMMED16,	NONE },
	{ RET,		NONE,		NONE },
	{ INT,		NUMBER3,	NONE },
	{ INT,		IMMED8,		NONE },
	{ INTO,		NONE,		NONE },
	{ IRET,		NONE,		NONE },

	/* D_ */
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ AAM,		NONE,		NONE },
	{ AAD,		NONE,		NONE },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ XLAT,		NONE,		NONE },

	{ ESC,		NONE,		NONE },
	{ ESC,		NONE,		NONE },
	{ ESC,		NONE,		NONE },
	{ ESC,		NONE,		NONE },
	{ ESC,		NONE,		NONE },
	{ ESC,		NONE,		NONE },
	{ ESC,		NONE,		NONE },
	{ ESC,		NONE,		NONE },

	/* E_ */
	{ LOOPNZ,	SHORT_LABEL,	NONE },
	{ LOOPZ,	SHORT_LABEL,	NONE },
	{ LOOP,		SHORT_LABEL,	NONE },
	{ JCXZ,		SHORT_LABEL,	NONE },
	{ IN,		AL,		IMMED8 },
	{ IN,		AX,		IMMED8 },
	{ OUT,		AL,		IMMED8 },
	{ OUT,		AX,		IMMED8 },

	{ CALL,		NEAR_LABEL,	NONE },
	{ JMP,		NEAR_LABEL,	NONE },
	{ JMP,		FAR_LABEL,	NONE },
	{ JMP,		SHORT_LABEL,	NONE },
	{ IN,		AL,		DX },
	{ IN,		AX,		DX },
	{ OUT,		AL,		DX },
	{ OUT,		AX,		DX },

	/* F_ */
	{ LOCK,		NONE,		NONE },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ REPNZ,	NONE,		NONE },
	{ REPZ,		NONE,		NONE },
	{ HLT,		NONE,		NONE },
	{ CMC,		NONE,		NONE },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },

	{ CLC,		NONE,		NONE },
	{ STC,		NONE,		NONE },
	{ CLI,		NONE,		NONE },
	{ STI,		NONE,		NONE },
	{ CLD,		NONE,		NONE },
	{ STD,		NONE,		NONE },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 },
	{ MOREINFO456,	MOREINFO456,	MOREINFO456 }

};

struct memonic memo80[8] = {
	{ ADD,		REG8MEM8,	IMMED8 },
	{ OR,		REG8MEM8,	IMMED8 },
	{ ADC,		REG8MEM8,	IMMED8 },
	{ SBB,		REG8MEM8,	IMMED8 },
	{ AND,		REG8MEM8,	IMMED8 },
	{ SUB,		REG8MEM8,	IMMED8 },
	{ XOR,		REG8MEM8,	IMMED8 },
	{ CMP,		REG8MEM8,	IMMED8 }
};
struct memonic memo81[8] = {
	{ ADD,		REG16MEM16,	IMMED16 },
	{ OR,		REG16MEM16, 	IMMED16 },
	{ ADC,		REG16MEM16, 	IMMED16 },
	{ SBB,		REG16MEM16,	IMMED16 },
	{ AND,		REG16MEM16,	IMMED16 },
	{ SUB,		REG16MEM16,	IMMED16 },
	{ XOR,		REG16MEM16,	IMMED16 },
	{ CMP,		REG16MEM16,	IMMED16 }
};
struct memonic memo82[8] = {
	{ ADD,		REG8MEM8,	IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ ADC,		REG8MEM8,	IMMED8 },
	{ SBB,		REG8MEM8,	IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ SUB,		REG8MEM8,	IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ CMP,		REG8MEM8,	IMMED8 }	
};
struct memonic memo83[8] = {
	{ ADD,		REG16MEM16,	IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ ADC,		REG16MEM16,	IMMED8 },
	{ SBB,		REG16MEM16,	IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ SUB,		REG16MEM16,	IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ CMP,		REG16MEM16,	IMMED8 }
};
struct memonic memo8C[2] = {
	{ MOV,		REG16MEM16,	SEGREG },
	{ NOTUSED,	NOTUSED,	NOTUSED }
};
struct memonic memo8E[2] = {
	{ MOV,		SEGREG,		REG16MEM16 },
	{ NOTUSED,	NOTUSED,	NOTUSED }

};
struct memonic memo8F[8] = {
	{ POP,		REG16MEM16,	NONE },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED }
};
struct memonic memoC6[8] = {
	{ MOV,		MEM8,		IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED }

};
struct memonic memoC7[8] = {
	{ MOV,		REG16MEM16,	IMMED16 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED }
};

struct memonic memoD0[8] = {
	{ROL,		REG8MEM8,	NUMBER1 },
	{ROR,		REG8MEM8,	NUMBER1 },
	{RCL,		REG8MEM8,	NUMBER1 },
	{RCR,		REG8MEM8,	NUMBER1 },
	{SHL,		REG8MEM8,	NUMBER1 },
	{SHR,		REG8MEM8,	NUMBER1 },
	{NOTUSED,	NOTUSED,	NOTUSED },
	{SAR,		REG8MEM8,	NUMBER1 }
};
struct memonic memoD1[8] = {
	{ ROL,		REG16MEM16,	NUMBER1 },
	{ ROR,		REG16MEM16,	NUMBER1 },
	{ RCL,		REG16MEM16,	NUMBER1 },
	{ RCR,		REG16MEM16,	NUMBER1 },
	{ SHL,		REG16MEM16,	NUMBER1 },
	{ SHR,		REG16MEM16,	NUMBER1 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ SAR,		REG16MEM16,	NUMBER1 }
};
struct memonic memoD2[8] = {
	{ ROL,		REG8MEM8,	CL },
	{ ROR,		REG8MEM8,	CL },
	{ RCL,		REG8MEM8,	CL },
	{ RCR,		REG8MEM8,	CL },
	{ SHL,		REG8MEM8,	CL },
	{ SHR,		REG8MEM8,	CL },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ SAR,		REG8MEM8,	CL }
};
struct memonic memoD3[8] = {
	{ ROL,		REG16MEM16,	CL },
	{ ROR,		REG16MEM16,	CL },
	{ RCL,		REG16MEM16,	CL },
	{ RCR,		REG16MEM16,	CL },
	{ SHL,		REG16MEM16,	CL },
	{ SHR,		REG16MEM16,	CL },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ SAR,		REG16MEM16,	CL }

};
struct memonic memoF6[8] = {
	{ TEST,		REG8MEM8,	IMMED8 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOT,		REG8MEM8,	NONE },
	{ NEG,		REG8MEM8,	NONE },
	{ MUL,		REG8MEM8,	NONE },
	{ IMUL,		REG8MEM8,	NONE },
	{ DIV,		REG8MEM8,	NONE },
	{ IDIV,		REG8MEM8,	NONE }
};
struct memonic memoF7[8] = {
	{ TEST,		REG16MEM16,	IMMED16 },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOT,		REG16MEM16,	NONE },
	{ NEG,		REG16MEM16,	NONE },
	{ MUL,		REG16MEM16,	NONE },
	{ IMUL,		REG16MEM16,	NONE },
	{ DIV,		REG16MEM16,	NONE },
	{ IDIV,		REG16MEM16,	NONE }
};
struct memonic memoFE[8] = {
	{ INC,		REG8MEM8,	NONE },
	{ DEC,		REG8MEM8,	NONE },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
	{ NOTUSED,	NOTUSED,	NOTUSED },
};
struct memonic memoFF[8] = {
	{ INC,		REG16MEM16,	NONE },
	{ DEC,		REG16MEM16,	NONE },
	{ CALL,		REG16MEM16,	NONE },
	{ CALL,		REG16MEM16,	NONE },
	{ JMP,		REG16MEM16,	NONE },
	{ JMP,		REG16MEM16,	NONE },
	{ PUSH,		REG16MEM16,	NONE },
	{ NOTUSED,	NOTUSED,	NOTUSED }
};

unsigned char mrrm_bits[32] = {
	0xF0, 0xF0, /* 0_ */
	0xF0, 0xF0, /* 1_ */
	0xF0, 0xF0, /* 2_ */
	0xF0, 0xF0, /* 3_ */
	0x00, 0x00, /* 4_ */
	0x00, 0x00, /* 5_ */
	0x00, 0x00, /* 6_ */
	0x00, 0x00, /* 7_ */
	0xFF, 0xFF, /* 8_ */
	0x00, 0x00, /* 9_ */
	0x00, 0x00, /* A_ */
	0x00, 0x00, /* B_ */
	0x0F, 0x00, /* C_ */
	0xF0, 0xFF, /* D_ */
	0x00, 0x00, /* E_ */
	0x03, 0x03  /* F_ */

};
unsigned char opcode = 0;
unsigned char mrrm = 0;
#define HAVEMRRM(op)	(mrrm_bits[(op)/8] & (0x80 >> ((op)%8)))
#define BIT4(BF)	(0x01 & ((BF) >> 5))
#define BIT456(BF) 	(0x07 & ((BF) >> 3))
#define SR(BF)		(0x03 & ((BF) >> 3))
#define MODE(BF) 	(((BF) >> 6) & 0x03)
#define REG(BF)		(((BF) >> 3 ) & 0x07)
#define RM(BF)		((BF) & 0x7)

struct memonic mem = {NOTUSED, NOTUSED, NOTUSED};
const unsigned char * pcur;
//unsigned char * begin;
//unsigned char * end;

const char * seg_override = NONE;
struct srcline {
	int addr;
	char mcode[12];
	char ins[100];
};

const char * reg8(unsigned char reg)
{
	switch (reg & 0x7) {
		case 0:
			return AL;
		case 1:
			return CL;
		case 2:
			return DL;
		case 3:
			return BL;
		case 4:
			return AH;
		case 5:
			return CH;
		case 6:
			return DH;
		case 7:
			return BH;
		default:
			return NONE;
	}
}
const char * reg16(unsigned char reg)
{
	switch (reg & 0x7)
	{
		case 0:
			return AX;
		case 1:
			return CX;
		case 2:
			return DX;
		case 3:
			return BX;
		case 4:
			return SP;
		case 5:
			return BP;
		case 6:
			return SI;
		case 7:
			return DI;
		default:
			return NONE;
	}
}
const char * segreg(unsigned char sr)
{
	switch (sr & 0x3)
	{
		case 0:
			return ES;
		case 1:
			return CS;
		case 2:
			return SS;
		case 3:
			return DS;
		default:
			return NONE;
	}
}

int parse_direct_mem(int b)
{
	unsigned short b16;

	printf("[");
	if (seg_override != NONE) {
		printf("%s:", seg_override);
		seg_override = NONE;
	}

	b16 = *((unsigned short *)pcur);
	pcur += 2;
	printf("%04x", b16);
	
	printf("]");
}

int parse_mem(const unsigned char mode,
		const unsigned char m)
{
	unsigned short b16;
	unsigned char  b8;

	printf("[");
	if (seg_override != NONE) {
		printf("%s:", seg_override);
		seg_override = NONE;
	}

	switch (m)
	{
		case 0:
			printf("%s+%s",BX, SI);
			break;
		case 1:
			printf("%s+%s", BX, DI);
			break;
		case 2:
			printf("%s+%s", BP, SI);
			break;
		case 3:
			printf("%s+%s", BP, DI);
			break;
		case 4:
			printf("%s", SI);
			break;
		case 5:
			printf("%s", DI);
		case 6:
			if (mode == 0) {
				b16 = *((unsigned short *)pcur);
				pcur += 2;
				printf("0x%04x", b16);
			} else {
				printf(BP);
			}
			break;
		case 7:
			printf("%s", BX);
			break;
	}

	switch (mode)
	{
		case 0:
		case 1:
			b8 = *pcur;
			pcur++;
			printf("+%02x", b8);
			break;

		case 2:
			b16 = *((unsigned short *)pcur);
			pcur += 2;
			printf("+%04x", b16);
			break;
		default:
			break;
	}

	printf("]");
	
}

int parse_src()
{
	unsigned char b8;
	unsigned short b16;
	unsigned int b32;
	if (mem.src == NONE ) {
		return 0;
	} else if (mem.src == SEGREG) {
		printf(", %s", segreg(SR(mrrm)));
	} else if(mem.src == REG8) {
		printf(", %s", reg8(REG(mrrm)));
	} else if(mem.src == REG16) {
		printf(", %s", reg16(REG(mrrm)));
	} else if(mem.src == REG8MEM8) {
		if (MODE(mrrm) == 3)
		{
			printf(", %s", reg8(RM(mrrm)));
		} else {
			printf(", ");
			parse_mem(MODE(mrrm), RM(mrrm));
		}
	} else if(mem.src == REG16MEM16) {
		if (MODE(mrrm) == 3)
		{
			printf(", %s", reg16(RM(mrrm)));
		} else {
			printf(", ");
			parse_mem(MODE(mrrm), RM(mrrm));
		}
	} else if(mem.src == MEM8 ) {
		printf(", ");
		parse_direct_mem(1);
	} else if(mem.src == MEM16 ) {
		printf(", ");
		parse_direct_mem(2);
	} else if (mem.src == IMMED8 ) {
		b8 = *pcur;
		pcur++;
		printf(", 0x%02x", b8);
		
	} else if (mem.src == IMMED16 ) {
		b16 = *((unsigned short *)pcur);
		pcur += 2;
		printf(", 0x%04x", b16);
	} else {
		printf(", %s", mem.src);
	}
}
int parse_dest()
{
	unsigned char b8;
	unsigned short b16;
	unsigned int b32;
	if (mem.dest == NONE ) {
		return 0;
	} else if (mem.dest == SEGREG) {
		printf("\t%s", segreg(SR(mrrm)));
	} else if (mem.dest == REG8) {
		printf("\t%s", reg8(REG(mrrm)));
	} else if (mem.dest == REG16) {
		printf("\t%s", reg16(REG(mrrm)));
	} else if (mem.dest == REG8MEM8) {
		if (MODE(mrrm) == 3)
		{
			printf("\t%s", reg8(RM(mrrm)));
		} else {
			printf("\t");
			parse_mem(MODE(mrrm), RM(mrrm));
		}

	} else if(mem.dest == REG16MEM16) {
		if (MODE(mrrm) == 3)
		{
			printf("\t%s", reg16(RM(mrrm)));
		} else {
			printf("\t");
			parse_mem(MODE(mrrm), RM(mrrm));
		}

	} else if(mem.dest == MEM8 ) {
		parse_direct_mem(1);
	} else if(mem.dest == MEM16 ) {
		parse_direct_mem(2);
	} else if (mem.dest == IMMED8 ) {
		b8 = *pcur;
		pcur++;
		printf("\t0x%02x", b8);
		
	} else if (mem.dest == IMMED16 ) {
		b16 = *((unsigned short *)pcur);
		pcur += 2;
		printf("\t0x%04x", b16);
	} else if (mem.dest == SHORT_LABEL) {
		b8 = *pcur;
		pcur++;
		printf("\t0x%02x", b8);
	} else if (mem.dest == NEAR_LABEL) {
		b16 = *((unsigned short *)pcur);
		pcur += 2;
		printf("\t0x%04x", b16);
		
	} else if (mem.dest == FAR_LABEL) {
		b32 = *((unsigned int *)pcur);
		pcur += 4;
		printf("\t0x%04x:0x%04x", (b32 >> 16), (b32 & 0xFFFF));
	}
	else {
		printf("\t%s", mem.dest);
	}
	
	return 0;
	
}
int mydisasm(const unsigned char *begin, const unsigned char *end)
{
	unsigned char mi456;
	unsigned char mi4;
	pcur = begin;
	while (pcur < end) {
		opcode = *pcur;
		pcur++;
		if (HAVEMRRM(opcode)) {
			mrrm = *pcur;
			pcur++;
		}

		mem = memo_all[opcode];

		if (mem.op == NOTUSED ) {
			printf("error 1");
			return 1;
		} else if (mem.op == MOREINFO4) {
			mi4 = BIT4(mrrm);
			switch (opcode) {
				case 0x8C:
					mem = memo8C[mi4];
					break;
				case 0x8E:
					mem = memo8E[mi4];
					break;
				default:
					printf("error 2");
					return 2;
			}

			if (mem.op == NOTUSED) {
				printf("error 3");
				return 3;
			}

		} else if (mem.op == MOREINFO456 ) {
			mi456 = BIT456(mrrm);
			switch (opcode) {
				case 0x80:
					mem = memo80[mi456];
					break;
				case 0x81:
					mem = memo81[mi456];
					break;
				case 0x82:
					mem = memo82[mi456];
					break;
				case 0x83:
					mem = memo83[mi456];
					break;
				case 0x8F:
					mem = memo8F[mi456];
					break;
				case 0xC6:
					mem = memoC6[mi456];
					break;
				case 0xC7:
					mem = memoC7[mi456];
					break;
				case 0xD0:
					mem = memoD0[mi456];
					break;
				case 0xD1:
					mem = memoD1[mi456];
					break;
				case 0xD2:
					mem = memoD2[mi456];
					break;
				case 0xD3:
					mem = memoD3[mi456];
					break;
				case 0xF6:
					mem = memoF6[mi456];
					break;
				case 0xF7:
					mem = memoF7[mi456];
					break;
				case 0xFE:
					mem = memoFE[mi456];
					break;
				case 0xFF:
					mem = memoFF[mi456];
					break;
				default:
					printf("error 4");
					return 4;
			}

			if (mem.op == NOTUSED) {
				printf("error 5");
				return 5;
			}
		}

		if (mem.op == SEGOVERRIDE ) {
			seg_override = mem.dest;
			continue;
		} else if (mem.op == AAM) {
			pcur++;
		} else if (mem.op == AAD) {
			pcur++;
		}

		printf(mem.op);
		parse_dest();
		parse_src();

		printf("\n");
	}
}




int main(int argc, char **args, char **env)
{
	char *fn;
	int fd;
	FILE *fp;
	int size;
	const unsigned char * fm;

	if (argc > 1) {
		fn = args[1];
	} else {
		exit(EXIT_SUCCESS);
	}

	fd = open(fn, O_RDWR);
	fp = fdopen(fd, "a");
	fseek(fp, 0, SEEK_END);
	size = ftell(fp);
	//printf("File size: %d\n", size);
	fm = (const unsigned char *) mmap(NULL, size, PROT_READ, MAP_SHARED,
			fd, 0);
	
	mydisasm(fm, fm + size);
	printf("\n");	

	munmap((void *)fm, size);
	fclose(fp);
	close(fd);

	exit(EXIT_SUCCESS);
}
