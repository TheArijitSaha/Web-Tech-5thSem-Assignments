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
$compared=1;
$following = 1;
$current_user = new User($_GET['userid']);
$logged_in_as = new User(LoginClass::isLoggedIn());
if($current_user->getID()==$logged_in_as->getID())
    $compared=0;

$temp = DataBase::query('SELECT COUNT(*) FROM '.DataBase::$follower_table_name.' where user_id='.$current_user->getID().' and follower_id='.$logged_in_as->getID().';');
if($temp['executed'])
{
    if($temp['data']==1)
        $following=0;
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
        <?php
                if($current_user->getID()==$logged_in_as->getID()){
                        $compared = 0;
                        echo 'Your Profile';
                }
                else {
                    echo $current_user->getName();
                }
        ?>

        <?php

                        $username = "";
                        $userid = "";
                        $res=array();
                        $followerid = $logged_in_as->getID();
                        $userid = $current_user->getID();
                        $username = $current_user->getName();
                        if($compared)
                        {
                            if (isset($_GET['userid']))
                            {
                                    if (DataBase::query('SELECT id FROM ASARGUsers WHERE id=:userid', array(':userid'=>$logged_in_as->getID())))
                                    {
                                            if (isset($_POST['follow']))
                                            {

                                                    $res = DataBase::query('INSERT INTO '.DataBase::$follower_table_name.' VALUES (:userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                                                    if($res['executed'])
                                                    {
                                                        $following = 0;
                                                    }
                                                    else
                                                    {
                                                        $following = 0;

                                                    }

                                            }
                                            else if(isset($_POST['unfollow']))
                                            {
                                                $res = DataBase::query('DELETE FROM '.DataBase::$follower_table_name.' where user_id = '.$userid.' and follower_id='.$followerid.';');
                                                if($res['executed'])
                                                {
                                                    $following = 1;
                                                }
                                                else
                                                {
                                                    echo "Unable to unfollow user. Contact developers!";
                                                }
                                            }
                                    }
                                    else
                                    {
                                        die('User not found!');
                                    }

                            }
                        }
                    ?>
                    <form action="profile.php?userid=<?php echo $userid; ?>" method="post">

                            <?php
                                $followerid = $logged_in_as->getID();
                                $userid = $current_user->getID();
                                if($compared && $following)
                                {
                            ?>
                                    <input type="submit" name="follow"  value="Follow">
                            <?php
                                }
                                else if ($following==0)
                                {
                            ?>
                                    <input type="submit" name="unfollow" value="Unfollow">
                            <?php
                                }
                            ?>
                    </form>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
