<?php


namespace Model;


class Host
{

    private $host;

    private function __construct($data){
        $this->host = $data;
    }

    /**
     * @return int
     */
    public function getId(){
        return (int)$this->host["id"];
    }

    /**
     * @return string
     */
    public function getIP(){
        return $this->host["ip"];
    }

    /**
     * @return int
     */
    public function getPacketSize(){
        return (int)$this->host["packet_size"];
    }


    /**
     * @return Host[]
     */
    public static function getAll(){
        $resp = array();
        $d = Db::connect()->prepare('select * from host ');
        $d->execute();
        while( $host = $d->fetch() ){
            $resp[] = new Host($host);
        }
        return $resp;
    }

}