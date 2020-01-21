<?php
namespace Woodw\Utils\Helpers;

use Woodw\Utils\Bases\HelperBase;

/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 16/4/13
 * Time: 下午6:58
 */
class UtilsHelper extends HelperBase
{

    /**
     * hello
     * @author wjh 2020-01-21
     *
     * @param $text
     * @return string
     */
    public static function hello($text) {
        return "hello $text";
    }


    /*
	 * 获取当前时间
     * @example 2020-01-21 16:20:05
	 */
    public static function getCurrentTime($format = 'Y-m-d H:i:s') {
        date_default_timezone_set('PRC');
        return date($format, time());
    }

    /**
     * 获取当前时间数值(包含毫秒)
     * @example 2020-01-21 16:20:05 644
     * @author wjh 2017-08-03
     * @return string
     */
    public static function getCurrentMicroTime() {
        list($s1, $s2) = explode(' ', microtime());
        $dt = date('Y-m-d H:i:s',floatval($s2));
        $dt2 = substr($s1,2,3);
        return "{$dt} {$dt2}";
    }


    /**
     * 获取当前时间戳(秒级), 如传入 start 则计算2者的差值
     * @author wjh 20141204
     * @param int $start
     * @return float
     */
    public static function getSecond($start = 0) {
        return time() - $start;
    }


    /**
     * 获取当前时间戳(毫秒级), 如传入 start 则计算2者的差值
     * @author wjh 20141204
     * @param int $start
     * @return float
     */
    public static function getMillisecond($start = 0) {
        list($s1, $s2) = explode(' ', microtime());
        $now = (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
        return $now - $start;
    }

}