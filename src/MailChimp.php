<?php

namespace MailChimpPHP;

use GuzzleHttp\Client;
use MailChimpPHP\Manager\ListManager;

class MailChimp
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $mailChimpVersion;

    /**
     * @var string
     */
    protected $dataCenter;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @param string $apiKey
     * @param string $dataCenter
     * @param string $baseUrl
     * @param string $mailChimpVersion
     */
    public function __construct($apiKey, $dataCenter, $baseUrl = 'api.mailchimp.com', $mailChimpVersion = '3.0')
    {
        $this->apiKey = $apiKey;
        $this->mailChimpVersion = $mailChimpVersion;
        $this->dataCenter = $dataCenter;
        $this->baseUrl = $baseUrl;
    }
    
    public function campaigns()
    {

    }

    /**
     * @param null $handler
     * @return ListManager
     */
    public function lists($handler = null)
    {
        $manager = new ListManager();
        $manager->setClient($this->buildClient($handler))
                ->setConfigurator(new RequestConfigurator());

        return $manager;
    }

    public function subscribers()
    {

    }

    public function reports()
    {

    }

    protected function buildClient($handler = null)
    {
        $options = [
            'base_uri' => 'https://'.$this->dataCenter.'.'.$this->baseUrl.'/'.$this->mailChimpVersion.'/',
            'auth' => ['', $this->apiKey]
        ];

        if($handler) {
            $options['handler'] = $handler;
        }

        return new Client($options);
    }

}