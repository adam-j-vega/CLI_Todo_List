<?php

$items= array(0 => 'space_holder');
foreach ($items as $key => $item){
unset($items[$key]);	
}

do{

	foreach ($items as $key => $item) {
	echo "[{$key}] {$item}\n";
	}
	echo "(N)ew item, (R)emove item, (Q)uit ,: \n";
	$input = trim(fgets(STDIN));

	if ($input == 'N') {
		echo 'Enter item:';
		$items[] = trim(fgets(STDIN));
	} elseif ($input == 'R') {
		echo 'Enter item number to remove:';
		$key = trim(fgets(STDIN));
		unset($items[$key]);
	} elseif ($input == 'n') {
		echo 'Enter item:';
		$items[] = trim(fgets(STDIN));
	} elseif ($input == 'r') {
		echo 'Enter item number to remove:';
		$key = trim(fgets(STDIN));
		unset($items[$key]);
	}
} while (($input != 'Q') && ($input != 'q'));

	echo "Goodbye!\n";
	exit(0);
?>


