<?php

function getCode($len, $type = 1)
{
    $code = '';
    switch ($type) {
        case 1:
            $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 2:
            $str = '0123456789';
            break;
        case 3:
            $str = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 4:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 5:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            break;
        default:
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    }
    for ($i = 0; $i < $len; $i++) {
        $code .= $str[mt_rand(0, mb_strlen($str, 'utf-8') - 1)];
    }
    return $code;
}