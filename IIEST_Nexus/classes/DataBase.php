<?php

class DataBase
{
    private static $host_name='localhost';
    private static $database_name='btech2017';
    private static $database_username='btech2017';
    private static $database_password='btech2017';

    private static function connect()
    {
        $link=new PDO('mysql:host='.self::$host_name.';dbname='.self::$database_name.';charset=utf8',self::$database_username,self::$database_password);
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
