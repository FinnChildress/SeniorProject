<?php
function removeImgBG($imgName) {
    $url = "https://api.remove.bg/v1.0/removebg";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'x-api-key:iSKuVrLTGXpMNgDphLhAPAf4',
    ]);

    // move image_url here:
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'image_url' => "https://www.cat2mc.xyz/images/$imgName",
    ]);

    $server_output = curl_exec($ch);
    curl_close($ch);

    $no_jpeg =  pathinfo($imgName)['filename'];
    $final_name = "images/$no_jpeg-nobg.jpg";
    file_put_contents($final_name, $server_output);

    return $final_name;
}

function getMainColors($colorNames, $colorPercents) {

    $weights = [
        "black" => 0.0,
        "gray" => 0.0,
        "silver" => 0.0,
        "white" => 0.0,
        "brown" => 0.0,
        "orange" => 0.0,
        "creamy" => 0.0,
        "other" => 0.0,
    ];



    for ($i = 0; $i < count($colorNames); $i++) {
        $weights[$colorNames[$i]] += $colorPercents[$i];
    }


    $primary = "other";
    $secondary = "other";

    foreach ($weights as $color=>$percent) {
        if ($percent > $weights[$primary]) {
            $secondary = $primary;
            $primary = $color; 
        }
        elseif ($percent > $weights[$secondary]) {
            $secondary = $color;
        }
    }

    return array(array($primary, $secondary), array($weights[$primary], $weights[$secondary]));

}





function getCatFromColors($primary_color, $primary_percentage, $secondary_color, $secondary_percentage) {
    $cat = "black";
    
    if ($primary_color == "black") {

        if ($secondary_color == "white" && $secondary_percentage > 0.01) {
            $cat = "tuxedo";
        }

        else if ($secondary_color == "orange" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "creamy" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "brown" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }
    }
    
    else if ($primary_color == "gray") {
        $cat = "jellie";

        if ($secondary_color == "silver" && $secondary_percentage > 0.05) {
            $cat = "siamese";
        }

        else if ($secondary_color == "orange" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        if ($primary_percentage > 0.30) {
            $cat = "british_shorthair";
        }
    }
    
    else if ($primary_color == "silver") {
        $cat = "british_shorthair";

        if ($secondary_color == "black" && $secondary_percentage > 0.05) {
            $cat = "siamese";
        }

        else if ($secondary_color == "white" && $secondary_percentage > 0.05) {
            $cat = "ragdoll";
        }

        if ($secondary_color == "gray" && $secondary_percentage > 0.05) {
            $cat = "jellie";
        }

        else if ($secondary_color == "orange" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "creamy" && $secondary_percentage > 0.05) {
            $cat = "persian";
        }
    }
    
    else if ($primary_color == "white") {
        $cat = "white";

        if ($secondary_color == "black" && $secondary_percentage > 0.05) {
            $cat = "siamese";
        }

        else if ($secondary_color == "silver" && $secondary_percentage > 0.05) {
            $cat = "ragdoll";
        }

        if ($secondary_color == "gray" && $secondary_percentage > 0.05) {
            $cat = "jellie";
        }

        else if ($secondary_color == "orange" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "creamy" && $secondary_percentage > 0.05) {
            $cat = "persian";
        }
    }
    
    else if ($primary_color == "brown") {
        $cat = "tabby";

        if ($secondary_color == "white" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "silver" && $secondary_percentage > 0.05) {
            $cat = "persian";
        }

        if ($secondary_color == "gray" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "orange" && $secondary_percentage > 0.05) {
            $cat = "red";
        }
    }
    
    else if ($primary_color == "brown") {
        $cat = "tabby";

        if ($secondary_color == "white" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "silver" && $secondary_percentage > 0.05) {
            $cat = "persian";
        }

        if ($secondary_color == "gray" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }

        else if ($secondary_color == "orange" && $secondary_percentage > 0.05) {
            $cat = "red";
        }
    }
    
    else if ($primary_color == "orange") {
        $cat = "red";

        if ($secondary_color == "gray" && $secondary_percentage > 0.05) {
            $cat = "calico";
        }
    }
    
    else if ($primary_color == "creamy") {
        $cat = "persian";

        if ($secondary_color == "orange" && $secondary_percentage > 0.05) {
            $cat = "red";
        }

        if ($secondary_color == "brown" && $secondary_percentage > 0.05) {
            $cat = "tabby";
        }
    }

    return $cat;

}



//echo removeImgBG("cat3.jpg");

?> 