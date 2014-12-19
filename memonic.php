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
);

function parse_example($memonic, $dest, $src) {
	if ($memonic['type'] != 'EXM') return FALSE;
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

