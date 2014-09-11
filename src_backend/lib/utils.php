<?php

/**
 * User: caio.franchi
 * Date: 30/01/13
 * Time: 16:19
 */


class Utils {
    public static function get_real_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function debug($varDebug) {
        echo "<pre>".var_dump($varDebug);
        die;
    }

}