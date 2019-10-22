<?php
require_once('classes/DataBase.php');
require_once('classes/variables.php');

if (isset($_POST['signup']))
{
    $name       = $_POST['name'];
    $password   = $_POST['password'];
    $email      = $_POST['email'];
    $dob        = date_create($_POST['dob']);
    $dob        = date_format($dob,"Y/m/d");

    $query_result = DataBase::query('SELECT email FROM '.DataBase::$user_table_name.' WHERE email=:email', array(':email'=>$email));
    if ($query_result['executed']===false)
    {
        echo "ERROR: Could not able to execute SQL<br>";
        print_r($query_result['errorInfo']);
        exit();
    }

    if (count($query_result['data'])===0)
    {
        if (preg_match("/^[a-zA-Z'. -]+$/", $name))
        {
            if ((strlen($password)) >= 6 && (strlen($password)<=60))
            {
                if (filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    // Insert New Records into DataBase
                    DataBase::query('INSERT INTO '.DataBase::$user_table_name.' VALUES (:name,:email,:dob,DEFAULT,:password)',
                                    array(':name'=>$name,':email'=>$email,':dob'=>$dob,':password'=>password_hash($password, PASSWORD_BCRYPT)));

                    // Log the new user in and direct to feed
                    $crypto_strong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $crypto_strong));
                    $user_id = DataBase::query('SELECT id FROM '.DataBase::$user_table_name.' WHERE email=:email', array(':email'=>$email))['executed'][0]['id'];
                    DataBase::query('INSERT INTO '.DataBase::$token_table_name.' VALUES (DEFAULT, :token, :userid)',
                                    array(':token'=>sha1($token), ':userid'=>$user_id));
                    setcookie("SNID", $token, time() + 60*60*24*7, NetworkVariables::$cookie_path, NULL, NULL, TRUE);
                    setcookie("SNID_", $token, time() + 60*60*24*3, NetworkVariables::$cookie_path, NULL, NULL, TRUE);
                    header('Location: feed.php');
                }
                else
                {
                    echo "Invalid email";
                }
            }
            else
            {
                echo "Password should be atleast 6 characters long!";
            }
        }
        else
        {
            echo "Please enter your name correctly\nTip:Don't Use Numbers\n";
        }
    }
    else
    {
        header("refresh:5;url=login.php");
        echo "Email already registered\nRedirecting to login page";
        exit();
    }
}
else
{
    header('Location: welcome.php');
}
?>
