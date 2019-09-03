<?php
require_once('classes/DataBase.php');
require_once('login.php');

if (isset($_POST['signup']))
{
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $dob= date_create($_POST['dob']);
    $dob= date_format($dob,"Y/m/d");
    $id='0';
    if (!DataBase::query('SELECT email FROM ASARGUsers WHERE email=:email', array(':email'=>$email)))
    {
        if (preg_match("/^[a-zA-Z'. -]+$/", $name))
        {
            if ((strlen($password)) >= 6 && (strlen($password)<=60))
            {
                if (filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    DataBase::query('INSERT INTO ASARGUsers VALUES (:name,:email,:dob,DEFAULT,:password)', array(':name'=>$name,':email'=>$email,':dob'=>$dob,':password'=>password_hash($password, PASSWORD_BCRYPT)));
                    echo "Success!";
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
        exit;
    }
}
else
{
    header('Location: welcome.php');
}
?>
