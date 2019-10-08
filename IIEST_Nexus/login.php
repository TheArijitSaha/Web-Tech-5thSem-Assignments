<?php
require_once('classes/DataBase.php');
require_once('classes/variables.php');

if(isset($_POST['login']))
{
    $email              = $_POST['loginuser'];
    $password           = $_POST['loginpass'];

    if (DataBase::query('SELECT email FROM '.DataBase::$user_table_name.' WHERE email=:email', array(':email'=>$email))["executed"])
    {
        if (password_verify($password, DataBase::query('SELECT password FROM '.DataBase::$user_table_name.' WHERE email=:email', array(':email'=>$email))["data"][0]['password']))
        {
            $crypto_strong = True;
            $token = bin2hex(openssl_random_pseudo_bytes(64, $crypto_strong));
            $user_id = DataBase::query('SELECT id FROM '.DataBase::$user_table_name.' WHERE email=:email', array(':email'=>$email))['data'][0]['id'];
            DataBase::query('INSERT INTO '.DataBase::$token_table_name.' VALUES (DEFAULT, :token, :userid)',
                            array(':token'=>sha1($token), ':userid'=>$user_id));
            setcookie("SNID", $token, time() + 60*60*24*7, NetworkVariables::$cookie_path, NULL, NULL, TRUE);
            setcookie("SNID_", $token, time() + 60*60*24*3, NetworkVariables::$cookie_path, NULL, NULL, TRUE);
            header('Location: feed.php');
        }
        else
        {
            echo 'Incorrect Password!';
        }
    }
    else
    {
        echo 'User not registered!';
    }
}
else
{
    header('Location: welcome.php');
}

?>
