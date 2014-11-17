#!/usr/local/bin/php
<?php

$OPD_TYPE = array(
	'REG' => 'REG',
	'IMMEDIATE' => 'IMMEDIATE',
	'MEM' => 'MEM',
);

$REG = array(
	'KEY' => 'reg',
	'AX' => 'AX',
	'BX' => 'BX',
);

function parse_operand($opd)
{
	global $OPD_TYPE, $REG;

	$o = array();

	if ($opd[0] == '%') {
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
		}	
		
	} else {
	}

	return $o;
}


var_dump(parse_operand($argv[1]));
