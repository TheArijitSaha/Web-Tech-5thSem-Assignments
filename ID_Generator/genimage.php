<?php
session_start();

header("Content-type: image/png");

function CourseTime($course){
    if($course == "B.TECH.")
        return 4;
    else if($course=="M.TECH.")
        return 2;
    else if($course=="Dual Degree")
        return 5;
    else if($course=="M.Sc.")
        return 2;
    return 0;
}

$im=imagecreatefrompng("ID_Template.png");

$black = imagecolorallocate($im, 0, 0, 0);
imagestring($im, 2, 75, 52, $_SESSION["name"], $black);

imagestring($im, 2, 75, 67, $_SESSION["course"], $black);

$asd = date("d-m-Y",strtotime($_SESSION["dob"]));
imagestring($im, 2, 236, 67, $asd, $black);

imagestring($im, 2, 75, 82, $_SESSION["yoj"], $black);

imagestring($im, 2, 236, 82, $_SESSION["bloodgroup"], $black);

imagestring($im, 2, 75, 97, $_SESSION["gender"], $black);

$yog = $_SESSION["yoj"]+CourseTime($_SESSION["course"]);
imagestring($im, 2, 75, 112, $yog, $black);

$sepaddress=wordwrap($_SESSION["address"], 28, "\n");
$divaddress=explode("\n",$sepaddress);
$ind=127;
foreach($divaddress as $lineaddress)
{
    imagestring($im, 2, 75, $ind, $lineaddress, $black);
    $ind=$ind+15;
}

$source = imagecreatefromjpeg($_SESSION["profile"]);
list($width,$height)=getimagesize($_SESSION["profile"]);
imagecopyresampled($im,$source,246,112,0,0,75,75,$width,$height);

imagepng($im);
imagedestroy($im);

session_unset();
session_destroy();
?>
