<?php

namespace Controller;

use Model\Host;
use Model\Ping;
use Model\Session;
use Model\User;

class Pinger
{

    public static function error404(){
        http_response_code(404);
        include_once('_pingercode_/view/404.php');
    }

    public static function home(){
        if( isset($_COOKIE["pinger_session"]) && $session = Session::getByHash($_COOKIE["pinger_session"]) ){
            $data = array(
                'hosts' =>  array()
            );
            $hosts = Host::getAll();
            foreach( $hosts as $host ){
                $data["hosts"][] = array(
                    'id'            =>  $host->getId(),
                    'packet_size'   =>  $host->getPacketSize(),
                    'ip'            =>  $host->getIP()
                );
            }
            include_once('_pingercode_/view/dashboard.php');
        }else{
            $data = array(
                'error' =>  false
            );
            if( isset($_POST["username"],$_POST["password"]) ){
                if( $user = User::getByLogin($_POST["username"],$_POST["password"]) ){
                    $session = Session::create( $user );
                    setcookie('pinger_session',$session->getHash(),time()+3600,'/');
                    header("Location: /");
                    exit();
                }
                $data["error"] = 'Username / Password combination invalid';
            }
            include_once('_pingercode_/view/login.php');
        }
    }


    public static function ping(){
        if( isset($_GET["id"]) ){
            //Has IP address talked to us before? If not create a log file
            if( !file_exists(  '_pingercode_/data/'.$_SERVER["REMOTE_ADDR"].'.txt'   )  ){
                file_put_contents('_pingercode_/data/'.$_SERVER["REMOTE_ADDR"].'.txt',date("U"));
                //Try and send PING to host ID
                Ping::send($_GET["id"]);
                http_response_code(201);
                header('Content-Type: application/json');
                echo json_encode(array(
                    'result'    =>  'If we find a matching ID we\'ll send a ping'
                ));
                exit();
            }else{
                //GET timestamp of last time IP requested a ping
                $last_sent = (int)file_get_contents('_pingercode_/data/'.$_SERVER["REMOTE_ADDR"].'.txt');
                //Make sure IP didn't make a request in the last 60 seconds
                if( $last_sent < ( date("U") - 60 ) ){
                    Ping::send($_GET["id"]);
                    file_put_contents('_pingercode_/data/'.$_SERVER["REMOTE_ADDR"].'.txt',date("U"));
                    http_response_code(201);
                    header('Content-Type: application/json');
                    echo json_encode(array(
                        'result'    =>  'If we find a matching ID we\'ll send a ping'
                    ));
                    exit();
                }else{
                    http_response_code(400);
                    header('Content-Type: application/json');
                    echo json_encode(array(
                        'error' =>  'Too many requests from IP '.$_SERVER["REMOTE_ADDR"].', only one per minute',
                    ));
                    exit();
                }
            }
        }else{
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(array(
                'error' =>  'Missing Query String Variable id',
            ));
            exit();
        }
    }

}