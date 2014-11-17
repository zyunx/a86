#!/usr/local/bin/php
<?php
while ($line = fgets(STDIN))
{
	preg_match('/^\s*((\w+):)?\s*(\w+)\s*(([^;,]+)(,([^;]+))?)?' 
		. '(;(.*))?\s*$/', $line, $m);
	$label = isset($m[2]) ? trim($m[2]) : '';
	$memonic = isset($m[3]) ? trim($m[3]) : '';
	$dest = isset($m[5]) ? trim($m[5]) : '';
	$src = isset($m[7]) ? trim($m[7]) : '';
	$comment = isset($m[9]) ? trim($m[9]) : '';
	var_dump(array($label, $memonic, $dest, $src, $comment));
}
