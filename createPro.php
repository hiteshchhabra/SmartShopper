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
<head>
	<meta charset="utf-8">
	<title>Create Profile Form</title>
	
</head>
<body>
<?php
if (isset($_POST["Name"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]))
{
		$name= $_POST["Name"];
		$email=$_POST["email"];
		$userID=$_POST["username"];
		$password=$_POST["password"];

		if( !empty($name) && !empty($email) && !empty($userID) && !empty($password))
		{
			echo "Cool !! You are all set!</br>";
		}
		else
		{
			echo "Sorry you have to all information</br>";
		}
}
echo "$name</br>";
echo "$email</br>";


$name= stripslashes($name);
$username = stripslashes($userID);
$password = stripslashes($password);


$result=mysql_query("INSERT INTO `credentials` (name, usrID, password, email)
					 VALUES ('$name', '$userID', '$password', '$email')");




?>

</body>
<p>

U have successfully created your profile!!

</p>
</html>
