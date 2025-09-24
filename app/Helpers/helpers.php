<?php
/**
 * Function to Get previous route name
 */
if (!function_exists('previousRouteName')) {
    function previousRouteName($url)
    {
        $segments = explode('/', $url);
        return end($segments);
    }
}
/**
 * Function to get custom length of string
 */
if (!function_exists('custom_strlen')) {
     function custom_strlen($string, $length)
     {
         if (strlen($string) > $length) {
             return substr($string, 0, $length) . '...';
         } else {
             return $string;
         }
     }
 }
