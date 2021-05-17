<html>
<head>

<?php
  function colorline($r, $g, $b, $name) {
    return "<tr><td>$name <td>($r $g $b) <td>" . colorswatch($r, $g, $b) . "\n";
  }
  function colorswatch($r, $g, $b) {
    return "<span style='background: rgb($r, $g, $b);'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
  }

function find_in_file($colorfile, $hex) {
  $r = "";
  $g = "";
  $b = "";
  # hex is a code like fff or 11aa77. Split it into r, g and b:
  $len = strlen($hex);
  if ($len == 3) {
    $r = hexdec($hex[0]); $r *= 17;
    $g = hexdec($hex[1]); $g *= 17;
    $b = hexdec($hex[2]); $b *= 17;
  }
  else if ($len == 6) {
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
  }
  else {
    $r = $_GET['r'];
    $g = $_GET['g'];
    $b = $_GET['b'];
  }
  $len = strlen($hex);
  $nmatches = 0;
  $dist = 255 * sqrt(3.0);  # start with longest possible distance
  $fp = fopen($colorfile, 'r');
  if ($fp) {
    while (!feof($fp)) {
       $line = fgets($fp);
       if ($line[0] != '!') {
         list($r1, $g1, $b1, $name) = sscanf($line, "%d %d %d %s");
	 if ($r1 == $r && $g1 == $g && $b1 == $b) {
	   print(colorline($r1, $g1, $b1, $name));
	   ++$nmatches;
	   $dist == 0;
	 }
	 if ($nmatches == 0) {
	   # if no exact match yet, see if it's closer than what
	   # we've seen before. 
	   $newdist = sqrt(pow($r-$r1, 2) + pow($g-$g1, 2) + pow($b-$b1, 2));
	   if ($newdist == $dist) {
	     $matches = $matches . colorline($r1, $g1, $b1, $name);
	   } else if ($newdist < $dist) {
	     $dist = $newdist;
	     $matches = colorline($r1, $g1, $b1, $name);
	   }
	 }
       }
    }
    fclose($fp);
    if ($nmatches == 0) {
      print("<tr>");
      print("<td colspan=2>No exact match found for ($r $g $b)\n<td>");
      print(colorswatch($r, $g, $b));
      print("<tr><th colspan=3>Closest matches:");
      print($matches);
    }
  }
}

function return_colors_from_find_in_file($colorfile, $hex) {
  $r = "";
  $g = "";
  $b = "";
  $matches = "gray";
  # hex is a code like fff or 11aa77. Split it into r, g and b:
  $len = strlen($hex);
  if ($len == 3) {
    $r = hexdec($hex[0]); $r *= 17;
    $g = hexdec($hex[1]); $g *= 17;
    $b = hexdec($hex[2]); $b *= 17;
  }
  else if ($len == 6) {
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
  }
  else {
    $r = $_GET['r'];
    $g = $_GET['g'];
    $b = $_GET['b'];
  }
  $len = strlen($hex);
  $nmatches = 0;
  $dist = 255 * sqrt(3.0);  # start with longest possible distance
  $fp = fopen($colorfile, 'r');
  if ($fp) {
    while (!feof($fp)) {
       $line = fgets($fp);
       if ($line[0] != '!') {
         list($r1, $g1, $b1, $name) = sscanf($line, "%d %d %d %s");
   if ($r1 == $r && $g1 == $g && $b1 == $b) {
     return $name;
     //print(colorline($r1, $g1, $b1, $name));
     ++$nmatches;
     $dist == 0;
   }
   if ($nmatches == 0) {
     # if no exact match yet, see if it's closer than what
     # we've seen before. 
     $newdist = sqrt(pow($r-$r1, 2) + pow($g-$g1, 2) + pow($b-$b1, 2));
     if ($newdist == $dist) {
       $matches = $name;//$matches . colorline($r1, $g1, $b1, $name);
     } else if ($newdist < $dist) {
       $dist = $newdist;
       $matches = $name;//colorline($r1, $g1, $b1, $name);
     }
   }
       }
    }
    fclose($fp);
    if ($nmatches == 0) {
      //print("<tr>");
     // print("<td colspan=2>No exact match found for ($r $g $b)\n<td>");
      //print(colorswatch($r, $g, $b));
      //print("<tr><th colspan=3>Closest matches:");
      //print($matches);
      if ($matches == "") {
        return "gray";
      }
      return $matches;
    }
  }
}

?>

</head>

<body>

<?php

  //print("<h2>Matches in CSS color list:</h2><table>\n");
  //echo return_colors_from_find_in_file ("csscolors.txt", "909090");

  function getColorFromHex($hexval) {
    return return_colors_from_find_in_file ("csscolors.txt", $hexval);
  }
  
?>
</table>


</body>
</html>