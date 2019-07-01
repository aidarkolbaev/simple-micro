<?php

namespace Core;


use Core\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface
{

    /** @var array */
    private $data;

    /** @var int */
    private $statusCode = 200;

    /** @var array */
    private $headers = [
        'Content-Type' => 'application/json'
    ];

    /**
     * @param array|null $data
     * @param int $status
     */
    public function __construct($data = [], int $status = 200)
    {
        $this->data = $data;
        if ($status > 100 && $status < 600) {
            $this->statusCode = $status;
        }
    }

    /**
     * @param int $status
     * @return ResponseInterface
     */
    public function setStatusCode(int $status): ResponseInterface
    {
        $this->statusCode = $status;
    }

    /**
     * @param mixed $data
     * @return ResponseInterface
     */
    public function setContent($data): ResponseInterface
    {
        $this->data = $data;
    }

    /**
     * @param string $name
     * @param string $value
     * @return ResponseInterface
     */
    public function setHeader(string $name, string $value): ResponseInterface
    {
        $this->headers[$name] = $value;
    }

    /**
     * @param string $path
     * @param int $statusCode
     * @return bool
     */
    public function redirect(string $path, int $statusCode = 302): bool
    {
        header('Location:   ' . $path, true, $statusCode);
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function send(): bool
    {
        foreach ($this->headers as $header => $value) {
            header($header . ': ' . $value);
        }
        http_response_code($this->statusCode);
        $response = json_encode($this->data);
        if ($response == false) {
            throw new \Exception('Json encoding error');
        }
        echo $response;
        return true;
    }
}