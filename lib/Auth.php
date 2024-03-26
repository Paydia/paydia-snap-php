<?php
/**
 * Auth
 * 
 * @category Class
 * @package PaydiaSNAP
 */

namespace PaydiaSNAP;

use Exception;
use PaydiaSNAP\Service;
/**
 * API methods to get access token
 */

class Auth 
{
    /**
     * Timestamp
     * 
     * @var string
     */
    public static $timestamp = "";

    /**
     * Get Access Token B2b
     * 
     * @param string $timestamp in ISO-8601
     * 
     * @return array $response
     */
    public static function getAccessTokenB2b($timestamp = "") 
    {
        if (empty($timestamp)) {
            $timestamp = Util::getDateNow();
            self::$timestamp = $timestamp;
        }

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/access-token/b2b';

        $sign = Util::generateSignatureAuth($timestamp);
        $headers = [
            'X-Timestamp:' . $timestamp,
            'X-Client-Key:' . Config::getClientId(),
            'X-Signature:' . $sign,
        ];

        $payload = [
            'grantType' => 'client_credentials'
        ];

        return Service::serviceCall($url, $headers, $payload, 'POST');
    }

}