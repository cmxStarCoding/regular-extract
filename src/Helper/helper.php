<?php

//简单判断字符串是否是正则格式
if (!function_exists('check_is_regular'))
{

    /**
     * 简单判断字符串是否是正则格式
     * @param $regular
     * @return bool
     */
    function check_is_regular( $regular ):bool
    {
        if (preg_match('/^\/.*\/$/', $regular))
        {
            return true;
        }
        return false;
    }
}