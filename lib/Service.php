<?php
/**
 * Service
 * 
 * @category Class
 * @package PaydiaSNAP
 */

namespace PaydiaSNAP;

use Exception;
use PaydiaSNAP\Config;
/**
 * Send request to Paydia SNAP API
 * Better don't use this class directly
 */

class Service 
{

    /**
     * Send GET request
     * 
     * @param string $url
     * @param mixed[] $headers
     * @param mixed[] $data
     * @return mixed
     * @throws Exception
     */
    public static function get($url, $headers, $data)
    {
        return self::serviceCall($url, $headers, $data, 'GET');
    }

    /**
     * Send POST request
     *
     * @param string $url
     * @param mixed[] $headers
     * @param mixed[] $data
     * @return mixed
     * @throws Exception
     */
    public static function post($url, $headers, $data)
    {
        return self::serviceCall($url, $headers, $data, 'POST');
    }

    /**
     * Send request to API server
     * 
     * @param string $url
     * @param mixed[] $headers
     * @param mixed[] $data
     * @param string $method
     * @return mixed
     * @throws Exception
     */
    public static function serviceCall($url, $headers, $data, $method)
    {
        $ch = curl_init();

        $curlHeaders = [
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent: ' . Config::getUserAgent(),
        ];
        $curlHeaders = array_merge($curlHeaders, $headers);

        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $curlHeaders,
            CURLOPT_RETURNTRANSFER => 1
        );
        
        if ($method != 'GET') {
            if ($data) {
                $body = json_encode($data);
                $curlOptions[CURLOPT_POSTFIELDS] = $body;
            } else {
                $curlOptions[CURLOPT_POSTFIELDS] = '';
            }

            if ($method == 'POST') {
                $curlOptions[CURLOPT_POST] = 1;
            } elseif ($method == 'PATCH') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            }
        }

        curl_setopt_array($ch, $curlOptions);

        $result = curl_exec($ch);

        if ($result === false) {
            throw new Exception('CURL Error: ' . curl_error($ch), curl_errno($ch));
        } else {
            try {
                $resultArray = json_decode($result, true);
            } catch (Exception $e) {
                throw new Exception('API Request Error unable to json_decode API response: '.$result . ' | Request url: '.$url);
            }
            return $resultArray;
        }
    }

}