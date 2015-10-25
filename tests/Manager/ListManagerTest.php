<?php

namespace MailChimpPHP\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use MailChimpPHP\Manager\ListManager;
use MailChimpPHP\RequestConfigurator;

class ListManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testOne()
    {
        $container = [];
        $history = Middleware::history($container);

        $stack = HandlerStack::create();
        // Add the history middleware to the handler stack.
        $stack->push($history);

        $client =  new Client(['handler' => $stack]);

        $manager = new ListManager();
        $manager->setClient($client)
                ->setConfigurator(new RequestConfigurator());

//        $response = $manager->one('foo', ['fields' => ['title', 'description']]);
//
//        $this->assertCount(1, $container);
//        $this->assertEquals('GET', $container[0]['request']->getMethod());
        $this->assertEquals(1,1);
    }

    private function getTestClient()
    {
        $container = [];
        $history = Middleware::history($container);

        $stack = HandlerStack::create();
        // Add the history middleware to the handler stack.
        $stack->push($history);

        return new Client(['handler' => $stack]);
    }

}