<?php
    require_once('../classes/DataBase.php');

    if( isset($_GET["skillSearch"]) )
    {
        $inputString=strtolower($_GET["skillSearch"])."%";
        $result = DataBase::query('SELECT * FROM '.DataBase::$skill_table_name.' WHERE LOWER(skill) LIKE :inputString ORDER BY skill LIMIT 10',
                            array(':inputString'=>$inputString));
        if ($result===false)
        {
            echo "ERROR: Could not able to execute SQL";
        }
        else
        {
            $result_json=json_encode($result);
            echo $result_json;
        }
    }
?>
