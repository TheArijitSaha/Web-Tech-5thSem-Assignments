<?php
include('classes/DataBase.php');
include('variables.php');

if (isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (DataBase::query('SELECT email FROM ASARGUsers WHERE email=:email', array(':email'=>$email)))
    {
        if (password_verify($password, DataBase::query('SELECT password FROM ASARGUsers WHERE email=:email', array(':email'=>$email))[0]['password']))
        {
            $cstrong = True;
            $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
            $user_id = DataBase::query('SELECT id FROM ASARGUsers WHERE email=:email', array(':email'=>$email))[0]['id'];
            DataBase::query('INSERT INTO '.$token_table_name.' VALUES (DEFAULT, :token, :userid)', array(':token'=>sha1($token), ':userid'=>$user_id));
            setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/~'.$home_path.'/IIEST_Nexus', NULL, NULL, TRUE);
            setcookie("SNID_", $token, time() + 60 * 60 * 24 * 3, '/~'.$home_path.'/IIEST_Nexus', NULL, NULL, TRUE);
            header('url=temp.php');
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
?>
<h1>Login to your account</h1>
<form action="login.php" method="post">
<input type="text" name="email" value="" placeholder="EmailId ..."><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="submit" name="login" value="Login">
</form>
