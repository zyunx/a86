#!/usr/local/bin/php
<?php
define('AS86_HOME', dirname(__FILE__));
require_once AS86_HOME . '/memonic.php';
require_once AS86_HOME . '/operand.php';

function parse_mov($memonic, $dest, $src)
{
	global $OPD_TYPE;

	if ($memonic['type'] == 'MOV') {
		if ($dest['type'] == $OPD_TYPE['REG']) {
		} elseif ($dest['type'] == $OPD_TYPE['MEM']) {
		} elseif ($dest['type'] == $OPD_TYPE['SEGREG']) {
			if ($src['type'] == $OPD_TYPE['MEM']) {
				$r = '10001110' 
					. $src[$OPD_TYPE['MEM']]['mod']
					. '0'
					. $dest[$OPD_TYPE['SEGREG']]['sr']
					. $src[$OPD_TYPE['MEM']]['rm']
					. '';
				return $r;
				
			}
		}
	} 
	return FALSE;
}

while ($line = fgets(STDIN))
{
	preg_match('/^\s*((\w+):)?\s*(\w+)\s*(([^;,]+)(,([^;]+))?)?' 
		. '(;(.*))?\s*$/', $line, $m);
	$label = isset($m[2]) ? trim($m[2]) : '';
	$memonic = isset($m[3]) ? trim($m[3]) : '';
	$dest = isset($m[5]) ? trim($m[5]) : '';
	$src = isset($m[7]) ? trim($m[7]) : '';
	$comment = isset($m[9]) ? trim($m[9]) : '';

	var_dump($memonic = parse_memonic($memonic));
	var_dump($dest = parse_operand($dest));
	var_dump($src = parse_operand($src));
	var_dump(parse_mov($memonic, $dest, $src));
//	var_dump(array($label, $memonic, $dest, $src, $comment));
}
