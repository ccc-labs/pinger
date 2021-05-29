<?php


namespace Model;


class Ping
{

    public static function send( $id ){
        $sql = 'select * from host where id = '.$id.' LIMIT 1 ';
        $d = Db::connect()->prepare($sql);
        $d->execute();
        //Confirm we've found a matching row in the database
        if( $d->rowCount() == 1 ){
            $host = $d->fetch();
            $ip = $host["ip"];
            $packet_size = intval($host["packet_size"]);
            //make sure PING packet size between 1 and 65527
            if( $packet_size > 0 && $packet_size < 65528 ) {
                //check IP is a valid IPv4 Address
                if (filter_var($ip, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4)) {
                    //SEND 4 PING PACKETS IN THE BACKGROUND
                    shell_exec('ping -s '.$packet_size.' -c 4 '.$ip.'  > /dev/null &');
                }
            }
        }
    }

}