<?php
include_once 'database.php';
include_once 'mc-api.php';

if(isset($_POST['save']))
{	 
	$mc_username = $_POST['mc_username'];//username_to_uuid($_POST['mc_username']);
	$owner_uuid = username_to_uuid($_POST['mc_username']);

	$breed = $_POST['breed'];
	$cat_name = $_POST['cat_name'];
	$color = $_POST['color'];

	$baby = 0;
	if(isset($_POST['baby']) && $_POST['baby'] == 'on') 
	{
		$baby = 1;
	}

	$email = $_POST['email'];

	if($email != "")
	{

		$sql2 = "INSERT INTO users (email)
		VALUES ('$email')";
		if (mysqli_query($conn, $sql2)) {

	    	session_start();
			$_SESSION['email'] = $email; 
		    
		} else {
		echo "Error: " . $sql2 . "
		" . mysqli_error($conn);
		}
		//mysqli_close($conn);
	}
	/*echo $breed;
	echo $cat_name;
	echo $color;
	echo $mc_username;
	echo $owner_uuid;
	echo $baby;*/

	$sql = "INSERT INTO playercats (owner_uuid,cat_name,breed,baby,color)
	VALUES ('$owner_uuid','$cat_name','$breed','$baby','$color')";
	if (mysqli_query($conn, $sql)) {

	    session_start();
		$_SESSION['cat_name'] = $cat_name; 
		$_SESSION['mc_username'] = $mc_username; 
		$_SESSION['cat_breed'] = $breed;

		submissionSuccess();
	} else {
	echo "Error: " . $sql . "
	" . mysqli_error($conn);
	}
	mysqli_close($conn);
}




function submissionSuccess() {

	echo "New record created successfully !";

	//PHP redirect
	header("Location: /success.php");
	die();

}

















?>