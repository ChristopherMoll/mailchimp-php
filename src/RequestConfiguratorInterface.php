<?php

namespace MailChimpPHP;

use Psr\Http\Message\RequestInterface;

interface RequestConfiguratorInterface
{
    public function configure(RequestInterface $request, array $options);
}