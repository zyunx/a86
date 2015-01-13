#!/usr/local/bin/php
<?php
define('AS86_HOME', dirname(__FILE__));
require_once AS86_HOME . '/global.php';
require_once AS86_HOME . '/operand.php';
require_once AS86_HOME . '/memonic.php';
//require_once AS86_HOME . '/directive.php';

function process_instruction($line) {
	global $instruction_position;

	preg_match('/((\w+)\s*(([^;,]+)(,([^;]+))?)?)?' 
		. '(;(.*))?\s*$/', $line, $m);
//	var_dump($m);
	$memonic = isset($m[2]) ? trim($m[2]) : '';
	$dest = isset($m[4]) ? trim($m[4]) : '';
	$src = isset($m[6]) ? trim($m[6]) : '';
	$comment = isset($m[8]) ? trim($m[8]) : '';
//	var_dump(array($memonic, $dest, $src, $comment));
//	return;
	
	if ($memonic != '') {
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
}

function process_directive($directive) {
	global $instruction_position;

	$directive = trim(substr($directive, 1));
	$da = preg_split('/\s+/', $directive);
	$dname = strtoupper($da[0]);
	var_dump($da);
	if ($dname === 'ORG') {
		$instruction_position = to_immediate($da[1]);
		//echo "put INSTRUCTION_POSITION at $instruction_position\n";
	} elseif ($dname == 'DB') {
		$instruction_position++;
		echo to_bin8(to_immediate($da[1])) . "\n";
	} elseif ($dname == 'DW')	{
		$instruction_position += 2;
		echo to_bin16(to_immediate($da[1])) . "\n";
	} elseif ($dname == 'TIMES') {
		$count = to_immediate($da[1]);
		for($i = 0; $i < $count; $i++) {
			process_line(implode(' ', array_slice($da, 2)));
		}
	} else {
		fputs($stderr, "Wrong directive\n");
		die;
	}
}


function process_line($line) {
	global $label_array, $instruction_position;

	$label_array['$'] = $instruction_position;

	preg_match('/^\s*((\w*):)?\s*(.*)/', $line, $m);

	$label = isset($m[2]) ? trim($m[2]) : '';
	$newLine = isset($m[3]) ? trim($m[3]) : '';

	if ($label) {
		// add label
		$label_array[$label] = $instruction_position;
		process_line($newLine);
	} else {
		echo "Line: $newLine\n";
		
		if ('' == $newLine) {

		} if (substr($newLine, 0, 1) == '.') {
			// directive
			process_directive($newLine);
		} else {
			process_instruction($newLine);
		}


	}
	return TRUE;

}

while ($line = fgets(STDIN))
{
	process_line($line);
}

var_dump($label_array);
