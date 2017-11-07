<?php
/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 2017/11/7
 * Time: 下午12:38
 */

namespace Woodw\Utils\Helpers;

use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class FileHelper {

    /**
     * 确认路径存在 ，不存在创建
     * @author wjh
     * @date 2017-5-25
     *
     * @param type $save_path
     * @return bool
     */
    public static function ensure_path_exists($save_path) {
        if (!file_exists($save_path)) {
            $result = mkdir($save_path, 0777, true);
            chmod($save_path, 0777);
            return $result;
        }
        return true;
    }

    /**
     * 获取日志文件目录名称，目录在public/log 下面 [否决的]请使用LogService 中对应方法
     * @author wjh
     * @date 2017-5-25
     * @deprecated
     *
     * @return string
     */
    public static function getLogFile($name) {
        $ymd = date('Y-m-d', time());
        $logFile = "log/{$ymd}/$name";
        $logPath = pathinfo($logFile)['dirname'];
        if (!self::ensure_path_exists($logPath))
            return false;//var_dump_die('logger error');

        return $logFile;
    }


    /**
     * 接口调用记录错误日志 [否决的]请使用LogService 中对应方法
     *
     * @deprecated
     * @param type $filename
     * @param type $msg
     */
    public static function logFile($filename, $msg) {
        $save_path = __ROOT__ . '/public/log/';
        if (!file_exists($save_path)) {
            mkdir($save_path, 0777);
        }
        //创建文件夹
        $ymd = date("Y-m-d");
        $save_path .= $ymd . "/";

        if (!file_exists($save_path)) {
            mkdir($save_path);
        }
        chmod($save_path, 0777);
        //打开文件
        $fd = fopen($save_path . $filename, "a");
        //增加文件
        $str = "[" . date("Y/m/d h:i:s", time()) . "]" . $msg;
        //写入字符串
        fwrite($fd, $str . "\r\n");
        //关闭文件
        fclose($fd);
    }


}