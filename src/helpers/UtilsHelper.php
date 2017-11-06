<?php
namespace Woodw\Helpers;

use Woodw\Bases\HelperBase;

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
     * 验证是否进行调试
     * @author wjh 2017-08-02
     * @param string $key key 如 ：api
     * @param string $filter filter 如：api_filter
     * @param string $content
     * @param bool $exclude 验证模式 默认 exclude
     * @return bool
     */
    public static function validateDebugInfo($key, $filter, $content, $exclude = true) {
        $model = UtilsHelper::getDebugInfoConfig($key,0);
        if (empty($model))
            return false;

        $pattern = UtilsHelper::getDebugInfoConfig($filter, '');
        if (!empty($pattern)) {
            $match = preg_match($pattern, $content, $matches);
            if ($exclude) {//exclude
                return !($match == 1);
            } else {//include
                return $match == 1;
            }
        }

        return true;
    }

    /**
     * 获取打印配置信息
     * @author wjh
     * @date 20160420
     * @param string $key 配置项
     * @param null $defaultValue 默认值
     * @return mixed
     */
    public static function getPrinterConfig($key = null, $defaultValue = null)
    {
        if (empty($key))
            return self::getConfig('printer', $defaultValue);
        else
            return self::getConfigValue('printer', $key, $defaultValue);
    }

    /**
     * 获取调试配置信息
     * @author wjh
     * @date 20160420
     * @param string $key 配置项
     * @param null $defaultValue 默认值
     * @return mixed
     */
    public static function getDebugInfoConfig($key = null, $defaultValue = null)
    {
        if (empty($key))
            return self::getConfig('debug_info', $defaultValue);
        else
            return self::getConfigValue('debug_info', $key, $defaultValue);
    }


    /**
     * 获取beanstalk配置信息
     * @author wjh
     * @date 2017-08-01 11:05:01
     * @param string $key 配置项
     * @param null $defaultValue 默认值
     * @return mixed
     */
    public static function getBeanstalkConfig($key = null, $defaultValue = null)
    {
        if (empty($key))
            return self::getConfig('beanstalk', $defaultValue);
        else
            return self::getConfigValue('beanstalk', $key, $defaultValue);
    }


    /**
     * 获取Phalcon配置信息
     * @author wjh
     * @date 2017-08-01 11:05:01
     * @param string $key 配置项
     * @param null $defaultValue 默认值
     * @return mixed
     */
    public static function getPhalconConfig($key = null, $defaultValue = null)
    {
        if (empty($key))
            return self::getConfig('phalcon', $defaultValue);
        else
            return self::getConfigValue('phalcon', $key, $defaultValue);
    }


    /**
     * 获取Log配置信息
     * @author wjh 2017-08-02
     * @param string $key 配置项
     * @param mixed $defaultValue 默认值
     * @return mixed
     */
    public static function getLogConfig($key = null, $defaultValue = null)
    {
        if (empty($key))
            return self::getConfig('log', $defaultValue);
        else
            return self::getConfigValue('log', $key, $defaultValue);
    }


    /**
     * 获取配置信息
     * @author wjh
     * @date 20160420
     * @param string $config 配置节
     * @param string $key 健
     * @param mixed $defaultValue 默认值
     * @return mixed
     */
    public static function getConfigValue($config, $key, $defaultValue = null)
    {
        $di = \Phalcon\DI::getDefault();
        $params = $di->getShared('params');
        if (isset($params) && isset($params[$config]) && isset($params[$config][$key]))
            return $params[$config][$key];
        else
            return $defaultValue;

    }

    /**
     * 获取配置节信息
     * @author wjh
     * @date 20170629
     * @param $config 配置节
     * @param mixed $defaultValue 默认值
     * @return mixed
     */
    public static function getConfig($config, $defaultValue = null)
    {
        $di = \Phalcon\DI::getDefault();
        $params = $di->getShared('params');
        if (isset($params) && isset($params[$config]))
            return $params[$config];
        else
            return $defaultValue;

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
}