<?php

namespace Core\Interfaces;


interface ResponseInterface
{
    /**
     * @param int $status
     * @return ResponseInterface
     */
    public function setStatusCode(int $status): self;

    /**
     * @param mixed $data
     * @return ResponseInterface
     */
    public function setContent($data): self;

    /**
     * @param string $name
     * @param string $value
     * @return ResponseInterface
     */
    public function setHeader(string $name, string $value): self;


    /**
     * @param string $path
     * @param int $statusCode
     * @return bool
     */
    public function redirect(string $path, int $statusCode = 302): bool;


    /**
     * @return bool
     * @throws \Exception
     */
    public function send(): bool;
}