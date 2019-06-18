<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 随机产生安全码
 * @param $len int 长度
 * @param $type int 类型 1全部字母数字  2数字  3小写字母  4大写字母
 * @return string
 */
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


/**
 * 多维数组返回一维数组，拼接字符串输出
 * @param $pieces array 多维数组
 * @param $glue string 分隔符
 * @return string
 */
function r_implode($glue = '', $pieces)
{
    foreach ($pieces as $r_pieces) {
        if (empty($r_pieces) && $r_pieces !== 0 && $r_pieces !== '0' && $r_pieces !== false) {
            continue;
        }
        if ($r_pieces === true) {
            $r_pieces = 'true';
        } elseif ($r_pieces === false) {
            $r_pieces = 'false';
        }
        if (is_array($r_pieces)) {
            $retVal[] = r_implode($glue, $r_pieces);
        } elseif( is_object($r_pieces)){
            $retVal[] = '';
        } else {
            $retVal[] = $r_pieces;
        }
    }
    if (!empty($retVal)) {
        return implode($glue, $retVal);
    } else {
        return '';
    }
}
