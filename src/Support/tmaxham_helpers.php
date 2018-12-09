<?php

if (! function_exists('_val')) {
    /**
     * @param mixed      $value
     * @param null|mixed $default
     *
     * @return mixed
     */
    function _val($value, $default = null)
    {
        return is_null($value) ? value($default) : $value;
    }
}
