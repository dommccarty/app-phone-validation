<?php

if (!function_exists("cleanup_phone_number")) {

    function cleanup_phone_number($str)
    {
        $digits = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        
        $new_str = "";
        
        $len = strlen($str);
        for ($k = 0; $k < $len; ++$k) {
            if (in_array($str[$k], $digits)) {
                $new_str .= $str[$k];
            }
        }
        
        $new_str = (string) (int) $new_str;
        
        if (strlen($new_str) == 11 && substr($new_str, 0, 1) == "1") {
            $new_str = substr($new_str, 1);
        }
        
        return $new_str;
    }
}
