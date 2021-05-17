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
    //echo $cat;
    $arrow = "mc_cats/Arrow.png";

    //echo $nobgName;
    ?>
    <table>

        <tr>
            <img  src="<?php echo $nobgName;?>" alt="test image" />
            <img style= "max-width:20%; height:auto; padding:3%;" src="<?php echo $arrow;?>" alt="arrow" />
            <img  src="<?php echo $mc_cat_img; ?>" />
        </tr>
    </table>
    <br />
    Not the right cat color? <input type="button" value="Change Color Manually" class="button" id="selectNew" 
        onClick="document.location.href='/choose_cat.php'" />

    <br />
    <form method="post" action="process.php">
        Minecraft Username: 
        <input type="text" name="mc_username">
        <br><br>
        Name of Cat: 
        <input type="text" name="cat_name">
        <br><br>
        Baby/Kitten: 
        <input type="checkbox" name="baby">
        <br><br>
        Breed: 
        <select id="breedselect" name="breed" onchange="updateBreed()">
            <option value="Do Not Know">Do Not Know</option>
            <option value="Aphrodite Giant">Aphrodite Giant</option>
            <option value="Abyssinian">Abyssinian</option>
            <option value="Aegean">Aegean</option>
            <option value="American Bobtail">American Bobtail</option>
            <option value="Arabian Mau">Arabian Mau</option>
            <option value="American Curl">American Curl</option>
            <option value="Asian">Asian</option>
            <option value="American Shorthair">American Shorthair</option>
            <option value="Australian Mist">Australian Mist</option>
            <option value="American Wirehair">American Wirehair</option>
            <option value="Balinese">Balinese</option>
            <option value="Brazilian Shorthair">Brazilian Shorthair</option>
            <option value="Bambino">Bambino</option>
            <option value="British Longhair">British Longhair</option>
            <option value="Bengal Cats">Bengal Cats</option>
            <option value="British Shorthair">British Shorthair</option>
            <option value="Birman">Birman</option>
            <option value="Burmese">Burmese</option>
            <option value="Bombay">Bombay</option>
            <option value="Burmilla">Burmilla</option>
            <option value="California Spangled">California Spangled</option>
            <option value="Colorpoint Shorthair">Colorpoint Shorthair</option>
            <option value="Chantilly-Tiffany">Chantilly-Tiffany</option>
            <option value="Cornish Rex">Cornish Rex</option>
            <option value="Chartreux">Chartreux</option>
            <option value="Cymric">Cymric</option>
            <option value="Chausie">Chausie</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Chinese Li Hua">Chinese Li Hua</option>
            <option value="Desert Lynx">Desert Lynx</option>
            <option value="Devon Rex">Devon Rex</option>
            <option value="Donskoy">Donskoy</option>
            <option value="Egyptian Mau">Egyptian Mau</option>
            <option value="European Burmese">European Burmese</option>
            <option value="Exotic">Exotic</option>
            <option value="Foldex">Foldex</option>
            <option value="German Rex">German Rex</option>
            <option value="Havana Brown">Havana Brown</option>
            <option value="Highlander">Highlander</option>
            <option value="Himalayan">Himalayan</option>
            <option value="Javanese">Javanese</option>
            <option value="Japanese Bobtail">Japanese Bobtail</option>
            <option value="Khao Manee">Khao Manee</option>
            <option value="Korat">Korat</option>
            <option value="Kurilian Bobtail">Kurilian Bobtail</option>
            <option value="Lykoi">Lykoi</option>
            <option value="LaPerm">LaPerm</option>
            <option value="Maine Coon">Maine Coon</option>
            <option value="Manx">Manx</option>
            <option value="Mekong Bobtail">Mekong Bobtail</option>
            <option value="Norwegian Forest">Norwegian Forest</option>
            <option value="Nebelung">Nebelung</option>
            <option value="Napoleon">Napoleon</option>
            <option value="Ocicat">Ocicat</option>
            <option value="Oriental Bicolor">Oriental Bicolor</option>
            <option value="Oriental">Oriental</option>
            <option value="Pixie-Bob">Pixie-Bob</option>
            <option value="Peterbald">Peterbald</option>
            <option value="Persian">Persian</option>
            <option value="Ragamuffin">Ragamuffin</option>
            <option value="Ragdoll Cats">Ragdoll Cats</option>
            <option value="Russian Blue">Russian Blue</option>
            <option value="Savannah">Savannah</option>
            <option value="Scottish Fold">Scottish Fold</option>
            <option value="Selkirk Rex">Selkirk Rex</option>
            <option value="Serengeti">Serengeti</option>
            <option value="Siamese Cat">Siamese Cat</option>
            <option value="Somali">Somali</option>
            <option value="Sokoke">Sokoke</option>
            <option value="Snowshoe">Snowshoe</option>
            <option value="Singapura">Singapura</option>
            <option value="Siberian">Siberian</option>
            <option value="Sphynx">Sphynx</option>
            <option value="Thai">Thai</option>
            <option value="Thai Lilac">Thai Lilac</option>
            <option value="Tonkinese">Tonkinese</option>
            <option value="Toyger">Toyger</option>
            <option value="Turkish Angora">Turkish Angora</option>
            <option value="Ukrainian Levkoy">Ukrainian Levkoy</option>
            <option value="York Chocolate">York Chocolate</option>
        </select> 
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
                var breedName = document.getElementById('breedselect').value; 
                
                var breedStats = getBreed(breedName);
                
                document.getElementById("health").innerHTML  = "Health: "+breedStats[0];
                document.getElementById("shedding").innerHTML  = "Shedding: "+breedStats[1];
                document.getElementById("vocalization").innerHTML  = "Vocalization: "+breedStats[2];
                document.getElementById("affection").innerHTML  = "Affection: "+breedStats[3];
                document.getElementById("aggression").innerHTML  = "Aggression: "+breedStats[4];
            }
        </script>  
        <br><br>
        [OPTIONAL] Feedback Contact Email: 
        <input type="text" name="email">
        <br><br>
        <input type="hidden" name="color" value="<?php echo $cat; ?>" />
        <input class="button" type="submit" name="save" value="Submit">
    </form>
    <br><br><br>
    <h6><a href="https://cattime.com/cat-breeds" target="_blank">Breed Traits Source</a></h6>


</div>
</body>
</html>
