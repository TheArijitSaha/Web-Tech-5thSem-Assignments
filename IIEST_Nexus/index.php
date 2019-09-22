<?php

require_once("classes/LoginClass.php");
echo "hua";
if (LoginClass::isLoggedIn())
{
    header("Location: feed.php");
    exit();
}
else
{
    header("Location: welcome.php");
    exit();
}

?>
