<?php
    //Echoes JSON of all skills in DB
    require_once('../classes/DataBase.php');

    $result = DataBase::query('SELECT * FROM '.DataBase::$skill_table_name);

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
