# php-sha256withrsa

# 项目说明
此项目提供SHA256withRSA功能，密钥为 RSA2 PKCS8(JAVA)

```
$config['rsa_public_key'] = '公钥';
$config['rsa_private_key'] = '私钥';

$service = new SHA256withRSAService(['rsa_public_key' => $config['rsa_public_key'], 'rsa_private_key' => $config['rsa_private_key']]);
$text = "i am is mingwen";

//计算签名
$sign = $service->rsaSign($text);
echo('签名:'.$sign);

//验证签名
$verifyResult = $service->rsaCheck($text, $sign);
echo('签名验证:' . $verifyResult);

//如果需要处理  array -> url  调用如下方法：
$let_data = ['name'=>'wjh','age'=>10];
$url = $service->getSign($let_data);
echo('URL数据：'. $url);
```

示例数据：
```
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

$text = "welcome to china";

对应签名:
FvsaQc6iqG65ExLC1eW8bXS+PnAMVhEfLd6O/uJn9S3cNzlVdvZ41Fbh6Pw9u1SwBbQ3OkDV0DdfwYWJZH7xJyNqYdJWdjL/B5KRrbv3Et4RlBbFwWyQCefqXk9FlTHFbgEu6IHXpTkHPxzw3QCfoC1PwCacCNXcbEXbWdeX2wXUmjQjNRgWXSRBeJrJkMyKchtEhOhJlJt9wVhCh0ZUvcbQQ2hd171cK9GBHqNExve5iKCMWfOmvFdEm0CvlzRbyCPuSg2kGL3AsCSaUDKcs0sIwnI6MYENj1z/hxCZAe6eLTM4ruOqF8MES/zgHfROw68hS11VJlApPuqc4y6pMw==

```

# 版本说明
实现 SHA256withRSA 功能。


# 测试

* 运行方式1：(命令行方式)
```bash
./phpunit func/SignTest2.php
```
或 
```bash
./phpunit --bootstrap BaseTestCase.php func/SignTest2.php 
```

* 运行方式2：（通过 phpunit.xml 运行）  
 1. 配置 phpunit.xml
 2. 通过 phpunit.xml 运行
 ```
./phpunit
```

# referred
- [packagist](https://packagist.org/)
