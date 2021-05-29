<?php
/***
 * PINGER WAF
 * Check input for banned words!
 */
$banned_words = array('1=1','sleep','script','benchmark','alert','xss','onerror');
$waf = array_merge($_GET,$_POST,[$_SERVER["REQUEST_URI"]]);
foreach( $waf as $str ){
    foreach($banned_words as $word ){
        if( gettype($str) === 'string' ) {
            if (strstr(preg_replace('/([^a-z])/', '', strtolower($str)), $word)) {
                http_response_code(400);
                echo "<h1>PINGER WAF Tripped</h1>";
                exit();
            }
        }
    }
}