<?php
/**
 * Mpm
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

class CustomerTopup 
{

    /**
     * Account Inquiry
     * 
     * @param string $token
     * @param array $payload
     * @param string $timestamp in ISO-8601
     * 
     * @return array $response
     */
    public static function accountInquiry($token, $payload, $externalId = "", $timestamp = "")
    {
        if (empty($timestamp) || $timestamp == "") {
            $timestamp = Util::getDateNow();
        }

        if (empty($externalId) || $externalId == "") {
            $externalId = time();
        }

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/emoney/account-inquiry';

        $path = '/snap/' . Config::getVersion() . '/emoney/account-inquiry';
        $sign = Util::generateSignatureService('POST', $path, $token, $payload, $timestamp);
        $headers = [
            'Authorization:' . 'Bearer ' . $token,
            'X-Timestamp:' . $timestamp,
            'X-Partner-Id:' . Config::getClientId(),
            'X-Signature:' . $sign,
            'X-External-Id:' . $externalId,
            'Channel-Id:' . Config::getChannelId(),
        ];

        return Service::serviceCall($url, $headers, $payload, 'POST');
    }

    /**
     * Customer Topup
     * 
     * @param string $token
     * @param array $payload
     * @param string $timestamp in ISO-8601
     * 
     * @return array $response
     */
    public static function topup($token, $payload, $externalId = "", $timestamp = "")
    {
        if (empty($timestamp) || $timestamp == "") {
            $timestamp = Util::getDateNow();
        }

        if (empty($externalId) || $externalId == "") {
            $externalId = time();
        }

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/emoney/topup';

        $path = '/snap/' . Config::getVersion() . '/emoney/topup';
        $sign = Util::generateSignatureService('POST', $path, $token, $payload, $timestamp);
        $headers = [
            'Authorization:' . 'Bearer ' . $token,
            'X-Timestamp:' . $timestamp,
            'X-Partner-Id:' . Config::getClientId(),
            'X-Signature:' . $sign,
            'X-External-Id:' . $externalId,
            'Channel-Id:' . Config::getChannelId(),
        ];

        return Service::serviceCall($url, $headers, $payload, 'POST');
    }

}
