<?php

namespace Core\Request;


class Request implements RequestInterface
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PATCH = 'PATCH';
    const METHOD_HEAD = 'HEAD';

    /** @return string */
    public function getRequestURI(): string
    {
        return $_SERVER['PHP_SELF'];
    }

    /**
     * @param string|null $name
     * @param null $defaultValue
     * @return mixed
     */
    public function getParam(string $name = null, $defaultValue = null)
    {
        return !empty($_REQUEST[$name]) ? $_REQUEST[$name] : $defaultValue;
    }

    /**
     * @param string|null $name
     * @param null $defaultValue
     * @return mixed
     */
    public function getQuery(string $name = null, $defaultValue = null)
    {
        $queryParams = array_diff($_REQUEST, $_POST);
        if ($name == null) {
            return $queryParams;
        }
        return !empty($queryParams[$name]) ? $queryParams[$name] : $defaultValue;
    }

    /**
     * @param string|null $name
     * @param null $defaultValue
     * @return mixed
     */
    public function getPost(string $name = null, $defaultValue = null)
    {
        if ($name == null) {
            return $_POST;
        }
        return !empty($_POST[$name]) ? $_POST[$name] : $defaultValue;
    }

    /** @return string */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /** @return string */
    public function getUserAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * @param string $header
     * @return string
     */
    public function getHeader(string $header): string
    {
        $header = str_replace('-', '_', $header);
        $header = 'HTTP_' . strtoupper($header);
        return !empty($_SERVER[$header]) ? $_SERVER[$header] : '';
    }

    /** @return array */
    public function getJsonBody(): array
    {
        if ($this->getHeader('Content-Type') === 'application/json') {
            $rawJson = file_get_contents("php://input");
            return json_decode($rawJson, true);
        }
        return [];
    }
}