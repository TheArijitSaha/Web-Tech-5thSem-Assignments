<?php
require_once('DataBase.php');

class User
{
    private $exists;
    private $id;
    private $name;
    private $email;
    private $token_hash;

    public function __construct($id)
    {
        $result = DataBase::query('SELECT name,id,email,dob'.
                                  ' FROM '.DataBase::$user_table_name.
                                  ' WHERE id=:id',
                                    array(':id'=>$id))['data'];
        if(count($result)===0){
            $this->exists=False;
            $this->id=NULL;
            $this->name=NULL;
            $this->email=NULL;
            $this->dob=NULL;
            return;
        }
        $this->exists=True;
        $this->id=$result[0]['id'];
        $this->name=$result[0]['name'];
        $this->email=$result[0]['email'];
        $this->dob=new DateTime($result[0]['dob']);
    }

    public function isReal() {
        return $this->exists;
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

    public function getDOB() {
        return $this->dob;
    }

}
?>
