<?php

namespace Woodw;

use Woodw\Helpers\UtilsHelper;

/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 16/4/13
 * Time: 下午6:58
 */
class Utils extends UtilsHelper
{

    /**
     * hello
     * @author wjh 2017-11-06
     * @param string $message
     */
    public static function hello($message){
        echo "hello:$message";
    }

    /**
     * test
     * @author wjh 2017-11-06
     * @param string $message
     */
    public static function test($message){
        echo "test:$message";
    }
}