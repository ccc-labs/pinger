<?php
$_DB_ = array(
    'host'      =>  '',
    'username'  =>  '',
    'password'  =>  ''
);
include_once('_pingercode_/waf.php');
include_once('_pingercode_/controllers/Pinger.php');
include_once('_pingercode_/models/Db.php');
include_once('_pingercode_/models/Host.php');
include_once('_pingercode_/models/Ping.php');
include_once('_pingercode_/models/Session.php');
include_once('_pingercode_/models/User.php');
$url_sp = explode('?',$_SERVER["REQUEST_URI"]);
$url = $url_sp[0];
if( $url == '/' ){
    Controller\Pinger::home();
}elseif( $url == '/api/ping' ){
    Controller\Pinger::ping();
}else{
    Controller\Pinger::error404();
}