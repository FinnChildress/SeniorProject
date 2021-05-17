<?php

if(isset($_POST['save']))
{	 
	$cat = $_POST['ans'];//username_to_uuid($_POST['mc_username']);

	//echo $cat;

	$mc_cat_img = "mc_cats/".$cat.".png";

	session_start();


	$_SESSION['mc_cat_img']   = $mc_cat_img; 
	$_SESSION['cat'] = $cat;
	header("Location: /details.php");
}






?>