#!/usr/local/bin/php
<?php
define('AS86_HOME', dirname(__FILE__));
require_once AS86_HOME . '/operand.php';
require_once AS86_HOME . '/memonic.php';

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

	global $PARSE_FUNC;
	foreach($PARSE_FUNC as $pf) {
		$r = $pf($memonic, $dest, $src);
		if ($r) {
			var_dump($r);
			break;
		}
	}
	/*
	var_dump(
		parse_push($memonic, $dest)
	);*/
//	var_dump(array($label, $memonic, $dest, $src, $comment));
}
