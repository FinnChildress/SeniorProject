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
        form, div#wrap {margin: 10px auto; text-align: left; position: relative; width: 800px}
        fieldset {padding: 20px; border: solid #999 2px;}
        img {width: 150px;}
        table {border: solid #000 1px; border-collapse: collapse;}
        td {border: solid #000 1px; padding: 2px 5px; white-space: nowrap;}
        br {width: 100%; height: 1px; clear: both; }
    </style>
</head>
<body>
    <style>
    /*.row {
      display: inline-block;
    }*/
    /*.column {
      display: inline-block;
}
    .column2 {
  padding: 5px;
}*/
.row * {
    display: inline;
    float: left;
}

.radio4 {
    width: 1.5em;
    height: 1.5em;
    background-color: #444;
}

    </style>
<div id="wrap">
    <input type="button" value="Home" class="button" id="btnHome" 
        onClick="document.location.href='/index.php'" />
    </br>
    </br>
    <?php
    //echo '<br /><button href="index.php">Back</a><br />';

    session_start();

    $nobgName = $_SESSION['nobgName']; 
    $mc_cat_img = $_SESSION['mc_cat_img'];   
    $cat = $_SESSION['cat'];   
    //echo $cat;
    $arrow = "mc_cats/Arrow.png";

    //echo $nobgName;
    //echo $mc_cat_img;
    ?>
    <table>

        <tr>
            <div class="row">
                <img  src="<?php echo $nobgName;?>" alt="test image" />
                <img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
                <div>
                    <form action="made_new_choice.php" method="post">                      
                        <img  src="mc_cats/british_shorthair.png" /> <input class="radio4" type="radio" name="ans" value="british_shorthair" /><br />
                        <img  src="mc_cats/black.png" /> <input class="radio4" type="radio" name="ans" value="black"  /><br />
                        <img  src="mc_cats/calico.png" />  <input class="radio4" type="radio" name="ans" value="calico"  /><br />
                        <img  src="mc_cats/jellie.png" />  <input class="radio4" type="radio" name="ans" value="jellie"  /><br />
                        <img  src="mc_cats/persian.png" />  <input class="radio4" type="radio" name="ans" value="persian"  /><br />
                        <img  src="mc_cats/ragdoll.png" />  <input class="radio4" type="radio" name="ans" value="ragdoll"  /><br />
                        <img  src="mc_cats/red.png" />  <input class="radio4" type="radio" name="ans" value="red"  /><br />
                        <img  src="mc_cats/siamese.png" />  <input class="radio4" type="radio" name="ans" value="siamese"  /><br />
                        <img  src="mc_cats/tabby.png" />  <input class="radio4" type="radio" name="ans" value="tabby"  /><br />
                        <img  src="mc_cats/tuxedo.png" />  <input class="radio4" type="radio" name="ans" value="tuxedo"  /><br />
                        <img  src="mc_cats/white.png" />  <input class="radio4" type="radio" name="ans" value="white"  /><br />
                        <input class="button" type="submit" name="save" value="Submit">
                    </form>
      
                </div>
            </div>
        </tr>
    </table>
    <br />


    


</div>
    
</body>
</html>
