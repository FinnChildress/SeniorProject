<?php
$servername='localhost';
$username='cat2mc_minecraft';
$password='cat2mc_minecraft';
$dbname = "cats";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
   die('Could not Connect My Sql:' .mysql_error());
}

/*$dbname2 = "users";
$conn2=mysqli_connect($servername,$username,$password,"$dbname2");
if(!$conn2){
   die('Could not Connect My Sql:' .mysql_error());
}*/
?>