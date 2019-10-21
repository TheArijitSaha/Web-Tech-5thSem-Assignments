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

$current_user = new User($logged_in_id);

?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?php echo $current_user->getName(); ?> | Feed</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="static/css/master.css">
    </head>
    <body>
        <?php echo NexusNav::insertNavbar(); ?>

        <div class="container">
            <div class="jumbotron">
                <p class="lead">Welcome to your feed <?php echo $current_user->getName(); ?></p>
            </div>
        </div>


        <!-- Posting -->
        <form action="feed.php" method="post">
            <textarea name="postbody" rows="8" cols="80" value=""></textarea>
            <input type="submit" name="post" value="Post">
        </form>
        <?php
        $userid = LoginClass::isLoggedIn();

        if (isset($_POST['post'])) {
                        $postbody = $_POST['postbody'];
                        if (strlen($postbody) > 160 || strlen($postbody) < 1) {
                                die('Incorrect length!');
                        }

                        $errs=DataBase::query('INSERT INTO ASARGPosts VALUES (DEFAULT, :postbody, NOW(), :userid, 0)', array(':postbody'=>$postbody, ':userid'=>$userid));
                        if(isset($errs[1]))
                        {
                            echo ($errs[1]);
                        }
                }

        // $dbposts = DataBase::query('SELECT * FROM ASARGPosts WHERE user_id=:userid ORDER BY id DESC', array(':userid'=>$userid));
        //          $posts = "";
        //          foreach($dbposts as $p) {
        //
        //                  $posts .= htmlspecialchars($p[2][1]);
        //                  $posts .="\n";
        //          }
        //          echo $posts;
        // ?>
<!--         posting ends -->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
