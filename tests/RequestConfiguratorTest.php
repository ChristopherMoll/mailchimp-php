<?php

namespace MailChimpPHP\Tests;

use GuzzleHttp\Psr7\Request;
use MailChimpPHP\RequestConfigurator;

class RequestConfiguratorTest extends \PHPUnit_Framework_TestCase
{
    public function testAddsIncludeFields()
    {
        $configurator = new RequestConfigurator();
        $request = new Request('GET', 'foo');
        $options = [
            'fields' => ['test1', 'test2']
        ];
        $configuredRequest = $configurator->configure($request, $options);
        
        $this->assertEquals('fields=test1,test2', $configuredRequest->getUri()->getQuery());
    }

    public function testAddsExcludeFields()
    {
        $configurator = new RequestConfigurator();
        $request = new Request('GET', 'foo');
        $options = [
            'excludeFields' => ['test1', 'test2']
        ];
        $configuredRequest = $configurator->configure($request, $options);

        $this->assertContains('exclude_fields=test1,test2', $configuredRequest->getUri()->getQuery());
    }

    public function testAddsFilters()
    {
        $configurator = new RequestConfigurator();
        $request = new Request('GET', 'foo');
        $options = [
            'filters' => ['test1' => 'foo', 'test2' => 'bar']
        ];
        $configuredRequest = $configurator->configure($request, $options);

        $this->assertContains('test1=foo&test2=bar', $configuredRequest->getUri()->getQuery());
    }

    public function testAddsLimit()
    {
        $configurator = new RequestConfigurator();
        $request = new Request('GET', 'foo');
        $options = [
            'limit' => 10
        ];
        $configuredRequest = $configurator->configure($request, $options);

        $this->assertContains('count=10', $configuredRequest->getUri()->getQuery());
    }

    public function testAddsOffset()
    {
        $configurator = new RequestConfigurator();
        $request = new Request('GET', 'foo');
        $options = [
            'offset' => 10
        ];
        $configuredRequest = $configurator->configure($request, $options);

        $this->assertContains('offset=10', $configuredRequest->getUri()->getQuery());
    }

    public function testMultipleQueries()
    {
        $configurator = new RequestConfigurator();
        $request = new Request('GET', 'foo');
        $options = [
            'limit' => 10,
            'offset' => 5
        ];
        $configuredRequest = $configurator->configure($request, $options);

        $this->assertContains('count=10&offset=5', $configuredRequest->getUri()->getQuery());
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $options may not contain both fields and excludeFields
     */
    public function testValidatesIncludeExcludeFields()
    {
        $configurator = new RequestConfigurator();
        $request = new Request('GET', 'foo');
        $options = [
            'fields' => ['test1', 'test2'],
            'excludeFields' => ['test3', 'test4']
        ];

        $configurator->configure($request, $options);
    }
}