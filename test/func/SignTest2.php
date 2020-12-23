<?php
/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 2017/10/25
 * Time: 下午4:08
 */

namespace Woodw\Test;

use \PHPUnit\Framework\TestCase;
use Woodw\Services\SHA256withRSAService;
use Woodw\Test\BaseTestCase;

class SignTest2 extends BaseTestCase{


    /**
     * RSA2 PKCS8(JAVA)
     * @var array
     */
    private $config = [
        //私钥
        'rsa_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqJXdKpSU7gOMGJGAzKktqvClQ4gp+n2pzzZgvrL/UDCYYXH0bk1ELfKkmWEMybicb1kKV9gwsSPospxErRluRarcKT018Y0M5zzWJh+SckGX4d6PLN8JkTycSTA1R6/XI6z9A31lqeht4l8BePZmoWamm9UtIE+afSC6W3Dd5jWSiNO8i4jb6MkmumAfQ6+oMlPd+l7kcXUX9Lg/gSAOBNVE5WIUj+nGy0A2SSUNEmd4eUf7gZ7vE3DE3tM614Z/HNikCPMt0u37P/C+EYvcUDiFIb0I1UDfhsd9dnmOVKqY7+N0P5CTgVaPy3tDcd4WwJO+vbuNCh9RZRNkS68OdwIDAQAB',
        //公钥
        'rsa_private_key' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCold0qlJTuA4wYkYDMqS2q8KVDiCn6fanPNmC+sv9QMJhhcfRuTUQt8qSZYQzJuJxvWQpX2DCxI+iynEStGW5FqtwpPTXxjQznPNYmH5JyQZfh3o8s3wmRPJxJMDVHr9cjrP0DfWWp6G3iXwF49mahZqab1S0gT5p9ILpbcN3mNZKI07yLiNvoySa6YB9Dr6gyU936XuRxdRf0uD+BIA4E1UTlYhSP6cbLQDZJJQ0SZ3h5R/uBnu8TcMTe0zrXhn8c2KQI8y3S7fs/8L4Ri9xQOIUhvQjVQN+Gx312eY5Uqpjv43Q/kJOBVo/Le0Nx3hbAk769u40KH1FlE2RLrw53AgMBAAECggEAREk/5ql8kdRaAPGfDEdSujTznCEhb9dK2yYZleUHScIFVyNDcRJXFY19YqtO9L6Ujv2wFNj7ECWNchueLcdpRUrqFsI2gXsyyM95psOPHDy5esIdmH1XcL7uRy8BxeHR8R929NzsOyBssg7tl8Om2qWrwt9cggP8fcat9bAIEeDjORVvvsNPUfu7ULVxieCxm2QiCkebCoABJrRHVs5V/wQlJlrPgbPVJg0R1wCjPiHMzKWQYx/fcgQH2Y/EEy5O3qylOKezIzVGkxg7C6yxcxCZ4+TmYu8pgraeFCWB4I1SevEeoe91bLJeO2kPGC5vS/WjxduoDL5q+BP6G5L9QQKBgQDwgJgLfBydJsE85MZ856OU4FNK2ZlEpS2FUj+/74laQauDd+pzcdHBHmmmxSHhHkKuY4WvVsWStewNlifuEDhPeoSz6gr7dVfo9a07uViXXyjTBgi6AALuLNTTg8P8HUtOWLzv5ZeYmOuvWqRfqbqQymilJjtsL+dVM7ZTloIB5wKBgQCzcuecREKBtfxKOll7e6MyPKxLeMiBKzOTQ6jykXnhF/y32zZX4PqU4mCjpqDhoeSI1PNCCPCE8mH2KhBeZeG2xUMGJ06w+k+FS+omXUts6D8dKseD7rSc85HfZ7DJpbjyrS4tmz1l82TZom8PvqxaLPlIlJf34eP495HaTXoc8QKBgQDmSwzMuoyfwvN4vsx94EVYkrHPU6wa+lwrdMXMoa+ReJ6mphYfc5bZ6KhcZBn7+cD6QhxJ+Ln5sTAXFnin0mpJWNVnfi4D+aozTcUTEnkNgbaS0w1aJhaoQM+OtnbdnKN2oyxQPzY5jfzpDc+mNt2KNfecZI60Gu7WPE1TnyRgcwKBgA8etWkzTy9CuDlA5V1EM6H9/r51NN+9ViEoaEnX/B79OGv9anzJFhQJZv8jARdB3tGwr7Z2rl1lVt+495wclYIi6NzR3w2GacDffqEw5zQL9ZVtj1YMfOdklnvubrTu48B+2w84r1mxwmOcDiOTe041z+NPseZPADhwE7gDIzDhAoGBAJq0UlPBJzbb8EItKw0vBU1ZV/YilSgWtpcQXbmZgWuH0eGSa5blHlj2hzAB1H3sgRFxZ80iWZpee3hE0DKi8U1CA8ZrO2Np7BqpKciVgwJkoUyUY7LWDWBm9ta5H+SQFsnR2QOVS1V1zjWUNOOL4tNBtRtjSxVyKFkdAGKYeKJw',
    ];


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
    public function sign() {

        $service = $this->getService();
        $text = "welcome to china";

        //计算签名
        $sign = $service->rsaSign($text);
        $this->print_rc( '签名2:' , $sign );

        //验证签名
        $verifyResult = $service->rsaCheck($text, $sign);
        $this->print_rc('签名验证2:' , $verifyResult);

        //如果需要处理  array -> url  调用如下方法：
        //$let_data = ['name'=>'wjh','age'=>10];
        //$url = $service->getSign($let_data);
        //echo('URL数据：'. $url. PHP_EOL);

        $this->assertTrue($verifyResult, 'sign fail');
    }

    /**
     * @test
     */
    public function url() {
        $service = $this->getService();

        //如果需要处理  array -> url  调用如下方法：
        $let_data = ['name'=>'wjh','age'=>10,'sex'=>'male'];
        $url = $service->getSign($let_data);
        $this->print_rc('URL数据：', $url);

        $this->assertNotEmpty($url, 'url is fail');
    }


    protected function tearDown() {
        parent::tearDown();
    }

    /**
     * get service
     * @author wjh 2020-09-24
     *
     * @return SHA256withRSAService
     * @throws \Exception
     */
    protected function getService(): SHA256withRSAService {
        return new SHA256withRSAService(['rsa_public_key' => $this->config['rsa_public_key'], 'rsa_private_key' => $this->config['rsa_private_key']]);
    }


}