<?php

	$apiKey = '48077a193b707f547370deb7b7901861';
	$keyword = $_GET['q'];
	$latitude = $_GET['lat'];
	$longitude = $_GET['long'];
	$showProducts = 'PidPnamePminImg45';
	$radius = 20;
	$sortBy = 'relevance';
	
	$queryString = '?key='.$apiKey.'&q='.$keyword.'&latitude='.$latitude.'&longitude='.$longitude.'&sort_by='.$sortBy.'&show_defaults=false'.'&show='.$showProducts;
	$json_url = 'https://api.x.com/milo/v3/products'.$queryString;
	
	$productsJSON = file_get_contents($json_url);
	echo $productsJSON;
   
?>	