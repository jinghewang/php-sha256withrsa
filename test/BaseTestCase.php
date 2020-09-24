<?php

namespace Woodw\Test;

define('APP_PATH',dirname(__DIR__));
require_once  APP_PATH . '/vendor/autoload.php';

use \PHPUnit\Framework\TestCase;


class BaseTestCase extends TestCase {

    protected function setUp() {
        parent::setUp();
    }

    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();
    }

    protected function tearDown() {
        parent::tearDown();
    }

    public static function tearDownAfterClass() {
        parent::tearDownAfterClass();
    }

    /**
     * print_r for console
     * @author wjh 2020-09-24
     * @param mixed ...$args
     */
    protected function print_rc(...$args) {
        echo PHP_EOL;
        array_map(function ($item) {
            echo($item . PHP_EOL);
        }, $args);
    }

}