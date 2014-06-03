<?php

/**
 * User: caio.franchi
 * Date: 30/01/13
 * Time: 16:19
 */


function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

function getRealIpAddr()
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

// function to get current filename from a url made by sarfraz ahmed.
function get_url_filename()
{
    $uri = $_SERVER['REQUEST_URI'];
    $exp = explode("/",$uri);
    $filename = array_pop($exp);
    $ext = substr($filename,strpos($filename,"."));

    if (substr($ext,4))
    {
        if (substr($ext,4,1)=="?")
        {
            $ext = substr($ext,0,4);
        }
        else
        {
            $ext = substr($ext,0,5);
        }
    }

    $filename = substr($filename,0,strpos($filename,"."));

    return $filename . $ext;
};

//get file extension from string
function getExtension($str) {

    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

//função que formata a data
function formata_data($data)
{
    //recebe o parâmetro e armazena em um array separado por -
    $data = explode('-', $data);
    $mes = '';
    switch ($data[1]) {
        case "01":    $mes = 'Janeiro';     break;
        case "02":    $mes = 'Fevereiro';   break;
        case "03":    $mes = 'Março';       break;
        case "04":    $mes = 'Abril';       break;
        case "05":    $mes = 'Maio';        break;
        case "06":    $mes = 'Junho';       break;
        case "07":    $mes = 'Julho';       break;
        case "08":    $mes = 'Agosto';      break;
        case "09":    $mes = 'Setembro';    break;
        case "10":    $mes = 'Outubro';     break;
        case "11":    $mes = 'Novembro';    break;
        case "12":    $mes = 'Dezembro';    break;
    }

    //armazena na variavel data os valores do vetor data e concatena /
    $data = $data[2].' de '.$mes;

    //retorna a string da ordem correta, formatada
    return $data;
}


function removeAccents($stripAccents){
    $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
        'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
    $str = strtr( $stripAccents, $unwanted_array );
    return $str;
}

/**
 * Translates a string with underscores into camel case (e.g. first_name -&gt; firstName)
 * @param    string   $str                     String in underscore format
 * @param    bool     $capitalise_first_char   If true, capitalise the first char in $str
 * @return   string                              $str translated into camel caps
 */
function to_camel_case($str, $capitalise_first_char = false) {
    $str = (string)$str;
    if($capitalise_first_char) {
        $str[0] = strtoupper($str[0]);
    }
    $func = create_function('$c', 'return strtoupper($c[1]);');
    return preg_replace_callback('/_([a-z])/', $func, $str);
}

function generatePassword ($length = 8)
{

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
        $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, $maxlength-1), 1);

        // have we already used this character in $password?
        if (!strstr($password, $char)) {
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
        }

    }

    // done!
    return $password;

};

//forma date with milliseconds
function udate($format, $utimestamp = null) {
    if (is_null($utimestamp))
        $utimestamp = microtime(true);

    $timestamp = floor($utimestamp);
    $milliseconds = round(($utimestamp - $timestamp) * 1000000);

    return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
};

function formatChronometerDate($duration) {
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

function getTimestamp(){
    $seconds = microtime(true); // false = int, true = float
    return round( ($seconds * 1000) );
}

function debug($varDebug) {
    echo "<pre>".var_dump($varDebug);
    die;
};
