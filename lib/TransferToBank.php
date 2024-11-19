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

class TransferToBank 
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

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/emoney/bank-account-inquiry';

        $path = '/snap/' . Config::getVersion() . '/emoney/bank-account-inquiry';
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
     * Transfer to Bank
     * 
     * @param string $token
     * @param array $payload
     * @param string $timestamp in ISO-8601
     * 
     * @return array $response
     */
    public static function transferBank($token, $payload, $externalId = "", $timestamp = "")
    {
        if (empty($timestamp) || $timestamp == "") {
            $timestamp = Util::getDateNow();
        }

        if (empty($externalId) || $externalId == "") {
            $externalId = time();
        }

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/emoney/transfer-bank';

        $path = '/snap/' . Config::getVersion() . '/emoney/transfer-bank';
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
     * Transfer Status
     * 
     * @param string $token
     * @param array $payload
     * @param string $timestamp in ISO-8601
     * 
     * @return array $response
     */
    public static function transferStatus($token, $payload, $externalId = "", $timestamp = "")
    {
        if (empty($timestamp) || $timestamp == "") {
            $timestamp = Util::getDateNow();
        }

        if (empty($externalId) || $externalId == "") {
            $externalId = time();
        }

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/transfer/status';

        $path = '/snap/' . Config::getVersion() . '/transfer/status';
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
