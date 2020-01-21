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

class StringTest extends BaseTestCase{


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
    public function test22444() {
        var_dump(__METHOD__);

        $this->assertEmpty('');
        $this->assertEmpty('');
        $this->assertEmpty('');

        //$this->assertEmpty('1','332');
    }



    protected function tearDown() {
        parent::tearDown();
    }

}