<?php
    // PHP FIle to echo JSON of skills registered to current user, if logged in.

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

    $result = DataBase::query('SELECT a.skillid,skill,parent '.
                              'FROM '.DATABASE::$skill_reg_table_name.' a,'.DATABASE::$skill_table_name.' b '.
                              'WHERE a.skillid=b.skillid '.
                                  'AND a.Userid=:userid',
                              array(':userid'=>$current_user->getId())
                          );

    if ($result===false)
    {
        echo "ERROR: Could not able to execute SQL";
    }
    else
    {
        $result_json=json_encode($result);
        echo $result_json;
    }
?>
