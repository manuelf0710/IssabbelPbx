#!/bin/bash
sed -l 400 -n 's/.*__(\([^)]*\)).*/\1/p' $1 | while read A
do
B=`echo $A | sed "s/'/\"/g"`
echo "msgid  $B"
echo "msgstr $B"
echo
done
