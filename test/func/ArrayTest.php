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
    public function test22() {
        $this->title(__METHOD__);

        $this->assertEmpty('');

        $this->assertEmpty('1');
    }



    protected function tearDown() {
        parent::tearDown();
    }

}