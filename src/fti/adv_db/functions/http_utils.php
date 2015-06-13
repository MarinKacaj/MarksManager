<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 7:37 PM
 */

if (!function_exists('http_build_str')) {
    /**
     * Build query string (PECL pecl_http >= 0.23.0)
     * @link http://php.net/manual/en/function.http-build-str.php
     * @param   array $query Associative array of query string parameters.
     * @param   string $prefix Top level prefix.
     * @param   string $arg_separator Argument separator to use (by default the INI setting arg_separator.output will be used, or "&" if neither is set.
     * @return  string                  Returns the built query as string on success or FALSE on failure.
     * A snippet from Sébastien Corne.
     */
    function http_build_str(array $query, $prefix = '', $arg_separator = null)
    {
        if (is_null($arg_separator)) {
            $arg_separator = ini_get('arg_separator.output');
        }
        $result = array();
        foreach ($query as $k => $v) {
            $key = $prefix ? "{$prefix}%5B{$k}%5D" : $k;
            if (is_array($v)) {
                $result[] = call_user_func(__FUNCTION__, $v, $key, $arg_separator);
            } else {
                $result[] = $key . '=' . urlencode($v);
            }
        }
        return implode($arg_separator, $result);
    }
}