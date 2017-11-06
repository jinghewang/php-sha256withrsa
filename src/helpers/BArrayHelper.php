<?php
namespace Woodw\Helpers;


class BArrayHelper {

    /**
      * 将2维数组中第二维数组的指定键的值转化为第一维数组的索引
      * @author wjh modify 2014-6-13
      * @param array $arr
      * @param string $key
      * @return array
      */
     public static function keyArray($arr, $key) {
        if ($arr instanceof CActiveRecord) {
            $arr = array($arr->attributes);
        }
        elseif(self::isCActiveRecordArray($arr)){
            $arr = self::getModelAttributesArray($arr);
        }
        else{

        }

          $returnArr = array();
          foreach ($arr as $row) {
               $returnArr[$row[$key]] = $row;
          }
          return $returnArr;
     }


    /**
     * array_value_exists
     * @author wjh 2014-8-19
     * @param mixed $value
     * @param array $search
     * @return bool
     */
    public static function array_value_exists($value , array $search ){
        if(is_string($search))
            $search  = array($search);

        $data = array_filter($search, function ($v) use ($value) {
            return $v == $value;
        });
        return array_count_values($data);
    }


    /**
     * array_remove_values
     * @author wjh 2014-8-19
     * @param array $arr
     * @param mixed $values string or array
     * @return array
     */
    public static function array_remove_values(array $arr,$values ){
        if(!is_array($values))
            $values = array($values);

        return array_filter($arr, function ($v) use ($values) {
            return !BArrayHelper::array_value_exists($v,$values);
        });
    }

    /**
     * array_remove_keys
     * @author wjh 2014-8-19
     * @param array $arr
     * @param mixed $keys string or array
     * @return array
     */
    public static function array_remove_keys(array $arr,$keys ){
        if(!is_array($keys))
            $keys = array($keys);

        $arr = array_flip($arr);
        $data = array_filter($arr, function ($v) use ($keys) {
            return !BArrayHelper::array_value_exists($v,$keys);
        });
        return array_flip($data);
    }


    /**
     * remove empty
     * @author wjh 20141216
     * @param array $arr
     * @return array
     */
    public static function array_remove_empty(array $arr){
        return self::removeEmpty($arr);
    }


    /**
     * array_filter
     * @param array $input
     * @param callback $callback
     * <p>
     * Typically, funcname takes on two parameters.
     * The array parameter's value being the first, and
     * the key/index second.
     * </p>
     * @return array
     */
    public static function array_filter(array $input, $callback = null){
        $data = array();
        array_walk($input, function ($v, $k) use(&$data, $callback) {
            if ($callback($v, $k)) {
                $data[$k] = $v;
            }
        });
        return $data;
    }


    /**
     * 判断数组是否CActiveRecord
     * @author wjh 2014-6-13
     * @param array $model
     * @return bool
     */
    public static function isCActiveRecord($model) {

        if ($model instanceof \Phalcon\Mvc\Model) {
            return true;
        }
        return false;
    }

    /**
     * 判断2维数组是否CActiveRecord 数组
     * @author wjh 2014-6-13
     * @param array $models
     * @return bool
     */
    public static function isCActiveRecordArray($models) {

        foreach ($models as $row) {
            if(!$row instanceof \Phalcon\Mvc\Model){
                return false;
            }
        }
        return true;
    }

     /**
      * 将同构的多维多层次数组递归的方法转化为2维数组
      * @param array $arr
      * @return array
      */
     public static function arrayToList($arr) {
          $list = array();

          foreach ($arr as $index => $row) {
               $children = null;
               if (isset($row['child'])) {
                    $children = $row['child'];
                    unset($row['child']);
               }
               if (isset($row['children'])) {
                    $children = $row['children'];
                    unset($row['children']);
               }
               if (!empty($children)) {
                    $list[] = $row;
                    foreach (self::arrayToList($children) as $child) {
                         $list[] = $child;
                    }
               } else {
                    $list[] = $row;
               }
          }
          return $list;
     }

     /**
      * 根据数组键，模糊查询对象
      * @author wangjingzhi
      * @date May 19, 2014 12:54:43 PM
      * @param array $array
      * @param 查询的键 $searchKey
      * @return $obj
      *
      */
     public static function searchArrayByKey($array, $searchKey) {
          $obj = array();
          if ($array == null || count($array) < 1)
               return $obj;
          if ($searchKey == null || count($searchKey) < 1)
               return $obj;

          foreach ($array as $k => $v) {
               if (strpos($k, $searchKey) !== false)
                    $obj[] = $array[$k];
          }
          return $obj;
     }


    /**
     * 二维数组检索,返回一条记录或者一个值
     * @author wjh 2014-9-12
     * @param string $searchKey
     * @param string $searchValue
     * @param string $returnKey [optional]
     * @param array $haystack
     * @return mixed|null
     */
    public static function array_search_two($searchKey,$searchValue,$returnKey=null ,array $haystack){
        if (self::isCActiveRecordArray($haystack)) {
            $haystack = self::getModelAttributesArray($haystack);
        }

        $data = array_filter($haystack,function($v)use($searchKey,$searchValue){
            return isset($v[$searchKey]) && ($v[$searchKey] == $searchValue);
        });

        $obj = null;
        if(count($data)>0){
            $obj = array_pop($data);
        }
        return is_null($returnKey)?$obj:$obj[$returnKey];
    }

    /**
     * 对 array_filter 二维数组搜索实现，返回数据
     * @author wjh 2014-5-27
     * @param array $input
     * @param string $skey search key
     * @param string $svalue search value
     * @return array
     */
    public static function array_filter_two($input,$skey,$svalue ){
        $data = array();
        foreach ($input as $key => $value) {
            if(is_array($value)){
                if($value[$skey] == $svalue){
                    $data[] = $value;
                }
            }
            elseif(is_object($value)){
                if($value->$skey==$svalue){
                    $data[] = $value;
                }
            }
            else{
                throw new Exception('not support type:');
            }
        }
        return $data;
    }


    /**
     * 对 array_filter 二维数组搜索实现 $input[$skey] = $svalue
     * @author wjh 2014-5-27
     * @param array $input
     * @param string $func search key
     * @param string $func_condition search value
     * @return array
     */
    public static function array_update_two(&$input,$func,$func_condition=null,$userdata=null){
        $data = array();
        foreach ($input as $key => &$value) {
            if(!empty($func_condition)){
                if($func_condition($key,$value,$userdata)){
                    $func($key,$value,$userdata);
                }
            }
            else{
                 $func($key,$value,$userdata);
            }
        }
        return $data;
    }


    /**
     * 对 array_column 实现,返回一维数组
     * @author wjh 2014-5-27
     * @param array $input
     * @param string $valuecolumn
     * @param string $indexcolumn
     * @param string $prestring 处理索引为数字类型时，PHP会按照索引处理问题
     * @return array 返回一维数组
     */
    public static function array_column($input,$valuecolumn,$indexcolumn=null,$prestring=null){
        $data = array();
        if(self::isCActiveRecordArray($input))
            $input = self::getModelAttributesArray($input);

        foreach ($input as $key => $value) {
            if(is_null($indexcolumn)){
                $data[] = $value[$valuecolumn];
            }
            else{
                $key = (empty($prestring)?'':$prestring).$value[$indexcolumn];
                $data[$key] = $value[$valuecolumn];
            }
        }
        return $data;
    }


    /**
     * 对数据进行join 操作
     * @author wjh
     * @date 20160921
     *
     * @param $input
     * @param $valuecolumn
     * @param string $separator
     * @return string
     */
    public static function array_join($input, $valuecolumn, $separator=',') {
        $data =  self::array_column($input,$valuecolumn);
        return implode($separator,$data);
    }


    /**
     * 对 array_column_filter 过滤数组列，返回二维数组
     * @author wjh 2014-5-27
     * @param array $input
     * @param array $columns
     * @param string $keyname key column name
     * @return array 返回二维数组
     */
    public static function array_column_filter($input,$columns,$keyname=null){
        if (is_string($columns)) {
            $columns = array($columns);
        }

        $data = array();
        foreach ($input as $key => $value) {
            foreach ($columns as $column) {
                $row[$column] = isset($value[$column])?$value[$column]:null;
            }

            if(is_null($keyname)){
                $data[] = $row;
            }
            else{
                $data[$value[$keyname]] = $row;
            }
        }
        return $data;
    }


    /**
     * 获取类型定义中的 index 或 key
     * @author wjh 2014-6-3
     * @param array $arr
     * @param string $text index or key
     * @return string
     */
    public static function getKey($arr,$text){
        $result = BArrayHelper::array_func($arr,
            function($k, $v, $userdata) use($text) {
                return $k;
            },
            function ($k, $v, $userdata) use($text) {
                return trim($v) == trim($text);
            });

        return is_null($result) ? '' : implode(',',$result);
    }

    /**
     * 获取类型定义的值（文本）内容
     * @author wjh 2014-6-3
     * @param array $arr
     * @param mixed $index index or key name
     * @return mixed
     */
    public static function getValue($array, $index) {
        $str = '';
        if ($array != null && $index != null) {
            if(array_key_exists($index,$array)){
                $str = $array[$index];
            }
            else{
                $str = null;
            }
        }
        return $str;
    }


    /**
     * 判断数组是否为键值数组
     * @author wjh
     * @date 2014-5-30
     * @param $arr
     * @return bool
     */
    public static function isKeyArray($arr)
    {
        if(!is_array($arr)){
            return false;
        }

        if (is_array($arr) && count($arr) && (array_keys($arr) !== range(0, sizeof($arr) - 1))) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 过滤掉数组中null数值，或者空数值,主要应用于 CActiveRecord 空数值过滤
     * @author wjh
     * @date 2014-5-30
     * @param $arr
     * @return array
     */
    public static function filterArray($arr)
    {
        if(!is_array($arr)){
            return false;
        }

        $data = array();
        foreach ($arr as $key => $value) {
            if(!empty($value)){
                $data[$key] = $value;
            }
        }
        return $data;
    }


    /**
     * 过滤掉数组中空元素
     * @author wjh
     * @date 2014-7-8
     * @param array $arr 缓缓
     * @param bool $unique 是否进行 unique 处理
     * @return array
     */
    public static function removeEmpty($arr,$unique=false)
    {
        if(!is_array($arr)){
            return false;
        }

        $data = array();
        foreach ($arr as $key => $value) {
            if(!empty($value)){
                $data[$key] = $value;
            }
        }
        if($unique)
            $data = array_unique($data);

        return $data;
    }

    /**
     * 过滤掉数组中空元素
     * @author lvkui
     * @date 2014-7-8
     * @param array $arr
     * @return array
     */
    public static function removeEmptyOrNull(&$arr)
    {
        foreach($arr as $key=>$v){
            if (is_array($v)) {
                if($v){
                    self::removeEmptyOrNull($arr[$key]);
                }else{
                    unset($arr[$key]);
                }
            }else{
                if(!$v){
                    unset($arr[$key]);
                }
            }
        }
        return $arr;
    }


    /**
     * 对每个数组元素根据条件调用函数进行处理,并进行排序处理，返回处理后数组
     * 可以用 use 引用外部变量
     * @author wjh
     * @date 2014-5-30
     * @example
     * $data = $this->array_func($list,
     *         function($k,$v,$userdata=null){
     *              return array('iid'=>$v['iid'],'parentid'=>$v['parentid']);
     *         },
     *         function($k,$v,$userdata=null){
     *              return $v['iid']<5;
     *         },
     *         function($a,$b){
     *             if ($a['iid'] == $b['iid']) {
     *                  return 0;
     *             }
     *             return ((int)$a['iid']<(int)$b['iid'])?-1:1;
     *         },$estr);
     *
     * @param array $arr
     * @param callable $func function name to call,or function body
     * @param callable $condition function name to condition,or function body
     * @param callable $sort function name to sort,or function body
     * @param mixed $userdata user data
     * @return array
     */
    public static function array_func($arr,$func=null,$condition=null,$sort=null,$userdata=null){
        $data= array();
        foreach ($arr as $key => $value) {
            if(!is_null($condition)){
                if($condition($key,$value,$userdata)){
                    if(!is_null($func)){
                        $data[] = $func($key,$value,$userdata);
                    }
                    else{
                            $data[] = $value;
                    }
                }
            }
            else{
                if(!is_null($func)){
                    $data[] = $func($key,$value,$userdata);
                }
                else{
                    $data[] = $value;
                }
            }
        }

        //sort
        if(!is_null($sort)){
            uasort($data,$sort);
        }

        return $data;
    }


    /**
     * 对每个数组元素调用函数,最后进行求和
     * @author wjh
     * @date 2014-5-30
     * @example
     * $data = $this->array_func_sum($list,function($k,$v,$userdata=null){
     *              return (int)$v['count']*3*(int)$userdata;
     *         },
     *         function($key, $value, $userdata){
     *              return $value->reffer_sku_id==0;
     *         },$estr);
     *
     * @param array $arr
     * @param string $func_sum function name to sum,or function body
     * @param callable $condition function name to condition,or function body
     * @param mixed $userdata user data
     * @return array
     */
    public static function array_func_sum($arr,$func_sum,$condition=null,$userdata=null){
        $data = 0;
        foreach ($arr as $key => $value) {
            if(!is_null($condition)){
                if($condition($key,$value,$userdata)){
                    $data += (float)$func_sum($key, $value, $userdata);
                }
            }
            else{
                $data += (float)$func_sum($key, $value, $userdata);
            }
        }
        return $data;
    }


    /**
     * 对数组进行排序处理，返回处理后数组
     * @author wjh
     * @date 2014-12-2
     * @example
     * $data = $this->array_func_sort($list,
     *         function($a){
     *             return str_len($a['iid']);
     *         },false);
     *
     * @param array $arr
     * @param callable $sortitem function name to sort,or function body with one param item
     * @return array
     */
    public static function array_func_sort($arr,$sortitem,$revert=false){
        $data= $arr;
        $sort = function ($a, $b) use ($sortitem, $revert) {
            if ($sortitem($a) == $sortitem($b))
                return 0;
            return $sortitem($a) < $sortitem($b) ? ($revert ? 1 : -1) : ($revert ? -1 : 1);
        };

        //sort
        if(!is_null($sort)){
            uasort($data,$sort);
        }
        return $data;
    }

    public static function array_func_index($sortitem){
       $arr=array();
        foreach($sortitem as $s){
            $arr[]=$s;
        }
        return $arr;
    }



    /**
     * 把 models 数组转换为普通的数组
     * @author wjh 2014-6-3
     * @param $models
     * @param string $index index/key column name
     * @param string $prechar index pre char
     * @throws Exception
     * @return array
     */
    public static function getModelAttributesArray($models,$index=null,$prechar=null)
    {
        if(!self::isCActiveRecordArray($models))
             throw new Exception('models not is CActiveRecord');

        $data = array();
        foreach ($models as $key => $value) {
            if (empty($index))
                $data[] = $value->attributes;
            else
                $data[$prechar.$value->$index] = $value->attributes;
        }
        return $data;
    }

    /**
     * 把 models 数组转换为普通的数组
     * @author wjh 2014-6-3
     * @param $data
     * @param $model
     * @return array
     * @throws Exception
     */
    public static function getModelArrayFromArray($data,$model)
    {
        if(!is_array($data)){
            throw new Exception('$data not is CActiveRecord');
        }

        $models = array();
        foreach ($data as $key => $value) {
            $model = new $model();
            $model->attributes = $value;
            $models[] = $model;
        }

        return $models;
    }


    /**
     * 把 models 数组转换为带索引 models数组
     * @author wjh 2014-12-27
     * @param array $models
     * @param string $index 索引字段
     * @param string $prechar 前导字符
     * @throws Exception
     * @return array
     */
    public static function getModelIndexArray($models,$index=null,$prechar=null)
    {
        if(!self::isCActiveRecordArray($models))
            throw new Exception('models not is CActiveRecord');

        $data = array();
        foreach ($models as $key => $value) {
            if (empty($index))
                $data[] = $value;
            else
                $data[$prechar.$value->$index] = $value;
        }
        return $data;
    }


    /**
     * 根据传入的键或者索引进行二维数组合并
     * @author wjh 2014-6-3
     * @param array $arr1
     * @param array $arr2
     * @param string $key1 key of $arr1
     * @param string $key2 key of $arr2
     * @return array
     */
    public static function array_merge_two($arr1,$arr2,$key1=null,$key2=null){
        $data = array();
        if(!is_null($key1)){
            $arr1 = self::keyArray($arr1, $key1);
        }

        if(!is_null($key2)){
            $arr2 = self::keyArray($arr2, $key2);
        }

        foreach ($arr1 as $k1 => $v1) {
            $data[$k1] = array_merge(isset($arr1[$k1]) ? $arr1[$k1] : array(), isset($arr2[$k1]) ? $arr2[$k1] : array());
        }

        return $data;
    }

    /**
     * 对 array_diff 再次实现，实现双向差集和去重复功能
     * 数组为索引数组
     * @author wjh 2014-9-4
     * @param $arr1
     * @param $arr2
     * @return array
     */
    public static function array_diff($arr1,$arr2){
        return array_unique(array_merge(array_diff($arr1, $arr2),array_diff($arr2,$arr1)));
    }

    /**
     * array_pad 二维数组实现
     * @author wjh 2014-6-12
     * @param array $arr1
     * @param array $pad
     * @return array
     */
    public static function array_pad_two($arr1,$pad){
         $data = array();
         foreach ($arr1 as $k1 => $v1) {
              $data[$k1] = $pad;
         }
         
         return self::array_merge_two($arr1, $data);
    }

    /**
     * @description 多维数组排序
     * @param $arr 需要排序的数组
     * @param $keys 排序的键 key [asc|desc][,key [asc|desc]]
     * @return array 排序后的数组
     */
    public static function array_sort($arr,$keys){
        $keyarr = explode(",",$keys);
        if(count($keyarr)>1){
            $key = $keyarr[0];
            $restkeyarr = array_slice($keyarr,1);
            $restkeys = implode(",",$restkeyarr);
            $temparr = self::array_sort($arr,$restkeys);
            return self::array_sort($temparr,$key);
        }else{
            $keysvalue = $new_array = array();
            $keysplit = explode(" ",$keys);
            $key = $keysplit[0];
            $order = "asc";
            if(count($keysplit)>1)$order = $keysplit[1];
            foreach ($arr as $k => $v){
                if(preg_match("/^[0-9]{4}(\-|\/)[0-9]{1,2}(\\1)[0-9]{1,2}(|\s+[0-9]{1,2}(|:[0-9]{1,2}(|:[0-9]{1,2})))$/",$v[$key]))
                    $keysvalue[$k] = strtotime($v[$key]);
                $keysvalue[$k] = $v[$key];
            }
            if($order == 'asc'){
                asort($keysvalue);
            }else{
                arsort($keysvalue);
            }
            reset($keysvalue);
            foreach ($keysvalue as $k => $v){
                $new_array[] = $arr[$k];
            }
            return $new_array;
        }
    }


    /**
     * 获取数组的维度
     * @author wjh 2014-6-13
     * @param  [type] $arr [description]
     * @return [type]      [description]
     */
    public static function getArrayLevel($arr){
        $al = array(0);
        function aL($arr,&$al,$level=0){
            if(is_array($arr)){
                $level++;
                $al[] = $level;
                foreach($arr as $v){
                    aL($v,$al,$level);
                }
            }
        }
        aL($arr,$al);
        return max($al);
    }
    
    
    /**
     * 
     * 根据属性$key把数组装成
     * 
     * @param 需要处理的数据对象 $arr
     * @param 处理对象的属性 $key
     */
    public static function arrayToListByKey($arr, $key) {
        $list = array();
        foreach ($arr as $k => $value) {
            if(empty($list)) {
            	$array = array();
            	$array[] = $value;
            	$list[$value[$key]] = $array;
            } else {
            	if( isset($value) && isset($list[$value[$key]])) {
            		$s =  $list[$value[$key]];
            		if($s == null) {
            			$array = array();
            			$array[] = $value;
            			$list[$value[$key]] = $array;
            		} else {
            			$s[] = $value;
            			$list[$value[$key]] = $s;
            		}
            	} else {
            		$array = array();
            		$array[] = $value;
            		$list[$value[$key]] = $array;
            	}
            }
        }
        return $list;
    }

    /**
     * 获取树下第一个匹配ctype的子树
     * @param $tree
     * @param $condition
     * @return array
     * @throws Exception
     */
    public static function getFirstConditionTree($tree, $condition, $prior = 'horizontal'){
        if(!is_array($condition))
            throw new Exception('$condition must be a array');
        $matchs = 0;
        foreach($condition as $key => $value){
            if(isset($tree[$key]) && $tree[$key] == $value)
                $matchs++;
        }
        if($matchs == count($condition))
            return $tree;
        if(isset($tree['children'])){
            if($prior == 'horizontal'){
                foreach($tree['children'] as $index => $child){
                    $matchs = 0;
                    foreach($condition as $key => $value){
                        if(isset($child[$key]) && $child[$key] == $value)
                            $matchs++;
                    }
                    if($matchs == count($condition))
                        return $child;
                }
            }

            foreach($tree['children'] as $index => $child){
                $matchTree = self::getFirstConditionTree($child, $condition, $prior);
                if(count($matchTree) > 0) {
                    return $matchTree;
                }
            }
        }
        return array();
    }

    /**
     * 分项list转化为tree结构
     * @param $list
     * @param $pk
     * @param int $parentId
     * @param string $parentTag
     * @param string $childrenTag
     * @return array
     */
    public static function arrayListToTree(&$list, $pk, $parentId = 0, $parentTag = 'parentid', $childrenTag = 'children'){

        $root = array();
        $items = $list;
        if(count($items) > 0){
            foreach($items as $index => $item){
                if($item[$parentTag] == $parentId){
                    $root[$item[$pk]] = $item;
                    unset($list[$index]);
                    $children = self::arrayListToTree($list,$pk,$item[$pk], $parentTag,$childrenTag);
                    $root[$item[$pk]][$childrenTag] = $children;
                }
            }
        }
        return $root;

    }


    public static function searchTreeByCondition($tree, $condition = array(), $isAnd = false, $isRoot = true){

        $current = $tree;
        if(isset($current['children']))
            unset($current['children']);
        $isMatch = false;
		$matchCount = 0;
        foreach($condition as $key => $value){
            if(is_array($value)){
                foreach($value as $v){
                    if(isset($current[$key]) && $current[$key] == $v)
						$matchCount++;
                        //$isMatch = true;
                }
            }else if(isset($current[$key]) && $current[$key] == $value){
				$matchCount++;
                //$isMatch = true;
            }
        }
		if($isAnd){
			if($matchCount == count($condition))
				$isMatch = true;
		}else{
			if($matchCount > 0)
				$isMatch = true;
		}
        $matchs = array();
        if(isset($tree['children']) && count($tree['children']) > 0){
            foreach($tree['children'] as $index => $child){
                $match = self::searchTreeByCondition($child, $condition, $isAnd, false);
                if(count($match) > 0)
                    $matchs[] = $match;
            }
        }
        if(count($matchs) == 1){
            $matchs = $matchs[0];
        }
        if($isMatch && count($matchs) > 0)
            $current['children'] = $matchs;
        else if(!$isMatch)
            $current = $matchs;

        return $current;


    }

	/**
	 * 根据$key处理$list数据,返回二维数组；
	 *
	 * @param $list
	 * @param $key
	 * @return Array Map;
	 */
	public static function model_group($list, $key){
		if((!isset($list)) || empty($list)) return null;
		$groups = array();
		if(is_array($list)) {
			foreach($list as $item) {
				$items = array();
				$val = BDataHelper::getModelProperty($item, $key);
				if(isset($groups[$val])) {
					$items = $groups[$val];
				}
				$items[] = $item;
				$groups[$val] = $items;
			}
		}
		return $groups;
	}

	/**
	 * 转化成查询in（）中的字符串
	 *
	 * @author wangjingzhi
	 * @param $arr
	 * @return string '1','2','3'
	 */
	public static function arrayToString($arr) {
		$str = '';
		if (!empty($arr)) {
			$i = 1;
			foreach ($arr as $k => $v) {
				$str .= "'$v'";
				if ($i != count($arr)) {
					$str .= ',';
				}
				$i++;
			}
			unset($i);
		}
		return $str;
	}

	/**
	 * 将数组转换成树
	 * @author bolen
	 * @param array $sourceArr  要转换的数组
	 * @param string $key 数组中确认父子的key
	 * @param string $parentKey 数组中父key，默认为='parentid'
	 * @param string $childrenKey 要在树节点上索引子节点的key;默认为='children'
	 * @return array 返回生成的树
	 */
	public static function arrayToTree($sourceArr, $key, $parentKey = 'parentid', $childrenKey = 'children') {
		$tempSrcArr = array();

		$allRoot = TRUE;
		foreach ($sourceArr as  $v) {
			$isLeaf = TRUE;
			foreach ($sourceArr as $cv ) {
				if (($v[$key]) != $cv[$key]) {
					if ($v[$key] == $cv[$parentKey]) {
						$isLeaf = FALSE;
					}
					if ($v[$parentKey] == $cv[$key]) {
						$allRoot = FALSE;
					}
				}
			}
			if ($isLeaf) {
				$leafArr[$v[$key]] = $v;
			}
			$tempSrcArr[$v[$key]] = $v;
		}
		if ($allRoot) {
			return $tempSrcArr;
		} else {
			unset($v, $cv, $sourceArr, $isLeaf);
			foreach ($leafArr as  $v) {
				if (isset($tempSrcArr[$v[$parentKey]])) {
					$tempSrcArr[$v[$parentKey]][$childrenKey] = (isset($tempSrcArr[$v[$parentKey]][$childrenKey]) && is_array($tempSrcArr[$v[$parentKey]][$childrenKey])) ? $tempSrcArr[$v[$parentKey]][$childrenKey] : array();
					array_push ($tempSrcArr[$v[$parentKey]][$childrenKey], $v);
					unset($tempSrcArr[$v[$key]]);
				}
			}
			unset($v);
			return self::arrayToTree($tempSrcArr, $key, $parentKey, $childrenKey);
		}
	}

    /**
     * 获取数组的维度
     * @author lvkui
     * @param $arr
     * @return int
     */
    public static function  getLevel($arr){
        if(!is_array($arr)){
            return 0;
        }else{
            $dimension = 0;
            foreach($arr as $item1)
            {
                $t1=self::GetLevel($item1);
                if($t1>$dimension){$dimension = $t1;}
            }
            return $dimension+1;
        }
    }

    /**
     * 判断字符串中是否包含数据中的字符
     * @author wjh
     * @date 20170628
     * @param array $keys
     * @param string $needle
     * @return bool
     */
    public static function strInArray(array $keys,$needle){
        //$keys = ['INFORMATION_SCHEMA','bbb'];
        foreach ($keys as $key) {
            if (strstr($needle,$key)===false){

            }else{
                return true;
            }
        }
        return false;
    }
}
