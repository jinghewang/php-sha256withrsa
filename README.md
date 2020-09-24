# php-sha256withrsa

# 项目说明
此项目提供SHA256withRSA功能

```
$config['rsa_public_key'] = '公钥';
$config['rsa_private_key'] = '私钥';

$service = new SHA256withRSAService(['rsa_public_key' => $config['rsa_public_key'], 'rsa_private_key' => $config['rsa_private_key']]);
$text = "i am is mingwen";

//计算签名
$sign = $service->SignStrMessage($text);
echo('签名:'.$sign);

//验证签名
$verifyResult = $service->VerifyStrMessage($text, $sign);
echo('签名验证:' . $verifyResult);

//如果需要处理  array -> url  调用如下方法：
$let_data = ['name'=>'wjh','age'=>10];
$url = $service->getSign($let_data);
echo('URL数据：'. $url);
```


# 版本说明




# 测试

* 运行方式1：(命令行方式)
```bash
./phpunit func/ArrayTest.php
```
或 
```bash
./phpunit --bootstrap BaseTestCase.php func/StringTest.php 
```

* 运行方式2：（通过 phpunit.xml 运行）  
 1. 配置 phpunit.xml
 2. 通过 phpunit.xml 运行
 ```
./phpunit
```

# 更新说明
> 此项目不定时更新，更新时间不定，请见谅。
