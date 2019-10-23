<?php
include('./classes/DataBase.php');
include('./classes/LoginClass.php');

$logged_in_id = LoginClass::isLoggedIn();

if (! $logged_in_id)
{
    header("Location: welcome.php");
    exit();
}


if (isset($_POST['send'])) {
        if (DB::query('SELECT id FROM '.DataBase::$user_table_name.' WHERE id=:receiver', array(':receiver'=>$_GET['receiver']))) {
                DB::query('INSERT INTO '.DataBase::$message_table_name.' VALUES (DEFAULT, :body, :sender, :receiver, 0)', array(':body'=>$_POST['body'], ':sender'=>$userid, ':receiver'=>htmlspecialchars($_GET['receiver'])));
                echo "Message Sent!";
        } else {
                die('Invalid ID!');
        }
}
?>
<h1>Send a Message</h1>
<form action="send-message.php?receiver=<?php echo htmlspecialchars($_GET['receiver']); ?>" method="post">
        <textarea name="body" rows="8" cols="80"></textarea>
        <input type="submit" name="send" value="Send Message">
</form>
