<?php

namespace Woodw\Test;

define('APP_PATH',dirname(__DIR__));
require_once  APP_PATH . '/vendor/autoload.php';

use JBZoo\Utils\Arr;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use \PHPUnit\Framework\TestCase;
use Woodw\Utils\Helpers\LoggerHelper;


class BaseTestCase extends TestCase implements LoggerInterface {

    protected function setUp() {
        parent::setUp();

        $this->info('');
        $this->info('run set up!');
    }

    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();
    }

    protected function tearDown() {
        $this->info('run tear down!' . PHP_EOL);

        parent::tearDown();
    }

    public static function tearDownAfterClass() {
        parent::tearDownAfterClass();
    }


    public function emergency($message, array $context = array()) {
        return $this->log(LogLevel::EMERGENCY,$message,$context);
    }

    public function alert($message, array $context = array()) {
        return $this->log(LogLevel::ALERT,$message,$context);
    }

    public function critical($message, array $context = array()) {
        return $this->log(LogLevel::CRITICAL,$message,$context);
    }

    public function error($message, array $context = array()) {
        return $this->log(LogLevel::ERROR,$message,$context);
    }

    public function warning($message, array $context = array()) {
        return $this->log(LogLevel::WARNING,$message,$context);
    }

    public function notice($message, array $context = array()) {
        return $this->log(LogLevel::NOTICE,$message,$context);
    }

    public function info($message, array $context = array()) {
        return $this->log(LogLevel::INFO,$message,$context);
    }

    public function title($message, array $context = array()) {
        $message = str_pad($message,40,'-',STR_PAD_BOTH);
        return $this->log(LogLevel::INFO,$message,$context);
    }

    public function debug($message, array $context = array()) {
        return $this->log(LogLevel::DEBUG,$message,$context);
    }

    /**
     * alias for var_dump
     * @author wjh 2017-10-29
     *
     * @param $message
     * @param array $context
     */
    public function vd($message, array $context = array()) {
        var_dump($message);
        //return $this->log(LogLevel::DEBUG,$message,$context);
    }

    public function log($level, $message, array $context = array()) {
        $name = get_called_class();
        if (is_array($message))
            $message = json_encode($message);
        elseif (is_object($message))
            $message = var_export($message);
        else
            $message = $message;

        //echo "[{$level}] $message" . PHP_EOL;
        return LoggerHelper::log($level,$message,$context);
    }
}