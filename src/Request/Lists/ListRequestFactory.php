<?php

namespace MailChimpPHP\Request\Lists;

use GuzzleHttp\Psr7\Request;

class ListRequestFactory
{
    /**
     * @param string $listId
     * @return Request
     */
    static function getListDetailsRequest($listId)
    {
        return new Request('GET', "lists/$listId");
    }

    /**
     * @return Request
     */
    static function getListCollectionRequest()
    {
        return new Request('GET', 'lists');
    }

    /**
     * @param $list
     * @return Request
     */
    static function getCreateListRequest($list)
    {
        if (!is_array($list)) {
            $list = serialize($list);
        }

        return new Request('POST', 'lists', ['Content-Type' => 'application/json'], json_encode($list));
    }

    /**
     * @param string $listId
     * @param mixed $list
     * @return Request
     */
    static function getUpdateListRequest($listId, $list)
    {
        if (!is_array($list)) {
            $list = serialize($list);
        }

        return new Request('PATCH', "lists/$listId", ['Content-Type' => 'application/json'], json_encode($list));
    }

    /**
     * @param string $listId
     * @return Request
     */
    static function getDeleteListRequest($listId)
    {
        return new Request('DELETE', "lists/$listId");
    }
}