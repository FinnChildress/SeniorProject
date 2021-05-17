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
    $cat_name = $_SESSION['cat_name']; 
    $mc_username = $_SESSION['mc_username'];
    $email = $_SESSION['email'];
    //echo $cat;
    $arrow = "mc_cats/Arrow.png";

    //echo "|$email|";
    ?>
    <table>

        <tr>
            <img  src="<?php echo $nobgName;?>" alt="test image" />
            <img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
            <img  src="<?php echo $mc_cat_img; ?>" />
        </tr>
    </table>
    <br />
    Successfully added the cat named <?php echo $cat_name; ?> to the Minecraft user: <?php echo $mc_username; ?>!
    <br><br>
        In-Game Traits Preview: 
        <h5 id="health">Health: 3</h5> 
        <h5 id="shedding">Shedding: 3</h5> 
        <h5 id="vocalization">Vocalization: 3</h5> 
        <h5 id="affection">Affection: 3</h5> 
        <h5 id="aggression">Aggression: 3</h5>
        <script src="breed_stats.js"></script>
        <script type="text/javascript">

            function updateBreed() {    
                var breedName = '<?php 
                                session_start();
                                $breed =$_SESSION['cat_breed'];
                                echo $breed; ?>'; 
                
                var breedStats = getBreed(breedName);
                
                document.getElementById("health").innerHTML  = "Health: "+breedStats[0];
                document.getElementById("shedding").innerHTML  = "Shedding: "+breedStats[1];
                document.getElementById("vocalization").innerHTML  = "Vocalization: "+breedStats[2];
                document.getElementById("affection").innerHTML  = "Affection: "+breedStats[3];
                document.getElementById("aggression").innerHTML  = "Aggression: "+breedStats[4];
            }

            updateBreed();
        </script>  
<br><br>
<h6><a href="https://cattime.com/cat-breeds" target="_blank">Breed Traits Source</a></h6>
<br><br><br>
<h5><a href="https://forms.gle/GzB9GaJqiHTghxkE9" target="_blank">Provide Feedback</a></h5>
</div>
</body>
</html>
