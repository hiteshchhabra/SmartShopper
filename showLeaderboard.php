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
    <table>
    <tr>
        <td>Rank</td>
        <td>User</td>
        <td>Score</td>
    </tr>
<?php

$result = mysql_query("SELECT * FROM  `points` ORDER BY points DESC", $connection);
 $rank = 1;
if (!$result){
         die("Database query failed: " . mysql_error());
         }


while ($row = mysql_fetch_array($result)) {
                
                echo "<tr>
                <td>{$rank}</td>
                      <td>{$row[0]}</td>
                      <td>{$row[1]}</td>
                      </tr>";

              

                $rank++;
            }
        
    ?>
    </table>
</html>