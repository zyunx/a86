<?php

function parse_memonic($memonic)
{
	if (in_array(strtoupper($memonic), array('MOVB', 'MOVW'))) {
		return array(
			'type' => 'MOV',
			'w' => strtoupper($memonic[3]) == 'W' ? '1' : '0',
		);
	}

	return FALSE;
}
