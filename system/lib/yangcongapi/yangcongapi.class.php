<?php
class yangcongapi
{
    protected $config;
    const API_QRCODE_FOR_BINDING = 'https://api.yangcong.com/v2/qrcode_for_binding';
    const API_EVENT_RESULT       = 'https://api.yangcong.com/v2/event_result';
    public function __construct($config)
    {
        $this->setConfig($config);
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function getQrcode()
    {
        $this->config->signature = md5("app_id=" . $this->config->appID . $this->config->key);
        $url = self::API_QRCODE_FOR_BINDING . "?app_id={$this->config->appID}&signature={$this->config->signature}";

        return $this->get($url);
    }

    public function getResultByEvent($eventID)
    {
        $this->config->signature = md5("app_id=" . $this->config->appID . "event_id=" . $eventID . $this->config->key);
        $url = self::API_EVENT_RESULT . "?app_id={$this->config->appID}&event_id={$eventID}&signature={$this->config->signature}";
        return $this->get($url);
    }


    public function get($url)
    {
        if(!function_exists('curl_init')) die('I can\'t get yangcong qrcode without curl extension.');
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        
        if(!$result)
        {
            $this->log('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
            curl_close($ch);
            return false;
        }
        else
        {
            $response = json_decode($result);
            $this->log(var_export($response, true));
            curl_close($ch);
            return $response;
        }
    }
    
    public  function log($response)
    {
        /* Set log file. */
        $logFile = dirname(dirname(dirname(__FILE__))) . '/tmp/log/yangcong.' . date('Ymd') . '.log.php';
        if(!is_writable(dirname($logFile))) return false;

        if(!file_exists($logFile)) file_put_contents($logFile, "<?php die();?> \n");
        file_put_contents($logFile, var_export($response, true));
    }
}
