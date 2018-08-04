<?php

if (!function_exists('_val')) {
    /**
     * @param $value
     * @param null $default
     *
     * @return mixed
     */
    function _val($value, $default = null)
    {
        return is_null($value) ? value($default) : $value;
    }
}
