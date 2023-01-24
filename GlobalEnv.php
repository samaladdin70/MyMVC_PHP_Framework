<?php

class GlobalEnv
{
    const PATH_COUNTS = 3;
    const MAIN_LAYOUT = './layout/main2.php';
    const LAYOUT_WITHOUT_NAV = './layout/withoutNav.php';

    /**
     * [Description for VD]
     *
     * @param mixed $variable any type
     * 
     * @return mixed vardump()
     * 
     * Created at: 9/24/2022, 9:26:42 PM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function VD($variable)
    {
        echo '<div style="position:absolute; top:75px; right:15px; z-index:100; width:300px;" class="p-4 d-flex justify-content-end">
        <pre class="bg-dark text-warning p-2 rounded" style=" word-wrap: break-word;">';
        var_dump($variable);
        echo '</pre>
        </div>';
    }


    /**
     * [Description for convert2english]
     * Convert Arabic or Persian number to English number
     * in string form
     *
     * @param String $string Arabic Number
     * 
     * @return String converted English number from arabic or persian
     * in string form
     * 
     * Created at: 9/25/2022, 1:59:17 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function convert2english($string)
    {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        // $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        //  $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        //$persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        // $string =  str_replace($persianDecimal, $newNumbers, $string);
        // $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        //  return str_replace($persian, $newNumbers, $string);
        return $string;
    }



    /**
     * [Description for convert2arabic]
     * Convert English number to Arabic number
     * in string form
     *
     * @param String $string English Number
     * 
     * @return String converted Arabic number from English
     * in string form
     * 
     * Created at: 9/25/2022, 2:03:29 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function convert2arabic($string)
    {
        $engNumbers = range(0, 9);
        // $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        //  $string = str_replace($engNumbers, $arabicDecimal, $string);
        $string = str_replace($engNumbers, $arabic, $string);
        return $string;
    }



    /**
     * [Description for get_operating_system]
     *
     * @return String 
     * 
     * Created at: 9/25/2022, 2:08:06 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function get_operating_system()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $operating_system = 'Unknown Operating System';

        //Get the operating_system name
        if (preg_match('/linux/i', $u_agent)) {
            $operating_system = 'Linux';
        } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
            $operating_system = 'Mac';
        } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
            $operating_system = 'Windows';
        } elseif (preg_match('/ubuntu/i', $u_agent)) {
            $operating_system = 'Ubuntu';
        } elseif (preg_match('/iphone/i', $u_agent)) {
            $operating_system = 'IPhone';
        } elseif (preg_match('/ipod/i', $u_agent)) {
            $operating_system = 'IPod';
        } elseif (preg_match('/ipad/i', $u_agent)) {
            $operating_system = 'IPad';
        } elseif (preg_match('/android/i', $u_agent)) {
            $operating_system = 'Android';
        } elseif (preg_match('/blackberry/i', $u_agent)) {
            $operating_system = 'Blackberry';
        } elseif (preg_match('/webos/i', $u_agent)) {
            $operating_system = 'Mobile';
        }

        return $operating_system;
    }




    /**
     * [Description for code]
     * Custom encrypt text
     *
     * @param mixed $text
     * 
     * @return mixed Encrypted text
     * 
     * Created at: 9/25/2022, 2:09:01 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function code($text)
    {
        $key = 'T@hiaMi$r_Al@ddin23581321';
        $base = 'AES-128-ECB';
        $encrypts = openssl_encrypt($text, $base, $key);
        return $encrypts;
    }




    /**
     * [Description for decode]
     * Decrypt The customed encrypted above
     *
     * @param mixed $code
     * 
     * @return mixed
     * plain text
     * Created at: 9/25/2022, 2:10:42 AM (Egypt/Cairo)
     * @author     Aladdin Sami 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @see       {@link http:aladdin.infinityfreeapp.com/} 
     * @copyright Aladdin Sami 
     */
    function decode($code)
    {
        $key = 'T@hiaMi$r_Al@ddin23581321';
        $base = 'AES-128-ECB';
        $code = str_replace(" ", "+", $code);
        $decrypt = openssl_decrypt($code, $base, $key);
        return $decrypt;
    }

    function passhashit($text)
    {
        return password_hash($text, PASSWORD_DEFAULT);
    }


    function passveriit($text, $hash)
    {
        return password_verify($text, $hash);
    }


    function image_resize($file_name, $width, $height, $crop = FALSE)
    {
        list($wid, $ht) = getimagesize($file_name);
        $r = $wid / $ht;
        if ($crop) {
            if ($wid > $ht) {
                $wid = ceil($wid - ($width * abs($r - $width / $height)));
            } else {
                $ht = ceil($ht - ($ht * abs($r - $wid / $ht)));
            }
            $new_width = $width;
            $new_height = $height;
        } else {
            if ($width / $height > $r) {
                $new_width = $height * $r;
                $new_height = $height;
            } else {
                $new_height = $width / $r;
                $new_width = $width;
            }
        }
        $source = imagecreatefromjpeg($file_name);
        $dst = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($dst, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
        return $dst;
    }
}