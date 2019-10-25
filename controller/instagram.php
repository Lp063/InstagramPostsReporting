<?php
	require __DIR__ . '../model/instagram.php';

	$your_array = array_shift($your_array);
	$controller = $your_array[0];
	$method = $your_array[1];

	//https://stackoverflow.com/questions/17489109/ajax-request-and-php-class-functions
	if($method) {
		$instagram = new instagram();
		$result = $instagram->getReport();
		echo $result;
	}
?>