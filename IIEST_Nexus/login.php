<?php
require_once('classes/DataBase.php');
require_once('variables.php');

if(isset($_POST['login']))
{
    $email              = $_POST['loginuser'];
    $password           = $_POST['loginpass'];
    if (DataBase::query('SELECT email FROM '.$user_table_name.' WHERE email=:email', array(':email'=>$email)))
    {
        if (password_verify($password, DataBase::query('SELECT password FROM '.$user_table_name.' WHERE email=:email', array(':email'=>$email))[0]['password']))
        {
            echo $email;
            echo $password;
            $crypto_strong = True;
            $token = bin2hex(openssl_random_pseudo_bytes(64, $crypto_strong));
            $user_id = DataBase::query('SELECT id FROM '.$user_table_name.' WHERE email=:email', array(':email'=>$email))[0]['id'];
            DataBase::query('INSERT INTO '.$token_table_name.' VALUES (DEFAULT, :token, :userid)',
                            array(':token'=>sha1($token), ':userid'=>$user_id));
            setcookie("SNID", $token, time() + 60*60*24*7, '/~'.$home_path.'/IIEST_Nexus', NULL, NULL, TRUE);
            setcookie("SNID_", $token, time() + 60*60*24*3, '/~'.$home_path.'/IIEST_Nexus', NULL, NULL, TRUE);
            header('Location: temp.php');
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
else {
    echo "nahi Hua";
}
?>
