<!DOCTYPE html>

<?php

header("Content-type: image/png");
$string = $_GET['name'];
$im     = imagecreatefrompng("images/button1.png");
$orange = imagecolorallocate($im, 220, 210, 60);
$px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
imagestring($im, 3, $px, 9, $string, $orange);
imagepng($im);
imagedestroy($im);

?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Image</title>
    </head>
    <body>
        
    </body>
</html>
