<?php
require_once('./classes/LoginClass.php');

if (LoginClass::isLoggedIn())
{
    header("Location: temp.php");
    exit();
}
else
{
    header("Location: welcome.php");
    exit();
}
?>
