<?php

$PARSE_FUNC = array(
	'parse_mov',
	'parse_push',
	'parse_pop',
	'parse_xchg',
	'parse_in',
	'parse_out',
	'parse_xlat',
	'parse_lea',
	'parse_lds',
	'parse_les',
	'parse_lahf',
	'parse_sahf',
	'parse_pushf',
	'parse_popf',
	'parse_add',
	'parse_adc',
	'parse_inc',
	'parse_aaa',
	'parse_daa',
	'parse_sub',
	'parse_sbb',
	'parse_dec',
	'parse_cmp',
	'parse_aas',
	'parse_das',
	'parse_mul',
	'parse_imul',
	'parse_aam',
	'parse_div',
	'parse_idiv',
	'parse_cbw',
	'parse_cwd',
	'parse_not',
	'parse_shl',
	'parse_shr',
	'parse_sar',
	'parse_rol',
	'parse_ror',
	'parse_rcl',
	'parse_rcr',
	'parse_and',
	'parse_test',
	'parse_or',
	'parse_xor',
	'parse_rep',
	'parse_movs',
	'parse_cmps',
	'parse_scas',
	'parse_lods',
	'parse_stds',
	'parse_call',
	'parse_jmp',
	'parse_ret',
	'parse_conditional_jmp',
	'parse_cx_jmp',
	'parse_int',
	'parse_trival_memonic',
	'parse_segment',
);


$MEMONIC = array(
	// memonic     type    w
	'MOVW' => array('MOV', 1),
	'MOVB' => array('MOV', 0),
	'PUSH' => array('PUSH', 1),
	'POP' => array('POP', 1),
	'XCHGW' => array('XCHG', 1),
	'XCHGB' => array('XCHG', 0),
	'INW' => array('IN', 1),
	'INB' => array('IN', 0),
	'OUTW' => array('OUT', 1),
	'OUTB' => array('OUT', 0),
	'XLAT' => array('XLAT', 1),
	'LEA' => array('LEA', 1),
	'LDS' => array('LDS', 1),
	'LES' => array('LES', 1),
	'LAHF' => array('LAHF', 0),
	'SAHF' => array('LAHF', 0),
	'PUSHF' => array('PUSHF', 1),
	'POPF' => array('POPF', 1),
	'ADDW' => array('ADD', 1),
	'ADDB' => array('ADD', 0),
	'ADCW' => array('ADC', 1),
	'ADCB' => array('ADC', 0),
	'INCW' => array('INC', 1),
	'INCB' => array('INC', 0),
	'AAA' => array('AAA', 1),
	'DAA' => array('DAA', 1),
	'SUBW' => array('SUB', 1),
	'SUBB' => array('SUB', 0),
	'SBBW' => array('SBB', 1),
	'SBBB' => array('SBB', 0),
	'DECW' => array('DEC', 1),
	'DECB' => array('DEC', 0),
	'NEGW' => array('NEG', 1),
	'NEGB' => array('NEG', 0),
	'CMPW' => array('CMP', 1),
	'CMPB' => array('CMP', 0),
	'AAS' => array('AAS', 1),
	'DAS' => array('DAS', 1),
	'MULW' => array('MUL', 1),
	'MULB' => array('MUL', 0),
	'IMULW' => array('IMUL', 1),
	'IMULB' => array('IMUL', 0),
	'AAM' => array('AAM', 1),
	'DIVW' => array('DIV', 1),
	'DIVB' => array('DIV', 0),
	'IDIVW' => array('IDIV', 1),
	'IDIVB' => array('IDIV', 0),
	'AAD' => array('AAD', 1),
	'CBW' => array('CBW', 1),
	'CWD' => array('CWD', 1),
	'NOTW' => array('NOT', 1),
	'NOTB' => array('NOT', 0),
	'SHLW' => array('SHL', 1),
	'SHLB' => array('SHL', 0),
	'SALW' => array('SHL', 1),
	'SALB' => array('SHL', 0),
	'SARW' => array('SAR', 1),
	'SARB' => array('SAR', 0),
	'ROLW' => array('ROL', 1),
	'ROLB' => array('ROL', 0),
	'RORW' => array('ROR', 1),
	'RORB' => array('ROR', 0),
	'RCLW' => array('RCL', 1),
	'RCLB' => array('RCL', 0),
	'RCRW' => array('RCR', 1),
	'RCRB' => array('RCR', 0),
	'ANDW' => array('AND', 1),
	'ANDB' => array('AND', 0),
	'TESTW' => array('TEST', 1),
	'TESTB' => array('TEST', 0),
	'ORW' => array('OR', 1),
	'ORB' => array('OR', 0),
	'XORW' => array('XOR', 1),
	'XORB' => array('XOR', 0),
	'REPZ' => array('REP', 1),
	'REPNZ' => array('REP', 0),
	'MOVSW' => array('MOVS', 1),
	'MOVSB' => array('MOVS', 0),
	'CMPSW' => array('CMPS', 1),
	'CMPSB' => array('CMPS', 0),
	'SCASW' => array('SCAS', 1),
	'SCASB' => array('SCAS', 0),
	'LODSW' => array('LODS', 1),
	'LODSB' => array('LODS', 0),
	'STDSW' => array('STDS', 1),
	'STDSB' => array('STDS', 0),
	'CALL' => array('CALL', 1),
	'JMP' => array('JMP', 1),
	'RET' => array('RET', 1),
	'JE' => array('JE', 1),
	'JZ' => array('JE', 1),
	'JL' => array('JL', 1),
	'JNGE' => array('JL', 1),
	'JLE' => array('JLE', 1),
	'JNG' => array('JLE', 1),
	'JB' => array('JB', 1),
	'JNAE' => array('JB', 1),
	'JBE' => array('JBE', 1),
	'JNA' => array('JBE', 1),
	'JP' => array('JP', 1),
	'JPE' => array('JP', 1),
	'JO' => array('JO', 1),
	'JS' => array('JS', 1),
	'JNE' => array('JNE', 1),
	'JNZ' => array('JNE', 1),
	'JNL' => array('JNL', 1),
	'JGE' => array('JNL' ,1),
	'JNLE' => array('JNLE', 1),
	'JG' => array('JNLE', 1),
	'JNB' => array('JNB', 1),
	'JAE' => array('JNB', 1),
	'JNBE' => array('JNBE', 1),
	'JA' => array('JNBE', 1),
	'JNP' => array('JNP', 1),
	'JPO' => array('JNP', 1),
	'JNO' => array('JNO', 1),
	'JNS' => array('JNS', 1),
	'LOOP' => array('LOOP' , 1),
	'LOOPZ' => array('LOOPZ', 1),
	'LOOPE' => array('LOOPE', 1),
	'LOOPNZ' => array('LOOPNZ', 1),
	'LOOPNE' => array('LOOPNE', 1),
	'JCXZ' => array('JCXZ', 1),
	'INT' => array('INT', 1),
	'INTO' => array('INTO', 1),
	'IRET' => array('IRET', 1),
	'CLC' => array('CLC', 1),
	'CMC' => array('CMC', 1),
	'STC' => array('STC', 1),
	'CLD' => array('CLD', 1),
	'STD' => array('STD', 1),
	'CLI' => array('CLI', 1),
	'STI' => array('STI', 1),
	'HLT' => array('HLT', 1),
	'WAIT' => array('WAIT', 1),
	'ESC' => array('ESC', 1),
	'LOCK' => array('LOCK', 1),
	'SEGMENT' => array('SEGMENT', 1),
);

function parse_segment($memonic, $dest, $src) {
	if ($memonic['type'] != 'SEGMENT') return FALSE;

	if (is_sr($dest) && is_empty($src)) {
		return '001' . $dest['sr'] . '110';
	} else {
		return FALSE;
	}
}

$TRIVAL_MEMONIC = array(
	'INTO' => '11001110',
	'IRET' => '11001111',
	'CLC' => '11111000',
	'CMC' => '11110101',
	'STC' => '11111001',
	'CLD' => '11111100',
	'STD' => '11111101',
	'CLI' => '11111010',
	'STI' => '11111011',
	'HLT' => '11110100',
	'WAIT' => '10011011',
	'ESC' => FALSE,
	'LOCK' => '11110000',
);
function parse_trival_memonic($memonic, $dest, $src) {
	global $TRIVAL_MEMONIC;
	if (!in_array($memonic['type'], array_keys($TRIVAL_MEMONIC)))
		return FALSE;

	if (is_empty($dest) && is_empty($src)) {
		return $TRIVAL_MEMONIC[$memonic['type']];
	} else {
		return FALSE;
	}

}

function parse_int($memonic, $dest, $src) {
	if ($memonic['type'] != 'INT') return FALSE;

	if (is_imm_three($dest) && is_empty($src)) {
		return '11001100';
	} elseif (is_imm($dest) && is_empty($src)) {
		return '11001101' . to_bin8($dest['imm']);
	} else {
		return FALSE;
	}
}


$CX_JMP = array(
	'LOOP' => '10',
	'LOOPZ' => '01',
	'LOOPNZ' => '00',
	'JCXZ' => '11',
);
function parse_cx_jmp($memonic, $dest, $src) {
	global $CX_JMP;
	if (!in_array($memonic['type'], array_keys($CX_JMP)))
		return FALSE;

	if (is_imm($dest) && is_empty($src)) {
		return '111000' . $CX_JMP[$memonic['type']] 
			. to_bin8($dest['imm']);
	} else {
		return FALSE;
	}
}

$CONDITIONAL_JMP = array(
	'JE' => '0100',
	'JL' => '1100',
	'JLE' => '1110',
	'JB' => '0010',
	'JBE' => '0110',
	'JP' => '1010',
	'JO' => '0000',
	'JS' => '1000',
	'JNE' => '0101',
	'JNL' => '1101',
	'JNLE' => '1111',
	'JNB' => '0011',
	'JNBE' => '0111',
	'JNP' => '1011',
	'JNO' => '0001',
	'JNS' => '1001',
);
function parse_conditional_jmp($memonic, $dest, $src) {
	global $CONDITIONAL_JMP;
	if (!in_array($memonic['type'], array_keys($CONDITIONAL_JMP)))
		return FALSE;

	if (is_imm($dest) && is_empty($src)) {
		return '0111' . $CONDITIONAL_JMP[$memonic['type']] 
			. to_bin8($dest['imm']);
	} else {
		return FALSE;
	}
}


function parse_ret($memonic, $dest, $src) {
	// Intersegment ret is not to be supported.
	if ($memonic['type'] != 'RET') return FALSE;

	if (is_imm($dest) && is_empty($src)) {
		return '11000010' . to_bin16($dest['imm']);
	} elseif(is_empty($dest) && is_empty($src)) {
		return '11000011';
	} else {
		return FALSE;
	}
}


function parse_jmp($memonic, $dest, $src) {
	// Intersegment jmp is not to be supported.
	if ($memonic['type'] != 'JMP') return FALSE;

	if (is_imm($dest) && is_empty($src)) {
		if ($dest['imm'] < 128 && $dest['imm'] >= -128) {
			return '11101011' . to_bin8($dest['imm']);
		} else {
			return '11101001' . to_bin16($dest['imm']);
		}
	} elseif(is_rm($dest) && is_empty($src)) {
		return '11111111'
			. $dest['mod'] . '100' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_call($memonic, $dest, $src) {
	// Intersegment call is not to be supported.
	if ($memonic['type'] != 'CALL') return FALSE;

	if (is_imm($dest) && is_empty($src)) {
		return '11101000' . to_bin16($dest['imm']);
	} elseif(is_rm($dest) && is_empty($src)) {
		return '11111111'
			. $dest['mod'] . '010' . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_stds($memonic, $dest, $src) {
	if ($memonic['type'] != 'STDS') return FALSE;

	if(is_empty($dest) && is_empty($src)) {
		return '1010101' . $memonic['w'];
	} else {
		return FALSE;
	}
}


function parse_lods($memonic, $dest, $src) {
	if ($memonic['type'] != 'LODS') return FALSE;

	if(is_empty($dest) && is_empty($src)) {
		return '1010110' . $memonic['w'];
	} else {
		return FALSE;
	}
}


function parse_scas($memonic, $dest, $src) {
	if ($memonic['type'] != 'SCAS') return FALSE;

	if(is_empty($dest) && is_empty($src)) {
		return '1010111' . $memonic['w'];
	} else {
		return FALSE;
	}
}


function parse_cmps($memonic, $dest, $src) {
	if ($memonic['type'] != 'CMPS') return FALSE;

	if(is_empty($dest) && is_empty($src)) {
		return '1010011' . $memonic['w'];
	} else {
		return FALSE;
	}
}


function parse_movs($memonic, $dest, $src) {
	if ($memonic['type'] != 'MOVS') return FALSE;

	if(is_empty($dest) && is_empty($src)) {
		return '1010010' . $memonic['w'];
	} else {
		return FALSE;
	}
}


function parse_rep($memonic, $dest, $src) {
	if ($memonic['type'] != 'REP') return FALSE;

	if(is_empty($dest) && is_empty($src)) {
		return '1111001' . $memonic['w'];
	} else {
		return FALSE;
	}
}

function parse_xor($memonic, $dest, $src) {
	if ($memonic['type'] != 'XOR') return FALSE;
	
	if (is_accumulator($dest) && is_imm($src)) {
		return '0011010' . $memonic['w']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '0011010' . $memonic['w']
			. $dest['mod'] . '100' . $dest['rm']
			. @$dest['disp']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0011000' . $memonic['w']
			. $dest['mod'] . $src['reg'] . $dest['rm']
			. @$dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0011001' . $memonic['w']
			. $src['mod'] . $dest['reg'] . $src['rm']
			. @$src['disp'];
	} else {
		return FALSE;
	} 
}


function parse_or($memonic, $dest, $src) {
	if ($memonic['type'] != 'OR') return FALSE;
	
	if (is_accumulator($dest) && is_imm($src)) {
		return '0000110' . $memonic['w']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1000000' . $memonic['w']
			. $dest['mod'] . '001' . $dest['rm']
			. @$dest['disp']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0000100' . $memonic['w']
			. $dest['mod'] . $src['reg'] . $dest['rm']
			. @$dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0000101' . $memonic['w']
			. $src['mod'] . $dest['reg'] . $src['rm']
			. @$src['disp'];
	} else {
		return FALSE;
	} 
}


function parse_test($memonic, $dest, $src) {
	if ($memonic['type'] != 'TEST') return FALSE;
	
	if (is_accumulator($dest) && is_imm($src)) {
		return '1010100' . $memonic['w']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1111011' . $memonic['w']
			. $dest['mod'] . '100' . $dest['rm']
			. @$dest['disp']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0001000' . $memonic['w']
			. $dest['mod'] . $src['reg'] . $dest['rm']
			. @$dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0001001' . $memonic['w']
			. $src['mod'] . $dest['reg'] . $src['rm']
			. @$src['disp'];
	} else {
		return FALSE;
	} 
}


function parse_and($memonic, $dest, $src) {
	if ($memonic['type'] != 'AND') return FALSE;
	
	if (is_accumulator($dest) && is_imm($src)) {
		return '0010010' . $memonic['w']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1000000' . $memonic['w']
			. $dest['mod'] . '100' . $dest['rm']
			. @$dest['disp']
			. ($memonic['w'] ? to_bin16($src['imm']) : to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0010000' . $memonic['w']
			. $dest['mod'] . $src['reg'] . $dest['rm']
			. @$dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0010001' . $memonic['w']
			. $src['mod'] . $dest['reg'] . $src['rm']
			. @$src['disp'];
	} else {
		return FALSE;
	} 
}


function parse_rcr($memonic, $dest, $src) {
	if ($memonic['type'] != 'RCR') return FALSE;

	if (is_rm($dest) && is_imm_one($src)) {
		return '1101000' . $memonic['w']
			. $dest['mod'] . '011' . $dest['rm']
			. @$dest['disp'];
	} else if(is_rm($dest) && is_empty($src)) {
		return '1101001' . $memonic['w']
			. $dest['mod'] . '011' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_rcl($memonic, $dest, $src) {
	if ($memonic['type'] != 'RCL') return FALSE;

	if (is_rm($dest) && is_imm_one($src)) {
		return '1101000' . $memonic['w']
			. $dest['mod'] . '010' . $dest['rm']
			. @$dest['disp'];
	} else if(is_rm($dest) && is_empty($src)) {
		return '1101001' . $memonic['w']
			. $dest['mod'] . '010' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_ror($memonic, $dest, $src) {
	if ($memonic['type'] != 'ROR') return FALSE;

	if (is_rm($dest) && is_imm_one($src)) {
		return '1101000' . $memonic['w']
			. $dest['mod'] . '001' . $dest['rm']
			. @$dest['disp'];
	} else if(is_rm($dest) && is_empty($src)) {
		return '1101001' . $memonic['w']
			. $dest['mod'] . '001' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_rol($memonic, $dest, $src) {
	if ($memonic['type'] != 'ROL') return FALSE;

	if (is_rm($dest) && is_imm_one($src)) {
		return '1101000' . $memonic['w']
			. $dest['mod'] . '000' . $dest['rm']
			. @$dest['disp'];
	} else if(is_rm($dest) && is_empty($src)) {
		return '1101001' . $memonic['w']
			. $dest['mod'] . '000' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}

function parse_sar($memonic, $dest, $src) {
	if ($memonic['type'] != 'SAR') return FALSE;

	if (is_rm($dest) && is_imm_one($src)) {
		return '1101000' . $memonic['w']
			. $dest['mod'] . '111' . $dest['rm']
			. @$dest['disp'];
	} else if(is_rm($dest) && is_empty($src)) {
		return '1101001' . $memonic['w']
			. $dest['mod'] . '111' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}	
}


function parse_shr($memonic, $dest, $src) {
	if ($memonic['type'] != 'SHR') return FALSE;

	if (is_rm($dest) && is_imm_one($src)) {
		return '1101000' . $memonic['w']
			. $dest['mod'] . '100' . $dest['rm']
			. @$dest['disp'];
	} else if(is_rm($dest) && is_empty($src)) {
		return '1101001' . $memonic['w']
			. $dest['mod'] . '101' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_shl($memonic, $dest, $src) {
	if ($memonic['type'] != 'SHL') return FALSE;

	if (is_rm($dest) && is_imm_one($src)) {
		return '1101000' . $memonic['w']
			. $dest['mod'] . '100' . $dest['rm']
			. @$dest['disp'];
	} else if(is_rm($dest) && is_empty($src)) {
		return '1101001' . $memonic['w']
			. $dest['mod'] . '100' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_not($memonic, $dest, $src) {
	if ($memonic['type'] != 'NOT') return FALSE;

	if (is_rm($dest) && is_empty($src)) {
		return '1111011' . $memonic['w']
			. $dest['mod'] . '010' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_cwd($memonic, $dest, $src) {
	if ($memonic['type'] != 'CWD') return FALSE;

	if (is_empty($dest) && is_empty($src)) {
		return '10011001';
	} else {
		return FALSE;
	}
}


function parse_cbw($memonic, $dest, $src) {
	if ($memonic['type'] != 'CBW') return FALSE;

	if (is_empty($dest) && is_empty($src)) {
		return '10011000';
	} else {
		return FALSE;
	}
}


function parse_aad($memonic, $dest, $src) {
	if ($memonic['type'] != 'AAD') return FALSE;

	if (is_empty($dest) && is_empty($src)) {
		return '1101010100001010';
	} else {
		return FALSE;
	}
}


function parse_idiv($memonic, $dest, $src) {
	if ($memonic['type'] != 'IDIV') return FALSE;

	if (is_rm($dest) && is_empty($src)) {
		return '1111011' . $dest['w']
			. $dest['mod'] . '111' . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}

function parse_div($memonic, $dest, $src) {
	if ($memonic['type'] != 'DIV') return FALSE;

	if (is_rm($dest) && is_empty($src)) {
		return '1111011' . $dest['w']
			. $dest['mod'] . '110' . $dest['rm']
			. @$dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_aam($memonic, $dest, $src) {
	if ($memonic['type'] != 'AAM') return FALSE;

	if (is_empty($dest) && is_empty($src)) {
		return '1101010000001010';
	} else {
		return FALSE;
	}
}

function parse_imul($memonic, $dest, $src) {
	if ($memonic['type'] != 'IMUL') return FALSE;

	if (is_rm($dest) && is_empty($src)) {
		return '1111011' . $dest['w']
			. $dest['mod'] . '101' . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}

function parse_mul($memonic, $dest, $src) {
	if ($memonic['type'] != 'MUL') return FALSE;

	if (is_rm($dest) && is_empty($src)) {
		return '1111011' . $dest['w']
			. $dest['mod'] . '100' . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_das($memonic, $dest, $src) {
	if ($memonic['type'] != 'DAS') return FALSE;

	return '00101111';
}


function parse_aas($memonic, $dest, $src) {
	if ($memonic['type'] != 'AAS') return FALSE;

	return '00111111';
}

function parse_cmp($memonic, $dest, $src) {
	if ($memonic['type'] != 'CMP') return FALSE;

	if (is_accumulator($dest) && is_imm($src)) {
		return '0011110' . $memonic['w']
			. ($memonic['w'] ? 
					to_bin16($src['imm']) :
					to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1000000' . $memonic['w']
			. $dest['mod'] . '111' . $dest['rm']
			. $dest['disp']
			. to_bin16($src['imm']);
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0011100' . $memonic['w']
				. $dest['mod'] . $src['reg'] . $dest['rm']
				. $dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0011101' . $memonic['w']
				. $src['mod'] . $dest['reg'] . $src['rm']
				. $src['disp'];
	} else {
		return FALSE;
	}
}



function parse_neg($memonic, $dest, $src) {
	if($memonic['type'] != 'NEG') return FALSE;

	if(is_rm($dest) && is_empty($src)) {
		return '1111011' . $memonic['w']
			. $dest['mod'] . 011 . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}

function parse_dec($memonic, $dest, $src) {
	if ($memonic['type'] != 'DEC') return FALSE;

	if (is_reg($dest) && is_empty($src)) {
		return '01001' . $dest['reg'];
	} elseif(is_rm($dest) && is_empty($src)) {
		return '1111111' . $memonic['w']
			. $dest['mod'] . '001' . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}

function parse_sbb($memonic, $dest, $src) {
	if ($memonic['type'] != 'SBB') return FALSE;

	if (is_accumulator($dest) && is_imm($src)) {
		return '0001110' . $memonic['w']
			. ($memonic['w'] ? 
					to_bin16($src['imm']) :
					to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1000000' . $memonic['w']
			. $dest['mod'] . '011' . $dest['rm']
			. $dest['disp']
			. to_bin16($src['imm']);
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0010100' . $memonic['w']
				. $dest['mod'] . $src['reg'] . $dest['rm']
				. $dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0010101' . $memonic['w']
				. $src['mod'] . $dest['reg'] . $src['rm']
				. $src['disp'];
	} else {
		return FALSE;
	}
}


function parse_sub($memonic, $dest, $src) {
	if ($memonic['type'] != 'SUB') return FALSE;

	if (is_accumulator($dest) && is_imm($src)) {
		return '0010110' . $memonic['w']
			. ($memonic['w'] ? 
					to_bin16($src['imm']) :
					to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1000000' . $memonic['w']
			. $dest['mod'] . '101' . $dest['rm']
			. $dest['disp']
			. to_bin16($src['imm']);
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0010100' . $memonic['w']
				. $dest['mod'] . $src['reg'] . $dest['rm']
				. $dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0010101' . $memonic['w']
				. $src['mod'] . $dest['reg'] . $src['rm']
				. $src['disp'];
	} else {
		return FALSE;
	}
}


function parse_daa($memonic, $dest, $src) {
	if ($memonic['type'] != 'DAA') return FALSE;

	return '00100111';
}

function parse_aaa($memonic, $dest, $src) {
	if ($memonic['type'] != 'AAA') return FALSE;

	return '00110111';
}

function parse_inc($memonic, $dest, $src) {
	if ($memonic['type'] != 'INC') return FALSE;

	if (is_reg($dest) && is_empty($src)) {
		return '01000' . $dest['reg'];
	} elseif(is_rm($dest) && is_empty($src)) {
		return '1111111' . $memonic['w']
			. $dest['mod'] . '000' . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}


function parse_adc($memonic, $dest, $src) {
	if ($memonic['type'] != 'ADC') return FALSE;

	if (is_accumulator($dest) && is_imm($src)) {
		return '0001010' . $memonic['w']
			. ($memonic['w'] ? 
					to_bin16($src['imm']) :
					to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1000000' . $memonic['w']
			. $dest['mod'] . '010' . $dest['rm']
			. $dest['disp']
			. to_bin16($src['imm']);
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0001000' . $memonic['w']
				. $dest['mod'] . $src['reg'] . $dest['rm']
				. $dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0001001' . $memonic['w']
				. $src['mod'] . $dest['reg'] . $src['rm']
				. $src['disp'];
	} else {
		return FALSE;
	}
}


function parse_add($memonic, $dest, $src) {
	if ($memonic['type'] != 'ADD') return FALSE;

	if (is_accumulator($dest) && is_imm($src)) {
		return '0000010' . $memonic['w']
			. ($memonic['w'] ? 
					to_bin16($src['imm']) :
					to_bin8($src['imm']));
	} elseif (is_rm($dest) && is_imm($src)) {
		return '1000000' . $memonic['w']
			. $dest['mod'] . '000' . $dest['rm']
			. $dest['disp']
			. to_bin16($src['imm']);
	} elseif (is_rm($dest) && is_reg($src)) {
		return '0000000' . $memonic['w']
				. $dest['mod'] . $src['reg'] . $dest['rm']
				. $dest['disp'];
	} elseif (is_reg($dest) && is_rm($src)) {
		return '0000001' . $memonic['w']
				. $src['mod'] . $dest['reg'] . $src['rm']
				. $src['disp'];
	} else {
		return FALSE;
	}
}


function parse_popf($memonic, $dest, $src) {
	if ($memonic['type'] != 'POPF') return FALSE;

	return '10011101';
}


function parse_pushf($memonic, $dest, $src) {
	if ($memonic['type'] != 'PUSHF') return FALSE;

	return '10011100';
}


function parse_sahf($memonic, $dest, $src) {
	if ($memonic['type'] != 'SAHF') return FALSE;

	return '10011110';
}


function parse_lahf($memonic, $dest, $src) {
	if ($memonic['type'] != 'LAHF') return FALSE;

	return '10011111';
}

function parse_les($memonic, $dest, $src) {
	if ($memonic['type'] != 'LES') return FALSE;

	if (is_reg($dest) && is_rm($src)) {
		return '11000100'
			. $src['mod'] . $dest['reg'] . $src['rm']
			. $src['disp'];
	} else {
		return FALSE;
	}

}

function parse_lds($memonic, $dest, $src) {
	if ($memonic['type'] != 'LDS') return FALSE;

	if (is_reg($dest) && is_rm($src)) {
		return '11000101'
			. $src['mod'] . $dest['reg'] . $src['rm']
			. $src['disp'];
	} else {
		return FALSE;
	}
}


function parse_xlat($memonic, $dest, $src) {
	if ($memonic['type'] != 'XLAT') return FALSE;
	return '11010111';
}
function parse_lea($memonic, $dest, $src) {
	if ($memonic['type'] != 'LEA') return FALSE;

	if (is_reg($dest) && is_rm($src)) {
		return '10001101'
			. $src['mod'] . $dest['reg'] . $src['rm']
			. $src['disp'];
	} else {
		return FALSE;
	}
}


function parse_in($memonic, $dest, $src) {
	if ($memonic['type'] != 'IN') return FALSE;

	if (is_imm($dest) && is_empty($src)) {
		return '1110010' . $memonic['w']
			. to_bin8($dest['imm']);
	} elseif (is_empty($dest) && is_empty($src)) {
		return '1110110' . $memonic['w'];
	} else {
		return FALSE;
	}
}

function parse_out($memonic, $dest, $src) {
	if ($memonic['type'] != 'OUT') return FALSE;

	if (is_imm($dest) && is_empty($src)) {
		return '1110011' . $memonic['w']
			. to_bin8($dest['imm']);
	} elseif (is_empty($dest) && is_empty($src)) {
		return '1110111' . $memonic['w'];
	} else {
		return FALSE;
	}
}
function parse_memonic($memonic)
{
	$memonic = strtoupper($memonic);
	global $MEMONIC;
	foreach($MEMONIC as $m => $typew) {
		if ($memonic == $m) {
			return array(
				'type' => $typew[0],
				'w' => $typew[1],
			);
		}
	}
	return FALSE;
}

function parse_mov($memonic, $dest, $src)
{
	if ($memonic['type'] == 'MOV') {
		if (is_sr($dest) && is_rm($src)) {
				$r = '10001110' 
					. $src['mod']
					. '0'
					. $dest['sr']
					. $src['rm']
					. @$src['disp'];
				return $r;
		} elseif (is_rm($dest) && is_sr($src)) {
				$r = '10001100' 
					. $dest['mod']
					. '0'
					. $src['sr']
					. $dest['rm']
					. @$dest['disp'];
				return $r;
		} elseif (is_accumulator($dest) && is_direct($src)) {
			$r = '1010000' . $memonic['w']
				. $src['disp'];
			return $r;
		} elseif (is_direct($dest) && is_accumulator($src)) {
			$r = '1010001' . $memonic['w']
				. $dest['disp'];
			return $r;
		} elseif (is_reg($dest) && is_imm($src)) {
			$r = '1011' . $memonic['w'] . $dest['reg']
				. ($memonic['w'] ? 
				to_bin16($src['imm']) :
				to_bin8($src['imm']));
			return $r;
		} elseif (is_rm($dest) && is_imm($src)) {
			$r = '1100011' . $memonic['w']
				. $dest['mod'] . '000' . $dest['rm']
				. @$dest['disp']
				. ($memonic['w'] ? 
				to_bin16($src['imm']) :
				to_bin8($src['imm']));
			return $r;
		} elseif (is_reg($dest) && is_rm($src)) {
			$r = '1000101' . $memonic['w']
				. $src['mod']
				. $dest['reg']
				. $src['rm']
				. @$src['disp'];
			return $r;
		} elseif (is_rm($dest) && is_reg($src)) {
			$r = '1000100' . $memonic['w']
				. $dest['mod']
				. $src['reg']
				. $dest['rm']
				. @$dest['disp'];
			return $r;

		}
	} 
	return FALSE;
}

function parse_push($memonic, $dest, $src) {
	if ($memonic['type'] != 'PUSH')
		return FALSE;

	if (is_sr($dest)) {
		return '000' . $dest['sr'] . '110';
	} elseif(is_reg($dest)) {
		return '01010' . $dest['reg'];
	} elseif(is_rm($dest)) {
		return '11111111' . 
			$dest['mod'] . '110' . $dest['rm'] .
			$dest['disp'];
	} else {
		return FALSE;
	}
}

function parse_pop($memonic, $dest, $src) {
	if ($memonic['type'] != 'POP') return FALSE;

	if (is_sr($dest)) {
		return '000' . $dest['sr'] . '111';
	} elseif (is_reg($dest)) {
		return '01011' . $dest['reg'];
	} elseif (is_rm($dest)) {
		return '10001111'
			. $dest['mod'] . '000' . $dest['rm']
			. $dest['disp'];
	} else {
		return FALSE;
	}
}

function parse_xchg($memonic, $dest, $src) {
	if($memonic['type'] != 'XCHG') return FALSE;

	if (is_ax($dest) && is_reg($src)) {
		return '10010' . $src['reg'];
	} elseif(is_reg($dest) && is_ax($src)) {
		return parse_xchg($memonic, $src, $dest);
	} elseif(is_reg($dest) && is_rm($src)) {
		return '1000011' . $memonic['w']
			. $src['mod'] . $dest['reg'] . $src['rm']
			. $src['disp'];
	} elseif(is_rm($dest) && is_reg($src)) {
		return parse_xchg($memonic, $src, $dest);
	} else {
		return FALSE;
	}
}

