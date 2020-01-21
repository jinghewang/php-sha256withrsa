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

class StringHelper {

    /**
     * Returns the number of bytes in the given string.
     * This method ensures the string is treated as a byte array by using `mb_strlen()`.
     * @param string $text the string being measured for length
     * @return int the number of bytes in the given string.
     */
    public static function hello($text)
    {
        return "hello $text";
    }

}