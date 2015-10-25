<?php

namespace MailChimpPHP\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use MailChimpPHP\MailChimp;
use MailChimpPHP\RequestConfigurator;

class MailChimpTest extends \PHPUnit_Framework_TestCase
{
    public function testLists()
    {
        $mailchimp = new MailChimp('fakeAPIkey', 'dc1');
        $mock = new MockHandler([
                new Response(200, ['X-Foo' => 'Bar']),
            ]);

        $handler = HandlerStack::create($mock);
        $listManager = $mailchimp->lists($handler);
        
        $this->assertEquals(200, $listManager->one('listId')->getStatusCode());
        $this->assertEquals('dc1.api.mailchimp.com/3.0/lists', $listManager->one('listId')->get());
    }
}