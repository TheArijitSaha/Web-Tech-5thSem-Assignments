<?php
    // PHP File for synchronous File Upload of Profile Pic, if logged in.

    require_once('../classes/DataBase.php');
    require_once('../classes/LoginClass.php');
    require_once('../classes/User.php');
    require_once('../classes/variables.php');

    $logged_in_id = LoginClass::isLoggedIn();

    if (! $logged_in_id)
    {
        // Someone is trying to access this php file and inspect its content
        // through direct URL.
        header("Location: index.php");
        exit();
    }

    $current_user = new User($logged_in_id);


    // Save Profile Picture
    if(isset($_FILES['profilePicUpload'])){
        $imageFileType = strtolower(pathinfo($_FILES["profilePicUpload"]["name"],PATHINFO_EXTENSION));
        $target_file = '../media/profiles/PROFILE_'.strval($current_user->getID()).'.'.$imageFileType;

        if ($_FILES["profilePicUpload"]["size"] > 1024*1024)
        {
            echo "ERROR: File Size greater than 1 MB";
            exit();
        }

        $query_result = DataBase::query('SELECT profilepic FROM '.DataBase::$user_table_name.
                                        ' WHERE id=:id',
                                        array(':id'=>$current_user->getID()));

        if ($query_result['executed']===false)
        {
            echo "ERROR: Not able to execute SQL<br>";
            print_r($query_result['errorInfo']);
            exit();
        }

        if($query_result['data'][0]['profilepic']!=0){
            if(!unlink($target_file)){
                echo "ERROR: Could not Delete Previous Profile Photo<br>";
                exit();
            }
        }

        if( move_uploaded_file($_FILES["profilePicUpload"]["tmp_name"],$target_file) )
        {
            $query_result = DataBase::query('UPDATE '.DataBase::$user_table_name.
                                            ' SET profilepic=TRUE'.
                                            ' WHERE id=:id',
                                            array(':id'=>$current_user->getID()));
            header('Location: ../profile.php');
    	}
    	else
    	{
            $query_result = DataBase::query('UPDATE '.DataBase::$user_table_name.
                                            ' SET profilepic=FALSE'.
                                            ' WHERE id=:id',
                                            array(':id'=>$current_user->getID()));
            echo "ERROR: Could not Add File<br>";
            echo "Not uploaded because of error #".$_FILES["profilePicUpload"]["error"].'<br>';
            exit();
    	}

    }



?>
