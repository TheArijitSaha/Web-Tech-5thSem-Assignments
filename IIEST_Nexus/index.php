<?php
include('./classes/DataBase.php');
include('./classes/LoginClass.php');

if (LoginClass::isLoggedIn())
{
    header("Location: temp.php");
    exit;
}
else
{
    header("Location: create_acct.php");
    exit;
}
?>
