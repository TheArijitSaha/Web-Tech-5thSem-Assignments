<!DOCTYPE html>


<?php
require_once('classes/LoginClass.php');
require_once('classes/User.php');
require_once('classes/variables.php');
require_once('classes/NexusNav.php');
require_once('classes/DataBase.php');





$logged_in_id = LoginClass::isLoggedIn();

if (! $logged_in_id)
{
    header("Location: welcome.php");
    exit();
}


$receiver = new User($_GET['recid']);
$sender = new User(LoginClass::isLoggedIn());



if (isset($_POST['send'])) {
        if (DataBase::query('SELECT id FROM '.DataBase::$user_table_name.' WHERE id=:receiver', array(':receiver'=>$receiver->getID()))) {
                DataBase::query('INSERT INTO '.DataBase::$message_table_name.' VALUES (DEFAULT, :body, :sender, :receiver, 0)', array(':body'=>$_POST['body'], ':sender'=>$sender->getID(), ':receiver'=>htmlspecialchars($receiver->getID())));
                echo "Message Sent!";
        } else {
                die('Invalid ID!');
        }
}
?>


<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>
        </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="static/css/master.css">
    </head>
    <body>

        <?php echo NexusNav::insertNavbar(); ?>


        <h1>Send a Message</h1>
        <form action="sendmessage.php?recid=<?php echo htmlspecialchars($_GET['recid']); ?>" method="post">
                <textarea name="body" rows="8" cols="80"></textarea>
                <input type="submit" name="send" value="Send Message">
        </form>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="static/js/skills_script.js"></script>

    </body>
</html>
