<?php

namespace MailChimpPHP\Tests;

use GuzzleHttp\Psr7\Request;
use MailChimpPHP\Request\Lists\ListRequestFactory;

class ListRequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testListDetailsRequest()
    {
        $request = ListRequestFactory::getListDetailsRequest('foo');

        $this->assertInstanceOf('GuzzleHttp\Psr7\Request', $request);
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('lists/foo', $request->getUri()->getPath());
    }

    public function testListCollectionRequest()
    {
        $request = ListRequestFactory::getListCollectionRequest();

        $this->assertInstanceOf('GuzzleHttp\Psr7\Request', $request);
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('lists', $request->getUri()->getPath());
    }

    public function testUpdateListRequest()
    {
        $testList = [
            'description' => 'test description',
            'title' => 'test title'
        ];
        $request = ListRequestFactory::getUpdateListRequest('foo', $testList);

        $this->assertInstanceOf('GuzzleHttp\Psr7\Request', $request);
        $this->assertEquals('PATCH', $request->getMethod());
        $this->assertEquals('lists/foo', $request->getUri()->getPath());
        $this->assertEquals(['application/json'], $request->getHeader('Content-Type'));
        $this->assertEquals(\GuzzleHttp\Psr7\stream_for(json_encode($testList))->getContents(), $request->getBody()->getContents());
    }

    public function testCreateListRequest()
    {
        $testList = [
            'description' => 'test description',
            'title' => 'test title'
        ];
        $request = ListRequestFactory::getCreateListRequest($testList);

        $this->assertInstanceOf('GuzzleHttp\Psr7\Request', $request);
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('lists', $request->getUri()->getPath());
        $this->assertEquals(['application/json'], $request->getHeader('Content-Type'));
        $this->assertEquals(\GuzzleHttp\Psr7\stream_for(json_encode($testList))->getContents(), $request->getBody()->getContents());
    }

    public function testDeleteListRequest()
    {
        $request = ListRequestFactory::getDeleteListRequest('foo');

        $this->assertInstanceOf('GuzzleHttp\Psr7\Request', $request);
        $this->assertEquals('DELETE', $request->getMethod());
        $this->assertEquals('lists/foo', $request->getUri()->getPath());
    }

}