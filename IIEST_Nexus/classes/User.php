<?php
require_once('classes/DataBase.php');

class User
{
    private $id;
    private $name;
    private $email;
    private $token_hash;

    public function __construct($id)
    {
        $result = DataBase::query('SELECT name,'.DataBase::$user_table_name.'.id as id,token,email'
                                    .' FROM '.DataBase::$user_table_name.','.DataBase::$token_table_name
                                    .' WHERE '.DataBase::$user_table_name.'.id='.DataBase::$token_table_name.'.userid'
                                    .' AND '.DataBase::$user_table_name.'.id=:id',
                                    array(':id'=>$id))[0];
        $this->id=$result['id'];
        $this->name=$result['name'];
        $this->email=$result['email'];
        $this->token_hash=$result['token'];
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

}
?>
