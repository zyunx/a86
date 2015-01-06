/**
 * setbf.c
 * Set a disk's boot flag
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

#define BOOT_FLAG_POS	510
char boot_flag[] = {0x55, 0xAA};

int main(int argc, char* argv[]) {
	char *filename = argv[1];
	FILE *fp;

	if (NULL == (fp = fopen(filename, "r+"))) {
		fprintf(stderr, "IO Error: open file %s\n", filename);
		exit(EXIT_FAILURE);
	}

	if (0 != fseek(fp, BOOT_FLAG_POS, SEEK_SET)) {
		fprintf(stderr, "IO Error: seek file position at %d\n",
				BOOT_FLAG_POS);
		exit(EXIT_FAILURE);
	}

	if (2 != fwrite(boot_flag, 1, 2, fp)) {
		fprintf(stderr, "IO Error: write boot flag\n");
		exit(EXIT_FAILURE);
	}

	if (0 != fclose(fp)) {
		fprintf(stderr, "IO Error: close file\n");
		exit(EXIT_FAILURE);
	}

	exit(EXIT_SUCCESS);
}
