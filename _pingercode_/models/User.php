<?php


namespace Model;


class User
{

    private $user;

    private function __construct($data){
        $this->user = $data;
    }

    /**
     * @return int
     */
    public function getId(){
        return (int)$this->user["id"];
    }

    /**
     * @return string
     */
    public function getUsername(){
        return $this->user["username"];
    }

    /**
     * @param $username
     * @param $password
     * @return false|User
     */
    public static function getByLogin($username, $password){
        $resp = false;
        $d = Db::connect()->prepare('select * from user where username = ? and password = ? LIMIT 1 ');
        $d->execute( array($username,$password) );
        if( $d->rowCount() === 1 ){
            $resp = new User( $d->fetch() );
        }
        return $resp;
    }




}