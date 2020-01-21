<?php
namespace Woodw\Utils\Helpers;


class ArrayHelper {


    /**
     * array_value_exists
     * @author wjh 2014-8-19
     * @param mixed $value
     * @param array $search
     * @return bool
     * @throws \TypeError
     */
    public static function array_value_exists($value , array $search ){
        if (!is_array($search))
            throw new \TypeError('search is array');

        $data = array_filter($search, function ($v) use ($value) {
            return $v == $value;
        });

        return !empty($data);
    }

}
