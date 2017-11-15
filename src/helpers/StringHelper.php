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
     * @param string $string the string being measured for length
     * @return int the number of bytes in the given string.
     */
    public static function byteLength($string)
    {
        return mb_strlen($string, '8bit');
    }

    /**
     * Check if given string starts with specified substring.
     * Binary and multibyte safe.
     *
     * @param string $string Input string
     * @param string $with Part to search inside the $string
     * @param bool $caseSensitive Case sensitive search. Default is true. When case sensitive is enabled, $with must exactly match the starting of the string in order to get a true value.
     * @return bool Returns true if first input starts with second input, false otherwise
     */
    public static function startsWith($string, $with, $caseSensitive = true)
    {
        if (!$bytes = static::byteLength($with)) {
            return true;
        }
        if ($caseSensitive) {
            return strncmp($string, $with, $bytes) === 0;

        }
        $encoding = Yii::$app ? Yii::$app->charset : 'UTF-8';
        return mb_strtolower(mb_substr($string, 0, $bytes, '8bit'), $encoding) === mb_strtolower($with, $encoding);
    }

    /**
     * Check if given string ends with specified substring.
     * Binary and multibyte safe.
     *
     * @param string $string Input string to check
     * @param string $with Part to search inside of the $string.
     * @param bool $caseSensitive Case sensitive search. Default is true. When case sensitive is enabled, $with must exactly match the ending of the string in order to get a true value.
     * @return bool Returns true if first input ends with second input, false otherwise
     */
    public static function endsWith($string, $with, $caseSensitive = true)
    {
        if (!$bytes = static::byteLength($with)) {
            return true;
        }
        if ($caseSensitive) {
            // Warning check, see http://php.net/manual/en/function.substr-compare.php#refsect1-function.substr-compare-returnvalues
            if (static::byteLength($string) < $bytes) {
                return false;
            }

            return substr_compare($string, $with, -$bytes, $bytes) === 0;
        }

        $encoding = Yii::$app ? Yii::$app->charset : 'UTF-8';
        return mb_strtolower(mb_substr($string, -$bytes, mb_strlen($string, '8bit'), '8bit'), $encoding) === mb_strtolower($with, $encoding);
    }


}