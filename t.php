<?php
$t = new DateTime();
for ($i=1; $i<100000000; $i++)
	$j = 1;
$t2 = new DateTime();
$interval = $t2->diff($t);
print_r ($interval->s);
?>