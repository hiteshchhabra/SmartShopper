<?php

	/*$apiKey = '48077a193b707f547370deb7b7901861';
	$keyword = $_GET['q'];
	//$charitableOnly = $_GET['c'];  // c -> user option for charity or not, returns 0 or 1.
	$latitude = $_GET['lat'];
	$longitude = $_GET['long'];
	$showProducts = 'PidPnameMidImg45Rate';
	$showStores = 'MnameLocS';
	//$radius = $_GET['r'];
	
	$queryString = '?key='.$apiKey.'&q='.$keyword.'&latitude='.$latitude.'&longitude='.$longitude.'&show_defaults=false'.'&show='.$showProducts;
	$json_url = 'https://api.x.com/milo/v3/products'.$queryString;
	
	//echo $json_url;
	 
	$productsJSON = file_get_contents($json_url);

	$productsArray = json_decode($productsJSON, true);

	//var_dump($productsArray);
	
	$merchantIDArray = Array();
	
	foreach ($productsArray['merchants'] as $merchants) {
		array_push($merchantIDArray,$merchants['merchant_id']);
	}
	
	//var_dump($merchantIDArray);
	$merchantIDString = implode(",",$merchantIDArray);
	//var_dump($merchantIDString);
	
	$queryString = '?key='.$apiKey.'&merchant_ids='.$merchantIDString.'&latitude='.$latitude.'&longitude='.$longitude.'&show_defaults=false'.'&show='.$showStores;
	$json_url = 'https://api.x.com/milo/v3/store_addresses'.$queryString;
	
	//echo $json_url;
	
	$storesJSON = file_get_contents($json_url);

	$storesArray = json_decode($storesJSON, true);
	
	
	$counter = 0;
	$responseArray = Array();
	foreach ($storesArray['store_addresses'] as $stores) {
		$randomID = rand(0,sizeof($storesArray['store_addresses'])*2);
		if(0 <= $randomID && $randomID < sizeof($storesArray['store_addresses'])){
			$stores['charitable'] = 1;
			array_push($responseArray,$stores);
		}
		else{
			$stores['charitable'] = 0;
			array_push($responseArray,$stores);
		}
	}
	
	echo(json_encode($responseArray));
	//return json_encode($storesArray);
	
	*/
	

    $apiKey = '48077a193b707f547370deb7b7901861';
	
	$latitude = $_GET['lat'];
	$longitude = $_GET['long'];
	
	$productID = $_GET['q'];
	
	$showProduct = 'Mid';
	$showStores = 'MnameLocS';
	
	$queryString = '?key='.$apiKey.'&product_ids='.$productID.'&latitude='.$latitude.'&longitude='.$longitude.'&show_defaults=false'.'&show='.$showProduct;
	$json_url = 'https://api.x.com/milo/v3/products'.$queryString;
	$merchants = json_decode(file_get_contents($json_url),true);
	//var_dump($merchants);
	
	$merchantArray = Array();
	foreach ($merchants['merchants'] as $merchants) {
		array_push($merchantArray,$merchants['merchant_id']);
	}
	
	//var_dump($merchantArray);
	$merchantString = implode(",",$merchantArray);
	//var_dump($merchantString);
	
	$queryString = '?key='.$apiKey.'&merchant_ids='.$merchantString.'&latitude='.$latitude.'&longitude='.$longitude.'&show_defaults=false'.'&show='.$showStores;
	$json_url = 'https://api.x.com/milo/v3/store_addresses'.$queryString;
	
	//echo $json_url;
	
	$storesJSON = file_get_contents($json_url);

	$storesArray = json_decode($storesJSON, true);
	

	$responseArray = Array();
	foreach ($storesArray['store_addresses'] as $stores) {
		$randomID = rand(0,sizeof($storesArray['store_addresses'])*2);
		if(0 <= $randomID && $randomID < sizeof($storesArray['store_addresses'])){
			$stores['charitable'] = 1;
			array_push($responseArray,$stores);
		}
		else{
			$stores['charitable'] = 0;
			array_push($responseArray,$stores);
		}
	}
	
	echo(json_encode($responseArray));
	
?>	
	