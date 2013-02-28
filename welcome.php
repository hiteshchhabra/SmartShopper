<?php
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

$username=$_POST["fname"];
$password=$_POST["password"];

$username = stripslashes($username);
$password = stripslashes($password);

 $result = mysql_query("SELECT * FROM  `credentials` WHERE usrID ='$username' and password='$password' ", $connection);
#echo "$result\n";
if (!$result)
{
	 die("Database query failed: " . mysql_error());
 }

 $count=mysql_num_rows($result);

###############################################################################

if($count == 1){

	$seconds = 120 + time();
	setcookie(loggedin, date("F jS - g:i a"), $seconds);
	#echo "login successful</br>";
	header("location:login_success.php");
 }
else
{
	echo "Wrong Password!!</br>"; 
}
    #echo "$row[1]";
#echo "user name is $username\r\n";
#echo "password is $password\r\n";





?>

</body>
</html>