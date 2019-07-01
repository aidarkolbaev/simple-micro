<?php

namespace Core;


use Core\Interfaces\RequestInterface;

abstract class AbstractController
{
    /** @var RequestInterface */
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }
}