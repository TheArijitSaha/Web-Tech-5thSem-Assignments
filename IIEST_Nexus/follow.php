<?php
include('./classes/DataBase.php');
include('./classes/LoginClass.php');
$username = "";
$userid = "";
$res=array();
if(DataBase::query('SELECT id FROM ASARGUsers WHERE id=:userid', array(':userid'=>$_GET['userid'])))
{
    $res = DataBase::query('SELECT name FROM ASARGUsers WHERE id=:userid', array(':userid'=>$_GET['userid']));
    if($res['executed'])
    {
         $username = $res['data'][0]['name'];
    }
}
else
{
    die('user id not found');
}
if (isset($_GET['userid']))
{
        if (DataBase::query('SELECT id FROM ASARGUsers WHERE id=:userid', array(':userid'=>$_GET['userid'])))
        {
                //$username = DataBase::query('SELECT name FROM ASARGUsers WHERE name=:username', array(':username'=>$_GET['username']))[0][0];
                $userid = $_GET['userid'];
                if (isset($_POST['follow']))
                {
                        $res = DataBase::query('SELECT name FROM ASARGUsers WHERE id=:userid', array(':userid'=>$_GET['userid']));
                        if($res['executed'])
                        {
                             $username = $res['data'][0]['name'];
                        }
                        $followerid = LoginClass::isLoggedIn();
                        $res = DataBase::query('INSERT INTO ASARGFollowers VALUES (:userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                        if($res['executed'])
                        {
                            echo 'user '.$username.' is now being followed';
                        }
                        else
                        {
                            echo 'already following';
                        }

                }
        }
        else
        {
            die('User not found!');
        }
}

?>
<h1><?php echo $username; ?>'s Profile</h1>
<form action="follow.php?userid=<?php echo $userid; ?>" method="post">
        <input type="submit" name="follow" value="Follow">
</form>
