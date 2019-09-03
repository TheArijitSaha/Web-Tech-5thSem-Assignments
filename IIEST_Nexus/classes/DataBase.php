<?php
class DataBase
{
    private static function connect()
    {
        $link=new PDO('mysql:host=localhost;dbname=btech2017;charset=utf8', "btech2017", "btech2017");
        // $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;
    }

    public static function query($query, $params = array())
    {
        $statement=self::connect()->prepare($query);
        $statement->execute($params);
        // print_r($statement->errorInfo());
        if(explode(' ', $query)[0]=='SELECT') //checks if the first word of the query is select
        {
            $data=$statement->fetchAll();
            return $data;
        }
    }
}
?>
