<?php

$num_results = (! empty($_POST['num_results'])) ? $_POST['num_results'] : 10;
$delta = (! empty($_POST['delta'])) ? $_POST['delta'] : 30;
$reduce_brightness = false;//(isset($_POST['reduce_brightness'])) ? $_POST['reduce_brightness'] : 1;
$reduce_gradients = true;//(isset($_POST['reduce_gradients'])) ? $_POST['reduce_gradients'] : 1;

include_once("colors.inc.php");
include_once("test1.php");
include_once("hex2name.php");
$ex=new GetMostCommonColors();
$colors=$ex->Get_Color("test.jpg", $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <link rel="stylesheet" href="minecraft-style.css">
	<link href="favicon.ico" rel="icon" type="image/x-icon" />
    <title>Cat 2 MC</title>
    <style type="text/css">
        * {margin: 0; padding: 0}
        body {text-align: center;}
        form, div#wrap {margin: 10px auto; text-align: left; position: relative; width: 600px}
        fieldset {padding: 20px;}
        img {width: 150px;}
        table {border-collapse: collapse;}
        td {padding: 2px 5px; white-space: nowrap;}
        br {width: 100%; height: 1px; clear: both; }
    </style>
</head>
<body>
<div id="wrap">
	<h1>Welcome to Cat 2 MC!</h1></br>
<form action="#" method="post" enctype="multipart/form-data">
<fieldset>
<legend>Upload Your Own Cat</legend>
<div>
    <label>Image of your cat: <input type="file" name="imgFile" /></label></br>
    (Max size of 2MB)
</div>
<br>
<div>
    <input class="button" type="submit" name="action" value="Process" />
</div>
</fieldset>
</form>
<?php
$arrow = "mc_cats/Arrow.png";
// was any file uploaded?
if ( isset( $_FILES['imgFile']['tmp_name'] ) && strlen( $_FILES['imgFile']['tmp_name'] ) > 0 )
{

    // move image to a writable directory
    if (! move_uploaded_file($_FILES['imgFile']['tmp_name'], 'images/'.$_FILES['imgFile']['name']))
    {
        die("Error moving uploaded file to images directory");
    }
    //echo $_FILES['imgFile']['name'];
    /*if ( pathinfo( $_FILES['imgFile']['name'] )['extension'] != "jpg") {
        die("Only .jpg files are accepted!");

    }*/
    $nobgName = removeImgBG($_FILES['imgFile']['name']);
    //echo $nobgName;
    $colors=$ex->Get_Color( $nobgName, $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<table><!-- 
<tr><td>Color</td><td>Color Code</td><td>Percentage</td><td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"><img src="<?php echo $nobgName;?>" alt="test image" /></td></tr> -->
<?php
$colorNames = array();
$colorPercents = array();
foreach ( $colors as $hex => $count )
{
    if ( $count > 0 )
    {
        if ($hex != "000000") {
            $colorName = getColorFromHex($hex);
            array_push($colorNames, $colorName);
            array_push($colorPercents, $count);
            //echo "<tr><td style=\"background-color:#".$hex.";\"></td><td>".$colorName."</td><td>$count</td></tr>";
        }
    }
}
$main_colors = getMainColors($colorNames, $colorPercents);
$primary_color = $main_colors[0][0];
$primary_percentage = $main_colors[1][0];
$secondary_color = $main_colors[0][1];
$secondary_percentage = $main_colors[1][1];

$cat = getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage);

//echo "Primary Color: ".$primary_color."<br>".$primary_percentage;
//echo "<br> Secondary Color: ".$secondary_color."<br>".$secondary_percentage;
//echo "<br> <br> Cat: ".$cat;
$mc_cat_img = "mc_cats/".$cat.".png";

session_start();


$_SESSION['nobgName'] = $nobgName;
$_SESSION['mc_cat_img']   = $mc_cat_img;
$_SESSION['cat'] = $cat;

echo '<br /><a href="details.php">page 2</a>';

echo $nobgName;
echo $mc_cat_img;

//PHP redirect
header("Location: /details.php");
die();

?>
	<tr>
		<img  src="<?php echo $nobgName;?>" alt="test image" />
		<img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
		<img  src="<?php echo $mc_cat_img; ?>" />
	</tr>
</table>
<br />
<?php
}
?>




	</br>
	<h3>Examples:</h3></br>







<?php // SHOWCASE ---------------------------------------
$nobgName = "images/test-nobg.jpg"; //removeImgBG("test.jpg");
//echo $nobgName;
$colors=$ex->Get_Color($nobgName, $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<table><!-- 
<tr><td>Color</td><td>Color Code</td><td>Percentage</td><td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"><img src="<?php echo $nobgName;?>" alt="test image" /></td></tr> -->
<?php
$colorNames = array();
$colorPercents = array();
foreach ( $colors as $hex => $count )
{
    if ( $count > 0 )
    {
        if ($hex != "000000") {
            $colorName = getColorFromHex($hex);
            array_push($colorNames, $colorName);
            array_push($colorPercents, $count);
            //echo "<tr><td style=\"background-color:#".$hex.";\"></td><td>".$colorName."</td><td>$count</td></tr>";
        }
    }
}
$main_colors = getMainColors($colorNames, $colorPercents);
$primary_color = $main_colors[0][0];
$primary_percentage = $main_colors[1][0];
$secondary_color = $main_colors[0][1];
$secondary_percentage = $main_colors[1][1];

$cat = getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage);

/*echo "Primary Color: ".$primary_color."<br>".$primary_percentage;
echo "<br> Secondary Color: ".$secondary_color."<br>".$secondary_percentage;
echo "<br> <br> Cat: ".$cat;*/
$mc_cat_img = "mc_cats/".$cat.".png";

/*session_start();


$_SESSION['nobgName'] = $nobgName;
$_SESSION['mc_cat_img']   = $mc_cat_img;

echo '<br /><a href="details.php?' . SID . '">page 2</a>';*/
?>
	<tr>
		<img  src="<?php echo $nobgName;?>" alt="test image" />
		<img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
		<img  src="<?php echo $mc_cat_img; ?>" />
	</tr>
</table>
<br />



<?php
$nobgName = "images/test-nobg-old.jpg"; //removeImgBG("cat3.jpg");
//echo $nobgName;
$colors=$ex->Get_Color($nobgName, $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<table><!-- 
<tr><td>Color</td><td>Color Code</td><td>Percentage</td><td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"><img src="<?php echo $nobgName;?>" alt="test image" /></td></tr> -->
<?php
$colorNames = array();
$colorPercents = array();
foreach ( $colors as $hex => $count )
{
    if ( $count > 0 )
    {
        if ($hex != "000000") {
            $colorName = getColorFromHex($hex);
            array_push($colorNames, $colorName);
            array_push($colorPercents, $count);
            //echo "<tr><td style=\"background-color:#".$hex.";\"></td><td>".$colorName."</td><td>$count</td></tr>";
        }
    }
}
$main_colors = getMainColors($colorNames, $colorPercents);
$primary_color = $main_colors[0][0];
$primary_percentage = $main_colors[1][0];
$secondary_color = $main_colors[0][1];
$secondary_percentage = $main_colors[1][1];

$cat = getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage);

//echo "Primary Color: ".$primary_color."<br>".$primary_percentage;
//echo "<br> Secondary Color: ".$secondary_color."<br>".$secondary_percentage;
//echo "<br> <br> Cat: ".$cat;
$mc_cat_img = "mc_cats/".$cat.".png";

?>
	<tr>
		<img  src="<?php echo $nobgName;?>" alt="test image" />
		<img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
		<img  src="<?php echo $mc_cat_img; ?>" />
	</tr>
</table>
<br />

<?php
$nobgName = "images/cat2-nobg.jpg"; //removeImgBG("cat2.jpg");
//echo $nobgName;
$colors=$ex->Get_Color($nobgName, $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<table><!-- 
<tr><td>Color</td><td>Color Code</td><td>Percentage</td><td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"><img src="<?php echo $nobgName;?>" alt="test image" /></td></tr> -->
<?php
$colorNames = array();
$colorPercents = array();
foreach ( $colors as $hex => $count )
{
    if ( $count > 0 )
    {
        if ($hex != "000000") {
            $colorName = getColorFromHex($hex);
            array_push($colorNames, $colorName);
            array_push($colorPercents, $count);
            //echo "<tr><td style=\"background-color:#".$hex.";\"></td><td>".$colorName."</td><td>$count</td></tr>";
        }
    }
}
$main_colors = getMainColors($colorNames, $colorPercents);
$primary_color = $main_colors[0][0];
$primary_percentage = $main_colors[1][0];
$secondary_color = $main_colors[0][1];
$secondary_percentage = $main_colors[1][1];

$cat = getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage);

//echo "Primary Color: ".$primary_color."<br>".$primary_percentage;
//echo "<br> Secondary Color: ".$secondary_color."<br>".$secondary_percentage;
//echo "<br> <br> Cat: ".$cat;
$mc_cat_img = "mc_cats/".$cat.".png";

?>
	<tr>
		<img  src="<?php echo $nobgName;?>" alt="test image" />
		<img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
		<img  src="<?php echo $mc_cat_img; ?>" />
	</tr>
</table>
<br />

<?php
$nobgName = "images/cat3-nobg.jpg"; //removeImgBG("cat3.jpg");
//echo $nobgName;
$colors=$ex->Get_Color($nobgName, $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<table><!-- 
<tr><td>Color</td><td>Color Code</td><td>Percentage</td><td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"><img src="<?php echo $nobgName;?>" alt="test image" /></td></tr> -->
<?php
$colorNames = array();
$colorPercents = array();
foreach ( $colors as $hex => $count )
{
    if ( $count > 0 )
    {
        if ($hex != "000000") {
            $colorName = getColorFromHex($hex);
            array_push($colorNames, $colorName);
            array_push($colorPercents, $count);
            //echo "<tr><td style=\"background-color:#".$hex.";\"></td><td>".$colorName."</td><td>$count</td></tr>";
        }
    }
}
$main_colors = getMainColors($colorNames, $colorPercents);
$primary_color = $main_colors[0][0];
$primary_percentage = $main_colors[1][0];
$secondary_color = $main_colors[0][1];
$secondary_percentage = $main_colors[1][1];

$cat = getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage);

//echo "Primary Color: ".$primary_color."<br>".$primary_percentage;
//echo "<br> Secondary Color: ".$secondary_color."<br>".$secondary_percentage;
//echo "<br> <br> Cat: ".$cat;
$mc_cat_img = "mc_cats/".$cat.".png";

?>
	<tr>
		<img  src="<?php echo $nobgName;?>" alt="test image" />
		<img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
		<img  src="<?php echo $mc_cat_img; ?>" />
	</tr>
</table>
<br />

<?php
$nobgName = "images/Salem-nobg.jpg"; //removeImgBG("cat4.jpg");
//echo $nobgName;
$colors=$ex->Get_Color($nobgName, $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<table><!-- 
<tr><td>Color</td><td>Color Code</td><td>Percentage</td><td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"><img src="<?php echo $nobgName;?>" alt="test image" /></td></tr> -->
<?php
$colorNames = array();
$colorPercents = array();
foreach ( $colors as $hex => $count )
{
    if ( $count > 0 )
    {
        if ($hex != "000000") {
            $colorName = getColorFromHex($hex);
            array_push($colorNames, $colorName);
            array_push($colorPercents, $count);
            //echo "<tr><td style=\"background-color:#".$hex.";\"></td><td>".$colorName."</td><td>$count</td></tr>";
        }
    }
}
$main_colors = getMainColors($colorNames, $colorPercents);
$primary_color = $main_colors[0][0];
$primary_percentage = $main_colors[1][0];
$secondary_color = $main_colors[0][1];
$secondary_percentage = $main_colors[1][1];

$cat = getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage);

//echo "Primary Color: ".$primary_color."<br>".$primary_percentage;
//echo "<br> Secondary Color: ".$secondary_color."<br>".$secondary_percentage;
//echo "<br> <br> Cat: ".$cat;
$mc_cat_img = "mc_cats/".$cat.".png";

?>
	<tr>
		<img  src="<?php echo $nobgName;?>" alt="test image" />
		<img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
		<img  src="<?php echo $mc_cat_img; ?>" />
	</tr>
</table>
<br />

<?php
$nobgName = "images/cat5-nobg.jpg"; //removeImgBG("cat5.jpg");
//echo $nobgName;
$colors=$ex->Get_Color($nobgName, $num_results, $reduce_brightness, $reduce_gradients, $delta);
?>
<table><!-- 
<tr><td>Color</td><td>Color Code</td><td>Percentage</td><td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"><img src="<?php echo $nobgName;?>" alt="test image" /></td></tr> -->
<?php
$colorNames = array();
$colorPercents = array();
foreach ( $colors as $hex => $count )
{
    if ( $count > 0 )
    {
        if ($hex != "000000") {
            $colorName = getColorFromHex($hex);
            array_push($colorNames, $colorName);
            array_push($colorPercents, $count);
            //echo "<tr><td style=\"background-color:#".$hex.";\"></td><td>".$colorName."</td><td>$count</td></tr>";
        }
    }
}
$main_colors = getMainColors($colorNames, $colorPercents);
$primary_color = $main_colors[0][0];
$primary_percentage = $main_colors[1][0];
$secondary_color = $main_colors[0][1];
$secondary_percentage = $main_colors[1][1];

$cat = getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage);

//echo "Primary Color: ".$primary_color."<br>".$primary_percentage;
//echo "<br> Secondary Color: ".$secondary_color."<br>".$secondary_percentage;
//echo "<br> <br> Cat: ".$cat;
$mc_cat_img = "mc_cats/".$cat.".png";

?>
	<tr>
		<img  src="<?php echo $nobgName;?>" alt="test image" />
		<img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
		<img  src="<?php echo $mc_cat_img; ?>" />
	</tr>
</table>
<br />





</div>
</body>
</html>
