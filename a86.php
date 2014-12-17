#!/usr/local/bin/php
<?php
define('AS86_HOME', dirname(__FILE__));
require_once AS86_HOME . '/memonic.php';
require_once AS86_HOME . '/operand.php';

function parse_mov($memonic, $dest, $src)
{
	if ($memonic['type'] == 'MOV') {
		if (is_seg($dest) && is_rm($src)) {
				$r = '10001110' 
					. $src['mod']
					. '0'
					. $dest['sr']
					. $src['rm']
					. @$src['disp'];
				return $r;
		} elseif (is_rm($dest) && is_seg($src)) {
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
