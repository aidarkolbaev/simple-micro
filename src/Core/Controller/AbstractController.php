<?php

namespace Core\Controller;


use Core\Request\RequestInterface;

abstract class AbstractController
{
    /** @var RequestInterface */
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param array $data
     * @param int $status
     * @return bool
     */
    protected function jsonResponse(array $data, int $status = 200): bool
    {
        header('Content-Type: application/json');
        http_response_code($status);
        $response = json_encode($data, 1);
        if ($response) {
            echo $response;
            return true;
        }
        return false;
    }
}