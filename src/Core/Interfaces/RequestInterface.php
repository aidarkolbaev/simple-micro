<?php

namespace Core\Interfaces;


interface RequestInterface
{
    /** @return string */
    public function getRequestURI(): string;

    /**
     * @param string|null $name
     * @param null $defaultValue
     * @return mixed
     */
    public function getParam(string $name = null, $defaultValue = null);


    /**
     * @param string|null $name
     * @param null $defaultValue
     * @return mixed
     */
    public function getQuery(string $name = null, $defaultValue = null);

    /**
     * @param string|null $name
     * @param null $defaultValue
     * @return mixed
     */
    public function getPost(string $name = null, $defaultValue = null);

    /** @return string */
    public function getMethod(): string;

    /** @return string */
    public function getUserAgent(): string;

    /**
     * @param string $header
     * @return string
     */
    public function getHeader(string $header): string;

    /** @return array */
    public function getJsonBody(): array;
}