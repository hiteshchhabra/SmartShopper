<?php
include('point_calculation.php');

	$connection= mysql_connect("localhost","root", "");
	 if (!$connection)
	  {
	     die("Database connection failed:". mysql_error());
	  }
	  //2. select database to use
	  $db_select  = mysql_select_db("hackathon", $connection);
	  if(!$db_select)
	  {
	      die("Database selection failed:".mysql_error());
	  }  
?>

<html>
<body>

<?php

# finally we will get the userID from session in php
$userID="sid1234";
$final_point=point_calculation();

echo "this is userid and final points $userID $final_point</br>";


$result = mysql_query("SELECT * FROM  `points` WHERE userID ='$userID'", $connection);

while($row=mysql_fetch_array($result))
   { 
    echo "$row[1]";
    $final_point= $final_point+$row[1];
    echo "after adding $final_point</br>";
    

   }
 $result1=mysql_query("UPDATE `points` 
 					set points='$final_point'
 					WHERE userID='$userID'");
#$result1=mysql_query("INSERT INTO `points` (userID, points)
#					 VALUES ('$userID','$final_point')");

if (!$result1)
{
	 die("Database query failed: " . mysql_error());
 }

 


?>
</body>
</html>