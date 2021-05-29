<?php


namespace Model;


class Session
{

    private $session;

    private function __construct($data){
        $this->session = $data;
    }

    /**
     * @return int
     */
    public function getId(){
        return (int)$this->session["id"];
    }

    /**
     * @return int
     */
    public function getUserId(){
        return (int)$this->session["user_id"];
    }

    /**
     * @return string
     */
    public function getHash(){
        return $this->session["hash"];
    }

    /**
     * @return bool
     */
    public function isDisabled(){
        return (bool)$this->session["disabled"];
    }

    /**
     * @param User $user
     * @return Session
     */
    public static function create(User $user ){
        $hash = md5( microtime().rand().print_r( $_SERVER,true ) );
        $d = Db::connect()->prepare('insert into session (user_id,hash) values (?,?) ');
        $d->execute( array($user->getId(),$hash) );
        return new Session(array(
            'id'        =>  Db::connect()->lastInsertId(),
            'user_id'   =>  $user->getId(),
            'hash'   =>  $hash,
            'disabled'  =>  false
        ));
    }

    /**
     * @param $str
     * @return false|Session
     */
    public static function getByHash($str){
        $resp = false;
        $d = Db::connect()->prepare('select * from session where hash = ? and disabled = 0 LIMIT 1 ');
        $d->execute( array($str) );
        if( $d->rowCount() === 1 ){
            $resp = new Session($d->fetch());
        }
        return $resp;
    }


}