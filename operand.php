<?php
error_reporting(E_ALL);

$OPD_TYPE = array(
	'REG' => 'REG',
	'SEGREG' => 'SEGREG',
	'IMMEDIATE' => 'IMMEDIATE',
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

$SEGREG = array(
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
	global $OPD_TYPE, $REG, $SEGREG;

	if ($opd[0] == '%' && strlen($opd) == 3) {
		$o[$OPD_TYPE['REG']] = $REG[strtoupper(substr($opd, 1, 2))];
		
		if (empty($o[$OPD_TYPE['REG']]))
			return FALSE;

		return $o;
	}
	return FALSE;	
}

function parse_operand($opd)
{
	global $OPD_TYPE, $REG, $SEGREG, $MEM;

	$o = array();

	if ($opd[0] == '%') {
		$o = parse_gr($opd);	

	} elseif ($opd[0] == '@' && strlen($opd) == 3) {
		$o[$OPD_TYPE['SEGREG']] = $SEGREG[strtoupper(substr($opd, 1, 2))];
		if ($o[$OPD_TYPE['SEGREG']]) 
			$o['type'] = $OPD_TYPE['SEGREG'];

	} elseif ($opd[0] == '#') {
		$o[$OPD_TYPE['IMMEDIATE']] = to_immediate(substr($opd, 1));
		if ($o[$OPD_TYPE['IMMEDIATE']])
			$o['type'] = $OPD_TYPE['IMMEDIATE'];

	} elseif ($opd[0] == '[' && $opd[strlen($opd)-1] == ']') {
		$m = explode('+', substr($opd, 1, -1));
		$k = array();
		for ($i = 0; $i < count($m); $i++) {
			if (trim($m[$i])) {
				$m[$i] = trim($m[$i]);
				if ($m[$i][0] == '%') {
					$k[] = strtoupper(substr($m[$i], 1));
				} elseif($m[$i][0] == '#') {
					if ($i == 0) {
						$k[] = 'DIRECT';
					} else {
						$k[] = to_immediate(substr($m[$i],1)) < 256 ? 'D8' : 'D16';
					}
				} else {
					$k[] = 'ERROR';
				}
			}
		}
		$k = implode('_', $k);
		$o[$OPD_TYPE['MEM']] = @$MEM[$k];
		if ($o[$OPD_TYPE['MEM']]) {
			$o['type'] = $OPD_TYPE['MEM'];
		}
	}

	return $o;
}

//var_dump(parse_operand($argv[1]));
