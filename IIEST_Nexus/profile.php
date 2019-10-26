<!DOCTYPE html>

<?php
    require_once('classes/LoginClass.php');
    require_once('classes/User.php');
    require_once('classes/variables.php');
    require_once('classes/NexusNav.php');
    require_once('classes/DataBase.php');

    $logged_in_id = LoginClass::isLoggedIn();


    if($logged_in_id===false){
        $logged_in_user = NULL;
    }
    else{
        $logged_in_user = new User($logged_in_id);
    }
    if(isset($_GET['userid'])){
        $profile_user = new User($_GET['userid']);
        if(!$profile_user->isReal()){
            echo "Non Existant Profile!<br>";
            exit();
        }
    }
    else{
        if($logged_in_user===NULL){
            header('Location: feed.php');
            exit();
        }
        else{
            $profile_user = $logged_in_user;
        }
    }
    // if($current_user->getID()==$logged_in_as->getID())
    //     $compared=0;
    //
    // $temp = DataBase::query('SELECT COUNT(*) FROM '.DataBase::$follower_table_name.' where user_id='.$current_user->getID().' and follower_id='.$logged_in_as->getID().';');
    // if($temp['executed'])
    // {
    //     if($temp['data']==1)
    //         $following=0;
    // }
?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <?php if( ($logged_in_user!==NULL) && ($logged_in_user->getID()===$profile_user->getID()) ){ ?>
            <title>My Profile</title>
        <?php }else{ ?>
            <title><?php echo $profile_user->getName(); ?></title>
        <?php } ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="static/css/master.css">
        <link rel="stylesheet" href="static/css/profile_master.css">
    </head>
    <body>
        <!-- Navbar Begins-->
        <?php echo NexusNav::insertNavbar(); ?>
        <!-- Navbar Ends-->

        <div class="container-fluid">
            <div class="row">

                <!-- Left Column Begin -->
                <div class="col-sm-3">
                    <div class="container relpos">
                        <?php
                            $query_result = DataBase::query('SELECT profilepic FROM '.DataBase::$user_table_name.
                                                            ' WHERE id=:id',
                                                            array(':id'=>$profile_user->getID()));
                            if($query_result[data][0][profilepic]==0){
                                $profile_pic_path = 'media/profile-placeholder.jpg';
                            }
                            else{
                                foreach(OtherVariables::$image_extensions as $ext){
                                    if(file_exists('media/profiles/PROFILE_'.strval($profile_user->getID()).'.'.$ext)){
                                        $profile_pic_path = 'media/profiles/PROFILE_'.strval($profile_user->getID()).'.'.$ext;
                                    }
                                }
                            }
                        ?>
                        <img class="profileImage" src="<?php echo $profile_pic_path;?>" alt="Error">
                        <?php if( ($logged_in_user!==NULL) && ($logged_in_user->getID()===$profile_user->getID()) ){ ?>
                            <form id="profilePicForm" action="sync/pic_upload.php" method="post" enctype="multipart/form-data">
                                <label for="profilePicUpload" class="editProfile btn btn-dark">Change</label>
                                <input id="profilePicUpload" name="profilePicUpload" type="file" accept="image/*" >
                            </form>
                        <?php } ?>
                    </div>

                    <!-- Follow/Unfollow Form Begin -->
                    <?php if( ($logged_in_user!==NULL) && ($logged_in_user->getID()!==$profile_user->getID()) ){ ?>
                        <p></p>
                        <div class="container">
                            <button type="button" class="btn btn-dark" name="follow" id="followBtn">Follow</button>
                        </div>
                    <?php } ?>
                    <!-- Follow/Unfollow Form End -->
                </div>
                <!-- Left Column End -->



                <!-- Middle Column Begin -->
                <div class="col-sm-6">
                    <div class="container">
                        <div class="row identityBox">
                            <div class="col-sm-7">
                                <h2 class='nameTile'><strong><?php echo $profile_user->getName(); ?></strong></h2>
                                <h5><a  class='emailTile' href="mailto:<?php echo $profile_user->getEmail(); ?>"><?php echo $profile_user->getEmail(); ?></a></h5>
                                <p class='dobTile'><strong>Birthday :</strong> <?php echo date('d F, Y',$profile_user->getDOB()->getTimestamp()); ?></p>
                                <input type="number" name="profileID" value="<?php echo $profile_user->getID(); ?>" hidden>
                                <input type="number" name="currentLoginID" value="<?php echo $logged_in_user->getID(); ?>" hidden>
                            </div>
                            <div class="col-sm-5 errorBox">

                            </div>
                        </div>
                        <!-- My Skills Begin -->
                        <div class="container-fluid skillBox">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h3>My Skills</h3>
                                </div>
                                <?php if( ($logged_in_user!==NULL) && ($logged_in_user->getID()===$profile_user->getID()) ){ ?>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="search-box">
                                                    <input class="form-control" type="text" size="30" autocomplete="off" name="skillSearch" placeholder="Search for a new skill">
                                                    <div class="result" id="skillLiveSearch"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary" name="addSkill" id="skillAddBtn">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="skill-show">

                            </div>
                        </div>
                        <!-- My Skills End -->


                    </div>
                </div>
                <!-- Middle Column End -->




                <!-- Right Column Begin -->
                <div class="col-sm-3">

                </div>
                <!-- Right Column End -->

            </div>

        </div>




        <?php
                // if($current_user->getID()==$logged_in_as->getID()){
                //         $compared = 0;
                //         echo 'Your Profile';
                // }
                // else {
                //     echo $current_user->getName();
                // }
        ?>

        <?php

                        // $username = "";
                        // $userid = "";
                        // $res=array();
                        // $followerid = $logged_in_as->getID();
                        // $userid = $current_user->getID();
                        // $username = $current_user->getName();
                        // if($compared)
                        // {
                        //     if (isset($_GET['userid']))
                        //     {
                        //             if (DataBase::query('SELECT id FROM ASARGUsers WHERE id=:userid', array(':userid'=>$logged_in_as->getID())))
                        //             {
                        //                     if (isset($_POST['follow']))
                        //                     {
                        //
                        //                             $res = DataBase::query('INSERT INTO '.DataBase::$follower_table_name.' VALUES (:userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                        //                             if($res['executed'])
                        //                             {
                        //                                 $following = 0;
                        //                             }
                        //                             else
                        //                             {
                        //                                 $following = 0;
                        //
                        //                             }
                        //
                        //                     }
                        //                     else if(isset($_POST['unfollow']))
                        //                     {
                        //                         $res = DataBase::query('DELETE FROM '.DataBase::$follower_table_name.' where user_id = '.$userid.' and follower_id='.$followerid.';');
                        //                         if($res['executed'])
                        //                         {
                        //                             $following = 1;
                        //                         }
                        //                         else
                        //                         {
                        //                             echo "Unable to unfollow user. Contact developers!";
                        //                         }
                        //                     }
                        //             }
                        //             else
                        //             {
                        //                 die('User not found!');
                        //             }
                        //
                        //     }
                        // }
                    ?>
                    <!-- <form action="profile.php?userid=<?php //echo $userid; ?>" method="post"> -->

                            <?php
                                // $followerid = $logged_in_as->getID();
                                // $userid = $current_user->getID();
                                // if($compared && $following)
                                // {
                            ?>
                                    <!-- <input type="submit" name="follow"  value="Follow"> -->
                            <?php
                                // }
                                // else if ($following==0)
                                // {
                            ?>
                                    <!-- <input type="submit" name="unfollow" value="Unfollow"> -->
                            <?php
                                // }
                            ?>
                    <!-- </form> -->

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="static/js/profile_script.js"></script>
    </body>
</html>
