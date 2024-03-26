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

class Mpm 
{

    /**
     * Generate QR
     * 
     * @param string $token
     * @param array $payload
     * @param string $timestamp in ISO-8601
     * 
     * @return array $response
     */
    public static function generateQr($token, $payload, $externalId = "", $timestamp = "")
    {
        if (empty($timestamp) || $timestamp == "") {
            $timestamp = Util::getDateNow();
        }

        if (empty($externalId) || $externalId == "") {
            $externalId = time();
        }

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/qr/qr-mpm-generate';

        $path = '/snap/' . Config::getVersion() . '/qr/qr-mpm-generate';
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
     * Check Status
     * 
     * 
     */
    public static function checkStatusQr($token, $payload, $externalId = "", $timestamp = "")
    {
        if (empty($timestamp) || $timestamp == "") {
            $timestamp = Util::getDateNow();
        }

        if (empty($externalId) || $externalId == "") {
            $externalId = time();
        }

        $payload = array_merge($payload, [
            'serviceCode' => '47'
        ]);

        $url = Config::getBaseUrl() . '/' . Config::getVersion() . '/qr/qr-mpm-status';

        $path = '/snap/' . Config::getVersion() . '/qr/qr-mpm-status';
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