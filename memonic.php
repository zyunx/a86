<?php

$PARSE_FUNC = array(
	'parse_mov',
	'parse_push',
	'parse_pop',
	'parse_xchg',
);


$MEMONIC = array(
	// memonic     type    w
	'MOVW' => array('MOV', 1),
	'MOVB' => array('MOV', 0),
	'PUSH' => array('PUSH', 1),
	'POP' => array('POP', 1),
	'XCHGW' => array('XCHG', 1),
	'XCHGB' => array('XCHG', 0)
	'INW' => array('IN', 1),
	'INB' => array('IN', 0),
	'OUTW' => array('OUT', 1),
	'OUTB' => array('OUT', 0),
);

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

