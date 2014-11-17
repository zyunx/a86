a86
===

An 8086 assembler and a disasembler.

instruction format
------------------

instruction => (label:) memonic (dest (,src))  (; comment)

register => %ax, %cx, %dx, %bx, %si, %di, %bp, %sp
            %al, %cl, %dl, %bl, %ah, %ch, %dh, %bh

segment => @ds, @es, @ss, @cs

memory => [xxxx]

number => #ddddH, #0dddddd, #dddd, #ddddddB


