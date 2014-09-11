<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 26/08/14
 * Time: 17:19
 */

class LocaleHelper {

    public static $ipFilesPath = 'lang/ip_files/';
    public static $translationFilesPath = 'lang/';

    public static $defaultLocale = 'br';

    public static $translations = NULL;

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

    public static function set_locale($pCountryCode) {
        $_SESSION["locale"] = $pCountryCode;
    }

    public static function get_locale() {
       return (isset($_SESSION["locale"])) ? $_SESSION["locale"] : LocaleHelper::$defaultLocale;
    }

    public static function get_countrycode_by_ip($ip) {
        $numbers = preg_split( "/\./", $ip);
        include(LocaleHelper::$ipFilesPath.$numbers[0].".php");
        $code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);
        foreach($ranges as $key => $value){
            if($key<=$code){
                if($ranges[$key][0]>=$code){$two_letter_country_code=$ranges[$key][1];break;}
            }
        }
        if ($two_letter_country_code==""){$two_letter_country_code="unknown";}
        return strtolower($two_letter_country_code);
    }

    public static function translate($phrase, $pStrCountryCode = ''){
        $countryCode = ($pStrCountryCode!=='') ? $pStrCountryCode : (isset($_SESSION["locale"])) ? $_SESSION["locale"] : LocaleHelper::$defaultLocale;

        if (is_null(LocaleHelper::$translations)) {
            $lang_file = LocaleHelper::$translationFilesPath . $countryCode . '.json';
            /* If no instance of $translations has occured load the language file */
            if (!file_exists($lang_file)) {
                $lang_file = LocaleHelper::$translationFilesPath . $countryCode .'.json';
            }
            $lang_file_content = file_get_contents($lang_file);
            /* Load the language file as a JSON object
               and transform it into an associative array */
            LocaleHelper::$translations = json_decode($lang_file_content, true);
        }
        return LocaleHelper::$translations[$phrase];
    }
} 