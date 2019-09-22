<?php
require_once("./classes/DataBase.php");
require_once("./classes/LoginClass.php");
require_once("./classes/variables.php");

if( (LoginClass::isLoggedIn()) && (isset($_POST['logout'])) )
{
    if(isset($_COOKIE['SNID']))
    {
        DataBase::query('DELETE FROM '.DataBase::$token_table_name.' WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));

        setcookie("SNID",'',time()-7000000,NetworkVariables::$cookie_path);
        if(isset($_COOKIE['SNID_']))
        {
            setcookie("SNID_",'',time()-7000000,NetworkVariables::$cookie_path);
        }
    }
    header('Location: welcome.php');
}
else
{
    header('Location: welcome.php');
}

?>
