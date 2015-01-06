a86: a86.o instruction.o

mydisasm: mydisasm.o

boot.bin: boot.bs
	./bsb < boot.bs > boot.bin

.PHONY: mbr.disk
mbr.disk: boot.bin
	dd if=boot.bin of=mbr.disk count=1 bs=512
	./setbf mbr.disk

.PHONY: boot
boot: mbr.disk
	qemu -fda mbr.disk -boot a
