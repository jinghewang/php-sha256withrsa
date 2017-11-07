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

class LoggerHelper{

    public static function getLogger(){
        $logger = new Logger('ErrorLogHandler');
        $logger->pushHandler(new ErrorLogHandler());
        return $logger;
    }

    public static function emergency($message, array $context = array()) {
        return self::log(LogLevel::EMERGENCY,$message,$context);
    }

    public static function alert($message, array $context = array()) {
        return self::log(LogLevel::ALERT,$message,$context);
    }

    public static function critical($message, array $context = array()) {
        return self::log(LogLevel::CRITICAL,$message,$context);
    }

    public static function error($message, array $context = array()) {
        return self::log(LogLevel::ERROR,$message,$context);
    }

    public static function warning($message, array $context = array()) {
        return self::log(LogLevel::WARNING,$message,$context);
    }

    public static function notice($message, array $context = array()) {
        return self::log(LogLevel::NOTICE,$message,$context);
    }

    public static function info($message, array $context = array()) {
        return self::log(LogLevel::INFO,$message,$context);
    }

    public static function title($message, array $context = array()) {
        $message = str_pad($message,40,'-',STR_PAD_BOTH);
        return self::log(LogLevel::INFO,$message,$context);
    }

    public static function debug($message, array $context = array()) {
        return self::log(LogLevel::DEBUG,$message,$context);
    }

    /**
     * alias for var_dump
     * @author wjh 2017-10-29
     *
     * @param $message
     * @param array $context
     */
    public static function vd($message, array $context = array()) {
        var_dump($message);
        //return $this->log(LogLevel::DEBUG,$message,$context);
    }


    public static function log($level, $message, array $context = array()) {
        $logger = self::getLogger();
        $name = get_called_class();
        if (is_array($message))
            $message = json_encode($message);
        elseif (is_object($message))
            $message = var_export($message);
        else
            $message = $message;

        //echo "[{$level}] $message" . PHP_EOL;
        return $logger->log($level,$message,$context);
    }

}