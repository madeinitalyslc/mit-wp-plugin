<?php

if (!function_exists('env')) {
    /**
     * @param string     $key
     * @param null|mixed $default
     *
     * @return mixed
     */
    function env(string $key, $default = null)
    {
        $env = getenv($key);

        if (!$env) {
            $env = $default;
        }

        return $env;
    }
}

if (!function_exists('mit_debug')) {
    /**
     * Debug extended function.
     */
    function mit_debug()
    {
        if (!defined('MIT_DEBUG')) {
            return;
        }

        $num_args = func_num_args();
        $arg_list = func_get_args();

        $bt = debug_backtrace();

        $output = '['.$bt[1]['function'].'] ';

        for ($i = 0; $i < $num_args; ++$i) {
            $arg = $arg_list[$i];

            if (is_string($arg)) {
                $arg_output = $arg;
            } else {
                $arg_output = var_export($arg, true);
            }

            if ($arg === '') {
                $arg_output = '""';
            } elseif ($arg === null) {
                $arg_output = 'null';
            }

            $output = $output.$arg_output.' ';
        }

        $output = substr($output, 0, -1);
        $output = substr($output, 0, 1024); // Restrict messages to 1024 characters in length

        if (defined('MIT_DEBUG')) {
            error_log('MIT: '.$output);
        }
    }
}
