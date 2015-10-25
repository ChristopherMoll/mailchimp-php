<?php

namespace MailChimpPHP\Manager;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use MailChimpPHP\RequestConfiguratorInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class BaseManager implements ClientAwareInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var boolean
     */
    protected $async;

    /**
     * @var RequestConfiguratorInterface $configurator
     */
    protected $configurator;

    /**
     * @param bool $async
     */
    public function __construct($async = false)
    {
        $this->async = $async;
    }

    /**
     * @param ClientInterface $client
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param RequestConfiguratorInterface $configurator
     */
    public function setConfigurator(RequestConfiguratorInterface $configurator)
    {
        $this->configurator = $configurator;
    }

    /**
     * @param RequestInterface $request
     * @return PromiseInterface|ResponseInterface
     */
    protected function send(RequestInterface $request)
    {
        return $this->async ? $this->client->sendAsync($request)
                            : $this->client->send($request);
    }

}
