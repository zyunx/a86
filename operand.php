#!/usr/local/bin/php
<?php

$OPD_TYPE = array(
	'REG' => 'REG',
	'IMMEDIATE' => 'IMMEDIATE',
	'MEM' => 'MEM',
);

// registers
$REG = array(
	// operand array register key
	'KEY' => 'reg',

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

function parse_operand($opd)
{
	global $OPD_TYPE, $REG;

	$o = array();

	if ($opd[0] == '%' && strlen($opd) == 3) {
		$o['type'] = $OPD_TYPE['REG'];

		switch(substr($opd, 1, 2)) {

		case 'ax':
		case 'AX':
			$o[$REG['KEY']] = $REG['AX'];
			break;

		case 'dx':
		case 'DX':
			$o[$REG['KEY']] = $REG['DX'];
		break;

		case 'cx':
		case 'CX':
			$o[$REG['KEY']] = $REG['CX'];
		break;

		case 'bx':
		case 'BX':
		$o[$REG['KEY']] = $REG['BX'];
			break;
		}

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

		
	} else {
	}

	return $o;
}


var_dump(parse_operand($argv[1]));
