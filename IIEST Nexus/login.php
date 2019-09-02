<?php
include('classes/DB.php');
if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (DB::query('SELECT email FROM ASARGUsers WHERE email=:email', array(':email'=>$email))) {
                if (password_verify($password, DB::query('SELECT password FROM ASARGUsers WHERE email=:email', array(':email'=>$email))[0]['password']))
                {
                        echo 'Logged in!';
                        $cstrong = True;
                        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                        $user_id = DB::query('SELECT id FROM ASARGUsers WHERE email=:email', array(':email'=>$email))[0]['id'];
                        DB::query('INSERT INTO asargtokens VALUES (DEFAULT, :token, :userid)', array(':token'=>sha1($token), ':userid'=>$user_id));
                        setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);

                }
                else
                {
                        echo 'Incorrect Password!';
                }
        } else {
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
