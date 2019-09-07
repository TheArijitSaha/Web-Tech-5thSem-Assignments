<?php
require_once('./classes/LoginClass.php');

echo (LoginClass::isLoggedIn()?"Logged In":"Logged Out");
echo "<p></p>";
?>
