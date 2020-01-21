# php-utils
# 说明
此部分为项目单元测试部分，需要通过 `phpunit` 进行测试，如未安装 `phpunit`,请自行安装。安装后通过 `phpunit` 运行此部分测试用例。

***
请使用 phpunit-7.5.20 版本

  

# 下载

PHP Archive (PHAR)
We distribute a PHP Archive (PHAR) that contains everything you need in order to use PHPUnit 7. Simply download it from here and make it executable:

Composer
You can add PHPUnit as a local, per-project, development-time dependency to your project using Composer:

➜ wget -O phpunit https://phar.phpunit.de/phpunit-7.phar

➜ chmod +x phpunit

➜ ./phpunit --version
PHPUnit 7.0.0 by Sebastian Bergmann and contributors.

# 使用

```phpunit ArrayTest.php```