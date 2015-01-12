#!/usr/local/bin/php
<?php
define('AS86_HOME', dirname(__FILE__));
require_once AS86_HOME . '/global.php';
require_once AS86_HOME . '/operand.php';
require_once AS86_HOME . '/memonic.php';

while ($line = fgets(STDIN))
{
	preg_match('/^\s*((\w+):)?\s*((\w+)\s*(([^;,]+)(,([^;]+))?))?' 
		. '(;(.*))?\s*$/', $line, $m);
	$label = isset($m[2]) ? trim($m[2]) : '';
	$memonic = isset($m[4]) ? trim($m[4]) : '';
	$dest = isset($m[6]) ? trim($m[6]) : '';
	$src = isset($m[8]) ? trim($m[8]) : '';
	$comment = isset($m[10]) ? trim($m[10]) : '';
	var_dump(array($label, $memonic, $dest, $src, $comment));
	
	// add new label
	if ($label) {
		$label_array[$label] = $instruction_position;
	}
	// only label
	if ($memonic == '' && $dest == '' && $src == '')
		continue;

	$memonic = parse_memonic($memonic);
	$dest = parse_operand($dest);
	$src = parse_operand($src);

	global $PARSE_FUNC;
	foreach($PARSE_FUNC as $pf) {
		$r = $pf($memonic, $dest, $src);
		if ($r) {
			fprintf(STDIN, "%d: %s\n", $instruction_position, $r);
			
			// increment instruction position
			$instruction_position += strlen($r)/8;
			break;
		}
	}

}

var_dump($label_array);
