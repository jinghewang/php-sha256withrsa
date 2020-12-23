<?php
/**
 * Created by PhpStorm.
 * User: hbd
 * Date: 2020-09-18
 * Time: 21:24
 */

namespace Woodw\Services;


/**
 * Class SHA256withRSAService
 * SHA256withRSA
 *
 * @author wjh 2020-09-23
 * @package Woodw\Services
 */
class SHA256withRSAService
{


    /**
     * config
     * @var array
     */
    private $config = [];

    /**
     * constructor.
     * @param array $config
     * @throws \Exception
     */
    public function __construct(array $config) {
        if (empty($config) || (empty($config['rsa_public_key']) && empty($config['rsa_private_key'])))
            throw new \Exception('config is empty');

        $this->config = $config;
    }


    /**
     * 字符串签名 同 SignStrMessage
     * @param string $resource 签名内容
     * @return string 签名
     * @throws \Exception
     */
    public function rsaSign($resource) {
        return $this->SignStrMessage($resource);
    }


    /**
     * 字符串签名
     * @param string $resource 签名内容
     * @return string 签名
     * @deprecated
     * @throws \Exception
     */
    public function SignStrMessage($resource) {
        $privateKey = openssl_get_privatekey($this->GetPrivateKey());
        $res = openssl_sign($resource, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        openssl_free_key($privateKey);
        if ($res) {
            return base64_encode($signature);
        } else {
            throw new \Exception("String Sign Failed", 10004);
        }
    }


    /**
     * 字符串验签 同 VerifyStrMessage
     * @param string $resource
     * @param string $signature
     * @return bool
     * @throws \Exception
     */
    public function rsaCheck($resource, $signature) {
        return $this->VerifyStrMessage($resource,$signature);
    }


    /**
     * 字符串验签
     * @param string $resource
     * @param string $signature
     * @return bool
     * @deprecated
     * @throws \Exception
     */
    public function VerifyStrMessage($resource, $signature) {
        $signature = base64_decode($signature);
        $publicKey = openssl_get_publickey($this->GetPublicKey($this->config['rsa_public_key']));
        $res = openssl_verify($resource, $signature, $publicKey, OPENSSL_ALGO_SHA256);
        openssl_free_key($publicKey);
        return $res === 1 ? true : false;
    }


    /**
     * 获取平台私钥
     * @return string
     * @throws \Exception
     */
    private function GetPrivateKey() {
        $privateKey = $this->config['rsa_private_key'];
        if (empty($privateKey))
            throw new \Exception("rsa_private_key is empty", 10001);

        $privateKey = chunk_split($privateKey, 64, "\n");
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n$privateKey-----END RSA PRIVATE KEY-----\n";
        return $privateKey;
    }


    /**
     * 获取商户公钥
     * @param $mer_public_key
     * @return string
     * @throws \Exception
     */
    private function GetPublicKey($mer_public_key) {
        if (empty($mer_public_key))
            throw new \Exception("mer_public_key is empty", 10001);

        $publicKey = chunk_split($mer_public_key, 64, "\n");
        $publicKey = "-----BEGIN PUBLIC KEY-----\n$publicKey-----END PUBLIC KEY-----\n";
        return $publicKey;
    }


    /*
	 * 获取当前时间
	 */
    public function getCurrentTime($format = 'Y-m-d H:i:s') {
        date_default_timezone_set('PRC');
        return date($format, time());
    }


    /**
     * 获取签名字符串
     *
     * @author wjh 2018-08-22
     * @param array $array
     * @return string
     */
    public function getSign($array) {
        unset($array['sign']);
        ksort($array);
        $str = $this->ToUrlParams($array);
        return $str;
    }


    /**
     * 转换数组为 URL 参数形式  如：a=1&b=2
     * @author wjh 2018-01-16
     * @param array $array
     * @return string
     */
    public function ToUrlParams(array $array) {
        $buff = "";
        foreach ($array as $k => $v) {
            if ($v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }


}