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
     * 返回时间差
     * @param $date1 开始时间
     * @param $date2 结束时间
     * @return float|int
     */
    public static function getTimeDiff($date1,$date2)
    {
        try{
            $zero1=strtotime ($date1); //当前时间  ,注意H 是24小时 h是12小时
            $zero2=strtotime ($date2);  //过年时间，不能写2014-1-21 24:00:00  这样不对
            $guonian=ceil(($zero2-$zero1)/60); //60s*60min*24h
            return $guonian;
        }
        catch(\Exception $e){
            return -1;
        }
    }




    /**
     * Pad a string to a certain length with another string
     * @link http://php.net/manual/en/function.str-pad.php
     * @param string $input <p>
     * The input string.
     * </p>
     * @param int $pad_length <p>
     * If the value of pad_length is negative,
     * less than, or equal to the length of the input string, no padding
     * takes place.
     * </p>
     * @param string $pad_string [optional] <p>
     * The pad_string may be truncated if the
     * required number of padding characters can't be evenly divided by the
     * pad_string's length.
     * </p>
     * @param int $pad_type [optional] <p>
     * Optional argument pad_type can be
     * STR_PAD_RIGHT, STR_PAD_LEFT,
     * or STR_PAD_BOTH. If
     * pad_type is not specified it is assumed to be
     * STR_PAD_RIGHT.
     * </p>
     * @return string the padded string.
     * @since 4.0.1
     * @since 5.0
     */
    public static function str_pad2 ($input, $pad_length=60, $pad_string = '-', $pad_type = STR_PAD_BOTH) {
        return str_pad($input,$pad_length,$pad_string,$pad_type);
    }

    /**
     * 获取文件的路径
     * @author wjh 2017-08-28
     * @param string $file
     * @return string
     */
    public static function getPathFromFile($file){
        $path = pathinfo($file);
        return $path['dirname'];
    }

    /**
     * override print_r
     * @author wjh 2014-7-1
     * @param $expression
     * @param array $other
     */
    public static function print_r($expression,...$other) {
        return self::print_p($expression,$other);
    }


    /**
     * print_p
     * @author @author wjh 2017-11-16
     * @param $expression
     * @param array $other
     */
    public static function print_p($expression,...$other){
        self::addPreStart();
        if (!empty($expression))
            print_r($expression);

        foreach ($other as $item) {
            if (!empty($item)){
                print_r($item);
            }
        }
        static::addPreEdn();
    }


    /**
     * print_rc
     * @author @author wjh 2017-11-16
     * @param $expression
     * @param array $other
     */
    public static function print_rc($expression,...$other){
        //self::addPreStart();
        if (!empty($expression))
            print_r($expression);

        foreach ($other as $item) {
            if (!empty($item)){
                print_r($item);
            }
        }
        echo PHP_EOL;
    }


    /**
     * 在输出中添加<pre>
     * @author wjh
     * @version 2014-4-30
     * @return header
     */
    public static function addPreStart() {
        print "<pre>";
    }

    /**
     * 在输出中添加</pre>
     * @author wjh
     * @version 2014-4-30
     * @return header
     */
    public static function addPreEdn() {
        print "</pre>";
    }

    /**
     * 在输出中添加<br>
     * @author wjh
     * @version 2014-4-30
     * @return header
     */
    public static function addBr() {
        print "<br>";
    }

}