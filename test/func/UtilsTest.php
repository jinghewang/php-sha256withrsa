<?php
/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 2017/10/25
 * Time: 下午4:08
 */

namespace Woodw\Test;

use \PHPUnit\Framework\TestCase;
use Woodw\Test\BaseTestCase;
use Woodw\Utils\Helpers\UtilsHelper;

class UtilsTest extends BaseTestCase{


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
    public function current() {

        //2020-01-21 16:20:05
        $time = UtilsHelper::getCurrentTime();
        $this->assertTrue(strlen($time) == 19);

        //2020-01-21 16:20:05 644
        $micro_time = UtilsHelper::getCurrentMicroTime();
        $this->assertTrue(strlen($micro_time) == 23);

        //$this->assertEmpty('1','332');
    }

    /**
     * @test
     */
    public function time() {

        //2020-01-21 16:20:05
        $time = UtilsHelper::getCurrentTime();
        $this->assertTrue(strlen($time) == 19);

        //2020-01-21 16:20:05 644
        $micro_time = UtilsHelper::getCurrentMicroTime();
        $this->assertTrue(strlen($micro_time) == 23);

        //$this->assertEmpty('1','332');
    }



    protected function tearDown() {
        parent::tearDown();
    }

}