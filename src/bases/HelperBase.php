<?php

/**
 * Created by PhpStorm.
 * User: wjh
 * Date: 16/5/10
 * Time: 上午8:38
 */

namespace Woodw\Helpers;


class HelperBase
{

    /**
     * 格式化输出 json
     * @author wjh
     * @date 2016-6-1
     * @param $data
     * @return string
     */
    public static function json_encode_print($data){
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    /**
     * 格式化输出 json
     * @author wjh
     * @date 2017-08-04
     * @param $data
     * @return string
     */
    public static function json_encode($data){
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }


    /**
     * 格式化输出打印调试信息
     * @author wjh
     * @date 2016-6-1
     * @param string $title
     * @param string | array | Model $data
     */
    public static function logPrint($title, $data=null) {
        if ($data instanceof Model)
            $data = $data->toArray();

        logFile('printContent.log', $title . BDataHelper::json_encode_print($data));
    }

    /**
     * 对 JSON 格式的字符串进行编码
     * @author weixiao
     * @date 2017-6-21
     * @param string $json
     * @param bool $assoc
     * @param int    $depth
     * @param int    $options
     * @return mixed
     */
    public static function json_decode_print($json, $assoc = false, $depth = 512, $options = 0)
    {
        $data = \json_decode($json, $assoc, $depth, $options);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(
                'json_decode error: ' . json_last_error_msg());
        }

        return $data;
    }

}