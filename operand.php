<?php
error_reporting(E_ALL);

$OPD_TYPE = array(
	'REG' => 'REG',
	'SR' => 'SR',
	'IMM' => 'IMM',
	'MEM' => 'MEM',
);

// registers
$REG = array(
	// whole word
	'AX' => array('reg' => '000', 'mod' => '11', 'rm' => '000', 'w' => '1'),
	'CX' => array('reg' => '001', 'mod' => '11', 'rm' => '001', 'w' => '1'),
	'DX' => array('reg' => '010', 'mod' => '11', 'rm' => '010', 'w' => '1'),
	'BX' => array('reg' => '011', 'mod' => '11', 'rm' => '011', 'w' => '1'),
	'SP' => array('reg' => '100', 'mod' => '11', 'rm' => '100', 'w' => '1'),
	'BP' => array('reg' => '101', 'mod' => '11', 'rm' => '101', 'w' => '1'),
	'SI' => array('reg' => '110', 'mod' => '11', 'rm' => '110', 'w' => '1'),
	'DI' => array('reg' => '111', 'mod' => '11', 'rm' => '111', 'w' => '1'),
	// lo-half
	'AL' => array('reg' => '000', 'mod' => '11', 'rm' => '000', 'w' => '0'),
	'CL' => array('reg' => '001', 'mod' => '11', 'rm' => '001', 'w' => '0'),
	'DL' => array('reg' => '010', 'mod' => '11', 'rm' => '010', 'w' => '0'),
	'BL' => array('reg' => '011', 'mod' => '11', 'rm' => '011', 'w' => '0'),
	// hi-half
	'AH' => array('reg' => '100', 'mod' => '11', 'rm' => '100', 'w' => '0'),
	'CH' => array('reg' => '101', 'mod' => '11', 'rm' => '101', 'w' => '0'),
	'DH' => array('reg' => '110', 'mod' => '11', 'rm' => '110', 'w' => '0'),
	'BH' => array('reg' => '111', 'mod' => '11', 'rm' => '111', 'w' => '0'),
);

$SR = array(
	'DS' => array('sr' => '11'),
	'ES' => array('sr' => '00'),
	'SS' => array('sr' => '10'),
	'CS' => array('sr' => '01'),
);

$MEM = array(
	// mod == '00'
	'BX_SI' => array('mod' => '00', 'rm' => '000'),
	'BX_DI' => array('mod' => '00', 'rm' => '001'),
	'BP_SI' => array('mod' => '00', 'rm' => '010'),
	'BP_DI' => array('mod' => '00', 'rm' => '011'),
	'SI' =>    array('mod' => '00', 'rm' => '100'),
	'DI' =>    array('mod' => '00', 'rm' => '101'),
	'DIRECT' => array('mod' => '00', 'rm' => '110'),
	'BX' =>    array('mod' => '00', 'rm' => '111'),
	// mod == '01'
	'BX_SI_D8' => array('mod' => '01', 'rm' => '000'),
	'BX_DI_D8' => array('mod' => '01', 'rm' => '001'),
	'BP_SI_D8' => array('mod' => '01', 'rm' => '010'),
	'BP_DI_D8' => array('mod' => '01', 'rm' => '011'),
	'SI_D8' => array('mod' => '01', 'rm' => '100'),
	'DI_D8' => array('mod' => '01', 'rm' => '101'),
	'BP_D8' => array('mod' => '01', 'rm' => '110'),
	'BX_D8' => array('mod' => '01', 'rm' => '111'),
	// mod == '10'
	'BX_SI_D16' => array('mod' => '10', 'rm' => '000'),
	'BX_DI_D16' => array('mod' => '10', 'rm' => '001'),
	'BP_SI_D16' => array('mod' => '10', 'rm' => '010'),
	'BP_DI_D16' => array('mod' => '10', 'rm' => '011'),
	'SI_D16' => array('mod' => '10', 'rm' => '100'),
	'DI_D16' => array('mod' => '10', 'rm' => '101'),
	'BP_D16' => array('mod' => '10', 'rm' => '110'),
	'BX_D16' => array('mod' => '10', 'rm' => '111'),
);

function to_binary($number, $n) 
{
	$ret = '';
	$number = intval($number);
	for($i = 0; $i < $n; $i++) {
		$ret = ($number % 2) . $ret;
		$number /=  2;
	}
	return $ret;
}

function to_bin8($number) {
	return to_binary($number, 8);
}
function to_bin16($number) {
	$ret = to_binary($number, 16);
	$ret = substr($ret, 8, 8) . substr($ret, 0, 8);
	return $ret;
}
function to_immediate($n)
{
	static $c2n = array(
		2 => array(
			'0' => 0,
			'1' => 1,
		),

		8 => array(
			'0' => 0,
			'1' => 1,
			'2' => 2,
			'3' => 3,
			'4' => 4,
			'5' => 5,
			'6' => 6,
			'7' => 7,
		),

		10 => array(
			'0' => 0,
			'1' => 1,
			'2' => 2,
			'3' => 3,
			'4' => 4,
			'5' => 5,
			'6' => 6,
			'7' => 7,
			'8' => 8,
			'9' => 9,
		),

		16 => array(
			'0' => 0,
			'1' => 1,
			'2' => 2,
			'3' => 3,
			'4' => 4,
			'5' => 5,
			'6' => 6,
			'7' => 7,
			'8' => 8,
			'9' => 9,
			'a' => 10,
			'b' => 11,
			'c' => 12,
			'd' => 13,
			'e' => 14,
			'f' => 15,
			'A' => 10,
			'B' => 11,
			'C' => 12,
			'D' => 13,
			'E' => 14,
			'F' => 15,
		),
	);

	$complement = FALSE;
	$r = 0;
	$b = 10;
	if ($n[0] == '0' && $n[1] == 'x') {
		$b = 16;
		$n = substr($n, 2);
	} else if ($n[0] == '0') {
		$b = 8;
		$n = substr($n, 1);
	} else if (strtoupper($n[strlen($n)-1]) == 'H') {
		$b = 16;
		$n = substr($n, 0, -1);
	} else if (strtoupper($n[strlen($n)-1]) == 'B') {
		$b = 2;
		$n = substr($n, 0, -1);
	} else if ($n[0] == '-') {
		$complement = TRUE;
		$n = substr($n, 1);
	}

	$i = 0;
	while (strlen($n) > $i) {
		$c = $n[$i++];
		if (isset($c2n[$b][$c])) {
			$r = $b * $r + $c2n[$b][$c];

		} else {
			return FALSE;
		}
	}

	if ($complement) $r = -$r;
	return $r;
}

function parse_gr($opd)
{
	global $REG;
	$o = array();

	if (!($opd[0] == '%' && strlen($opd) == 3))
		return FALSE;

	$name = strtoupper(substr($opd,1,2));
	if (empty($REG[$name]))
		return FALSE;

	$o = $REG[$name];
	$o['name'] = $name;
	$o['type'] = 'REG';
	return $o;
}

function parse_sr($opd) {
	global $SR;
	if (!($opd[0] == '@' && strlen($opd) == 3))
		return FALSE;

	$name = strtoupper(substr($opd, 1, 2));
	
	if (empty($SR[$name])) 
		return FALSE;
	
	$o = $SR[$name];
	$o['name'] = $name;
	$o['type'] = 'SR';
	return $o;
}

function parse_imm($opd) {
	if (!($opd[0] == '#'))
		return FALSE;

	$o['name'] = substr($opd, 1);
	$o['imm'] = to_immediate($o['name']);
	if(empty($o['imm']))
		return FALSE;

	$o['type'] = 'IMM';
	return $o;
}

function parse_mem($opd) {
	global $MEM;

	if (!($opd[0] == '[' && $opd[strlen($opd)-1] == ']'))
		return FALSE;

	$disp = '';
	$m = explode('+', substr($opd, 1, -1));
	$k = array();
	for ($i = 0; $i < count($m); $i++) {
		if (trim($m[$i])) {
			$m[$i] = trim($m[$i]);
			if ($m[$i][0] == '%') {
				$k[] = strtoupper(substr($m[$i], 1));
			} elseif($m[$i][0] == '#') {
				$disp = to_immediate(substr($m[$i],1));
				if ($i == 0) {
					$k[] = 'DIRECT';
					$disp = to_bin16($disp);
				} else {
					$k[] = $disp < 256 ? 'D8' : 'D16';
					$disp = ($disp < 256 ? to_bin8($disp) : to_bin16($disp));
				}
			} else {
					$k[] = 'ERROR';
			}
		}
	}
	$name = implode('_', $k);
	
	if (empty($MEM[$name])) return FALSE;

	$o = $MEM[$name];
	$o['disp'] = $disp;
	$o['type'] = 'MEM';
	$o['name'] = $name;
	return $o;

}

function parse_operand($opd)
{
	if (!$opd) return FALSE;

	$o = array();

	if ($opd[0] == '%') {
		$o = parse_gr($opd);	
	} elseif ($opd[0] == '@' && strlen($opd) == 3) {
		$o = parse_sr($opd);
	} elseif ($opd[0] == '#') {
		$o = parse_imm($opd);
	} elseif ($opd[0] == '[' && $opd[strlen($opd)-1] == ']') {
		$o = parse_mem($opd);
	}

	return $o;
}

function is_empty($opd) {
	return empty($opd);
}
function is_sr($opd) {
	return $opd['type'] == 'SR';
}
function is_reg($opd) {
	return $opd['type'] == 'REG';
}
function is_imm($opd) {
	return $opd['type'] == 'IMM';
}
function is_rm($opd) {
	return ($opd['type'] == 'MEM' || $opd['type'] == 'REG');
}
function is_accumulator($opd) {
	return ($opd['type'] == 'REG' && 
		in_array($opd['name'],array('AX','AL','AH')));

}
function is_ax($opd) {
	return ($opd['type'] == 'REG') && $opd['name'] == 'AX';
}
function is_direct($opd) {
	return ($opd['type'] == 'MEM' && $opd['name'] == 'DIRECT'); 
}


//var_dump(parse_operand($argv[1]));
