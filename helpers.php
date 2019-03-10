<?php

if (!function_exists('env')) {
    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     */
    function env(string $key, $default = null) {
        $env = getenv($key);
        
        if (!$env) {
            $env = $default;
        }
        
        return $env;
    }
}