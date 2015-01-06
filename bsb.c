/**
 * bsb.c
 * Convert Binary String to Binray
 *
 * Copyright 2014,2015 Zhang Yun
 * 
 * This file is part of a86.
 *
 * Foobar is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Foobar.  If not, see <http://www.gnu.org/licenses/>.		
 */
#include <stdio.h>
#include <stdlib.h>

int main(int argc, char* argv[]) {
	unsigned char current_byte = 0;
	int index = 0;
	int c;
	while (EOF != (c = getchar())) {
		if (c == '0' || c == '1') {
			current_byte = (current_byte << 1) + (c - '0');
			index++;
			if (index == 8) {
				if (1 != fwrite(&current_byte, 1, 1, stdout)) {
					fputs("IO Error\n", stderr);
				}
				index = 0;
			}
		} else if (!isspace(c)){
			fputs("Only 0 and 1 are recognized.\n", stderr);
			exit(EXIT_FAILURE);
		}
	}

	if (index != 0) {
		fputs("Expect more 0 and 1s.\n", stderr);
		exit(EXIT_FAILURE);
	}

	exit(EXIT_SUCCESS);
}
