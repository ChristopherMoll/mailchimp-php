<?php

namespace MailChimpPHP\Manager;

use MailChimpPHP\Request\Lists\ListRequestFactory;

class ListManager extends BaseManager
{
    /**
     * @param array $options
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     */
    public function all(array $options)
    {
        $request = $this->configurator->configure(ListRequestFactory::getListCollectionRequest(), $options);

        return $this->send($request);
    }

    /**
     * @param mixed $list
     * @param array $options
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     */
    public function create($list, array $options)
    {
        $request =  $this->configurator->configure(ListRequestFactory::getCreateListRequest($list), $options);

        return $this->send($request);
    }

    /**
     * @param string $listId
     * @param array $options
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     */
    public function remove($listId, array $options)
    {
        $request =  $this->configurator->configure(ListRequestFactory::getDeleteListRequest($listId), $options);

        return $this->send($request);
    }

    /**
     * @param string $listId
     * @param array $options
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     */
    public function one($listId, array $options = null)
    {
        $request = ListRequestFactory::getListDetailsRequest($listId);
        if ($options) {
            $request =  $this->configurator->configure($request, $options);
        }

        return $this->send($request);
    }

    /**
     * @param string $listId
     * @param mixed $data
     * @param array $options
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     */
    public function update($listId, $data, array $options)
    {
        $request =  $this->configurator->configure(ListRequestFactory::getUpdateListRequest($listId, $data), $options);

        return $this->send($request);
    }
}
