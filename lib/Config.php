<?php
/**
 * Config
 * 
 * @category Class
 * @package PaydiaSNAP
 */

namespace PaydiaSNAP;

/**
 * Paydia SNAP Configuration
 */

class Config 
{

    /**
     * String date format
     * 
     * @var string
     */
    public const DATE_FORMAT = "Y-m-d\TH:i:sP";

    /**
     * Enviroment switch (default set to true)
     * 
     * @var boolean
     */
    protected static $production = true;

    /**
     * API Base URL
     * 
     * @var string
     */
    protected const BASE_URL_SANDBOX = "https://dev-api.paydia.co.id/snap";
    protected const BASE_URL_PRODUCTION = "https://api.paydia.id/snap";
    protected static $baseUrl = self::BASE_URL_PRODUCTION;

    /**
     * API Version
     * 
     * @var string
     */
    protected static $version = 'v1.0';

    /**
     * Client Id
     * 
     * @var string
     */
    protected static $clientId = '';

    /**
     * Client Secret
     * 
     * @var string
     */
    protected static $clientSecret = '';

    /**
     * Private Key
     * 
     * @var string
     */
    protected static $privateKey = '';

    /**
     * Channel Id
     * 
     * @var string
     */
    protected static $channelId = '12345';

    /**
     * User Agent
     * 
     * @var string
     */
    protected static $userAgent = 'paydia-snap-php-v1.0.0';

    /**
     * Constructor
     */
    public function __construct() 
    {
    }

    /**
     * Enable/Disable production mode
     * 
     * @param boolean $value
     * 
     * @return void
     */
    public static function enableProduction($value = true) 
    {
        $baseUrl = $value ? self::BASE_URL_PRODUCTION : self::BASE_URL_SANDBOX;
        self::$baseUrl = $baseUrl;
        self::$production = $value;
    }

    /**
     * Get Base URL
     *
     * @return null|string Base URL
     */
    public static function getBaseUrl()
    {
        return self::$baseUrl;
    }

    /**
     * Get API Version
     *
     * @return null|string API Version
     */
    public static function getVersion()
    {
        return self::$version;
    }

    /**
     * Set Client Id
     * 
     * @param string $value
     * 
     * @return void
     */
    public static function setClientId($value)
    {
        self::$clientId = $value;
    }
    
    /**
     * Get Client Id
     *
     * @return null|string Client Id
     */
    public static function getClientId()
    {
        return self::$clientId;
    }

    /**
     * Set Client Secret
     * 
     * @param string $value
     * 
     * @return $void
     */
    public static function setClientSecret($value)
    {
        self::$clientSecret = $value;
    }

    /**
     * Get Client Secret
     *
     * @return null|string Client Secret
     */
    public static function getClientSecret()
    {
        return self::$clientSecret;
    }

    /**
     * Set privateKey
     * 
     * @param string $value
     * 
     * @return $this
     */
    public static function setPrivateKey($value)
    {
        self::$privateKey = $value;
    }

    /**
     * Get Private Key
     *
     * @return null|string Private Key
     */
    public static function getPrivateKey()
    {
        return self::$privateKey;
    }

    /**
     * Set Channel Id
     * 
     * @param string $value
     * 
     * @return $void
     */
    public static function setChannelId($value)
    {
        self::$channelId = $value;
    }

    /**
     * Get Channel Id
     *
     * @return null|string Channel Id
     */
    public static function getChannelId()
    {
        return self::$channelId;
    }

    /**
     * Get User Agent
     *
     * @return null|string User Agent
     */
    public static function getUserAgent()
    {
        return self::$userAgent;
    }
    
    /**
     * Gets the default configuration instance
     *
     * @return array $config
     */
    public static function getDefaultConfig()
    {
        $config = [
            'production' => self::$production,       
            'baseUrl' => self::$baseUrl,       
            'version' => self::$version,       
            'clientId' => self::$clientId,       
            'clientSecret' => self::$clientSecret,       
            'privateKey' => self::$privateKey,       
        ];

        return $config;
    }

}