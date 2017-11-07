<?php
/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 2017/10/25
 * Time: 下午4:08
 */

namespace Woodw\Test;

require_once dirname(__DIR__) . "/BaseTestCase.php";

use \PHPUnit\Framework\TestCase;
use Woodw\Test\BaseTestCase;

class ArrayTest extends BaseTestCase{


    public $name = 'wjh';
    public $age = 10;


    protected function setUp() {
        parent::setUp();

        $this->initSetup();
    }

    protected function initSetup(){
        //$this->warning($this->heap->top());
    }



    /**
     * @test
     */
    public function array_flip_test() {
        $this->title(__METHOD__);

        //--
        $input = array("a" => 1, "b" => 2, "c" => 3);
        print_r2($input);

        //--
        $input2 = array_flip($input);
        print_r2($input2);

        $this->title('each');
        $foo = array("Robert" => "Bob", "Seppo" => "Sepi");
        while(list($bar,$bar2) = each($foo)){
            $this->info("{$bar} -- {$bar2}");
        }

        $this->title('array_map');
        $data =  array_map(function ($value){
            $this->error($value);
            return $value.= '-1';
        },$foo);

        $this->info($data);

        $this->title('array_filter');
        $array1 = array("a"=>1, "b"=>2, "c"=>3, "d"=>4, "e"=>5);
        $data =  array_filter($array1,function ($value,$key){
            $this->error("$value,$key");
            return $value>3;
        },ARRAY_FILTER_USE_BOTH);
        $this->info($data);

        //---
        $this->title('static var');
        $this->myTest();
        $this->myTest();
        $this->myTest();

        print 'wjhlht';
    }

    private function myTest() {
        static $x =0;
        $this->info( $x);
        $x++;
    }


    protected function tearDown() {
        parent::tearDown();
    }

}