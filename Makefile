a86: a86.o instruction.o

mydisasm: mydisasm.o

mbr.disk:
	dd if=/dev/zero of=mbr.disk count=1 bs=512
	./setbf mbr.disk

.PHONY: boot
boot:
	qemu -fda mbr.disk -boot a
