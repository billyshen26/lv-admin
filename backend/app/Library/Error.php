<?php
/**
 * Notes:
 * Author: BillyShen likeboat@163.com
 * Time: 2020/2/29 11:58 上午
 */

namespace App\Library;

class Error
{
    public static function errMsg($code)
    {
        $maps = static::getErrs();
        return isset($maps[$code]) ? $maps[$code] : '未知错误';
    }


    /**
     * Notes:
     * Author: BillyShen likeboat@163.com
     * Time: 2020/2/29 11:58 上午
     * @return array
     */
    public static function getErrs()
    {
        return [
            '1000' => '服务器错误',
            '403' => '权限不够',
        ];
    }
}
