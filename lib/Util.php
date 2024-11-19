<?php
/**
 * Util
 * 
 * @category Class
 * @package PaydiaSNAP
 */

namespace PaydiaSNAP;

use PaydiaSNAP\Config;

class Util 
{

    /**
     * Get today's date in ISO-8601, ie. 2022-10-10T12:08:56+07:00
     * Make sure you set timezone correctly
     *
     * @return string DateTime in ISO-8601
     */
    public static function getDateNow()
    {
		date_default_timezone_set(Config::DATE_TIMEZONE);
        return date(Config::DATE_FORMAT);
    }

    /**
     * Generate string to sign for payload signature
     * 
     * @param ...$args
     * 
     * @return string $payload
     */
    public static function generateStringPayloadSignature(...$args)
    {
        $payload = "";
        if (sizeof($args) == 0) return "";

        for ($i = 0; $i < sizeof($args); $i++) {
            $payload .= $args[$i];
            if ($i != (sizeof($args) - 1)) {
                $payload .= "|";
            }
        }
        
        return $payload;
    }

    /**
     * Generate signature auth
     * 
     * @param string $timestamp in ISO-8601
     * 
     * @return string base64 encoded signature
     */
    public static function generateSignatureAuth($timestamp)
    {
        $privateKey = Config::getPrivateKey();
        $privateKey = <<<EOD
		-----BEGIN RSA PRIVATE KEY-----
		$privateKey
		-----END RSA PRIVATE KEY-----
		EOD;
        $strToSign = self::generateStringPayloadSignature(Config::getClientId(), $timestamp);


        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            $errorLog = [$errno, $errstr, $errfile, $errline];
        });

        openssl_sign($strToSign, $signature, openssl_pkey_get_private($privateKey), "sha256WithRSAEncryption");

        $signature = base64_encode($signature);
        
        restore_error_handler();
        return $signature;
    }

    /**
     * Generate signature service
     * 
     * @param $method method request
     * @param $path endpoint url without domain
     * @param $token bearer token from access token request
     * @param $payload payload body request if method not GET
     * @param $timestamp in ISO-8601
     * 
     * @return string base64 encoded signature
     */
    public static function generateSignatureService($method, $path, $token, $payload, $timestamp)
    {
        $payload = strtolower(bin2hex(hash('sha256', json_encode($payload), true)));
        $strToSign = $method . ':' . $path . ':' . $token . ':' . $payload  . ':' . $timestamp;
        $hash = hash_hmac('sha512', $strToSign, Config::getClientSecret(), true);
        $signature = base64_encode($hash);
        
        return $signature;
    }
    
}
