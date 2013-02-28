
<?php
function point_calculation()
{
//$userID=$_GET['userID'];
$distance=$_GET['distance'];
$mode=$_GET['mode'];
$donation= $_GET['donation'];
$price = $_GET['price'];
####################################################################################
#### 		POINT CALCULATION              #########################################
####################################################################################
#price point-1
$price_point= ($price/10);

$distance_point= ($distance/10);

#donation value-2
$donation_value = $donation*$price_point;

# distance point-3
$distance_value= $distance_point*$mode*$price_point;


#final point
$final_point = $price_point + $donation_value + $distance_value;

#echo "$distance_point $donation_value $price_point</br>";
#echo "$final_point";
$final_point = ceil($final_point);
return $final_point;
}

print point_calculation();
?>



