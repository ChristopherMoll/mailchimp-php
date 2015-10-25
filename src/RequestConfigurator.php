<?php

namespace MailChimpPHP;

use Psr\Http\Message\RequestInterface;

class RequestConfigurator implements RequestConfiguratorInterface
{
    /**
     * @var bool $cleanQueryString
     */
    protected $cleanQueryString;

    /**
     * @param RequestInterface $request
     * @param array $options
     * @return RequestInterface
     */
    public function configure(RequestInterface $request, array $options)
    {
        $this->cleanQueryString = true;
        $changes['query'] = '';

        if (array_key_exists('fields', $options) && array_key_exists('excludeFields', $options)) {
            throw new \InvalidArgumentException('$options may not contain both fields and excludeFields');
        }

        if (array_key_exists('limit', $options)) {
            $changes['query'] .= $this->getQueryStringSeparator().'count='.$options['limit'];
        }
        if (array_key_exists('offset', $options)) {
            $changes['query'] .= $this->getQueryStringSeparator().'offset='.$options['offset'];
        }
        if (array_key_exists('fields', $options)) {
            $changes['query'] .= $this->getQueryStringSeparator().'fields='.implode(',', $options['fields']);
        }
        if (array_key_exists('excludeFields', $options)) {
            $changes['query'] .= $this->getQueryStringSeparator().'exclude_fields='.implode(',', $options['excludeFields']);
        }
        if (array_key_exists('filters', $options) && is_array($options['filters'])) {
            foreach ($options['filters'] as $field => $value) {
                $changes['query'] .= $this->getQueryStringSeparator()."$field=$value";
            }
        }

        return \GuzzleHttp\Psr7\modify_request($request, $changes);
    }

    /**
     * @return string
     */
    protected function getQueryStringSeparator()
    {
        if ($this->cleanQueryString) {
            $this->cleanQueryString = false;
            return '?';
        }
        else {
            return '&';
        }
    }
}