<?php
/**
 * Created by PhpStorm.
 * User: Caio
 * Date: 23/08/14
 * Time: 18:40
 */

class DateUtils {

    public static function elapsed_time_from($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    //format date with milliseconds
    public static function udate($format, $utimestamp = null) {
        if (is_null($utimestamp))
            $utimestamp = microtime(true);

        $timestamp = floor($utimestamp);
        $milliseconds = round(($utimestamp - $timestamp) * 1000000);

        return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
    }

    public static function format_chronometer_date($duration) {
        /*    $mili = $mili[1];
            $h = floor($seconds / 3600);
            $m = floor(($seconds % 3600) / 60);
            $s = $seconds - ($h * 3600) - ($m * 60);
            return sprintf('%02d:%02d:%02d:%02d', $h, $m, $s,$mili);*/
        $mili = explode(".",$duration);
        $mili = $mili[1];

        $hours = (int)($duration/60/60);
        $hours = ($hours < 10) ? "0".$hours : $hours;

        $minutes = (int)($duration/60)-$hours*60;
        $minutes = ($minutes < 10) ? "0".$minutes : $minutes;

        $seconds = (int)$duration-$hours*60*60-$minutes*60;
        $seconds = ($seconds < 10) ? "0".$seconds : $seconds;

        return $hours.":".$minutes.":".$seconds.":".$mili;
    }

    public static function getTimestamp(){
        $seconds = microtime(true); // false = int, true = float
        return round( ($seconds * 1000) );
    }

    public static function convert_brazilian_date_to_mysql($data) {

        $return_fn = 'invalid date';

        if (strstr($data, '/')) { //verifica se tem a barra /
            $d = explode('/', $data); //tira a barra

            if(checkdate($d[1], $d[0], $d[2]) && is_numeric($d[0]) && is_numeric($d[1]) && is_numeric($d[2])){
                $rstData = $d[2].'-'.$d[1].'-'.$d[0];	//2014-01-31   separa as datas $d[2] = ano $d[1] = mes etc...
                $return_fn = $rstData;
            }

        } else if(strstr($data, '-')){ //verifica se tem a traço -
            $d = explode('-', $data);

            if(checkdate($d[1], $d[2], $d[0]) && is_numeric($d[0]) && is_numeric($d[1]) && is_numeric($d[2])){
                $rstData = $d[2].'/'.$d[1].'/'.$d[0]; //31/01/2014
                $return_fn = $rstData;
            }
        }

        return $return_fn;
    }

}