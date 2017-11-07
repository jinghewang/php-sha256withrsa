# php-utils
# 说明
此部分为项目单元测试部分，需要通过 `phpunit` 进行测试，如未安装 `phpunit`,请自行安装。安装后通过 `phpunit` 运行此部分测试用例。

***
请使用 PHPUnit 5.7 稳定版本


> PHPUnit 5.7 是之前旧的 稳定 版本。
  它 稳定 于 2016年12月02日。
  

# 下载

我们用一个 PHP Archive (PHAR) 来包含你需要使用的PHPUnit，可以从这里下载它，使其可执行，并把它放到你的 $PATH 里, 如:

➜ wget http://phar.phpunit.cn/phpunit.phar

➜ chmod +x phpunit.phar

➜ sudo mv phpunit.phar /usr/local/bin/phpunit

➜ phpunit --version
PHPUnit 6.3.0 by Sebastian Bergmann and contributors.

# 使用

```phpunit ArrayTest.php```