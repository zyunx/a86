#!/usr/local/bin/php
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
	'AX' => 'AX',
	'DX' => 'DX',
	'CX' => 'CX',
	'BX' => 'BX',
	'SI' => 'SI',
	'DI' => 'DI',
	'BP' => 'BP',
	'SP' => 'SP',

	// hi-half
	'AH' => 'AH',
	'DH' => 'DH',
	'CH' => 'CH',
	'BH' => 'BH',
	// lo-half
	'AL' => 'AL',
	'DL' => 'DL',
	'CL' => 'CL',
	'BL' => 'BL',
);

$SEGREG = array(
	'DS' => 'DS',
	'ES' => 'ES',
	'SS' => 'SS',
	'CS' => 'CS',
);

$MEM = array(
	'BX_SI' => 'BX_SI',
	'BX_DI' => 'BX_DI',
	'BP_SI' => 'BP_SI',
	'BP_DI' => 'BP_DI',
	'SI' => 'SI',
	'DI' => 'DI',
	'DIRECT' => 'DIRECT',
	'BX' => 'BX',
	
	'BX_SI_D8' => 'BX_SI_D8',
	'BX_DI_D8' => 'BX_DI_D8',
	'BP_SI_D8' => 'BP_SI_D8',
	'BP_DI_D8' => 'BP_DI_D8',
	'SI_D8' => 'SI_D8',
	'DI_D8' => 'DI_D8',
	'BP_D8' => 'BP_D8',
	'BX_D8' => 'BX_D8',

	'BX_SI_D16' => 'BX_SI_D16',
	'BX_DI_D16' => 'BX_DI_D16',
	'BP_SI_D16' => 'BP_SI_D16',
	'BP_DI_D16' => 'BP_DI_D16',
	'SI_D16' => 'SI_D16',
	'DI_D16' => 'DI_D16',
	'BP_D16' => 'BP_D16',
	'BX_D16' => 'BX_D16',

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

		if (in_array($o[$REG['KEY']], array(
			$REG['AX'], $REG['DX'], 
			$REG['CX'], $REG['BX'],
			$REG['SI'], $REG['DI'], 
			$REG['BP'], $REG['SP'])))
		{
			$o['size'] = 'w';
		}
		else
		{
			$o['size'] = 'b';
		}

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

var_dump(parse_operand($argv[1]));
