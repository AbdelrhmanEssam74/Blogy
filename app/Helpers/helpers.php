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
