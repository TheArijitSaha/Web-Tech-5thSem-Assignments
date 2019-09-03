<?php
include('classes/DB.php');
if (isset($_POST['createaccount'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $dob= date_create($_POST['dob']);
        $dob= date_format($dob,"Y/m/d");
        $id='0';

        if (!DB::query('SELECT email FROM ASARGUsers WHERE email=:email', array(':email'=>$email)))
        {
          if (preg_match("/^[a-zA-Z'. -]+$/", $name))
          {
            if (strlen($password) >= 6 && strlen($password) <= 60)
            {
              if (filter_var($email, FILTER_VALIDATE_EMAIL))
              {
                DB::query('INSERT INTO ASARGUsers VALUES (:name,:email,:dob,DEFAULT,:password)', array(':name'=>$name,':email'=>$email,':dob'=>$dob,':password'=>password_hash($password, PASSWORD_BCRYPT)));
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
          else {
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
?>

<h1>SIGN UP!!</h1>
<form action="login.php" method="get">
  <input type="submit" name="signedup" value="Log in?">
</form>
<form action="create_acct.php" method="post">
<input type="text" name="name" value="" placeholder="First Middle Last"><p />
<input type="password" name="password" value="" placeholder="Password ..."><p />
<input type="email" name="email" value="" placeholder="someone@somesite.com"><p />
<input type="date" name="dob" value="" placeholder=""><p />
<input type="submit" name="createaccount" value="Create Account">
<input type="reset" name="reset" value="Reset">
</form>
