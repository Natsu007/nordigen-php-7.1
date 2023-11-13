<?php

namespace Nordigen\NordigenPHP\Http;

use GuzzleHttp\Exception\BadResponseException;
use Nordigen\NordigenPHP\Exceptions\ExceptionHandler;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\ClientInterface;

trait RequestHandlerTrait
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;
    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @param string $uri
     * @param mixed[] $options
     */
    public function get($uri, $options = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->get($uri, $options);
            return $response;
        } catch (BadResponseException $exc) {
            ExceptionHandler::handleException($exc->getResponse());
        }
    }

    /**
     * @param string $uri
     * @param mixed[] $options
     */
    public function post($uri, $options = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->post($uri, $options);
            return $response;
        } catch (BadResponseException $exc) {
            ExceptionHandler::handleException($exc->getResponse());
        }
    }

    /**
     * @param string $uri
     * @param mixed[] $options
     */
    public function put($uri, $options = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->put($uri, $options);
            return $response;
        } catch (BadResponseException $exc) {
            ExceptionHandler::handleException($exc->getResponse());
        }
    }

    /**
     * @param string $uri
     * @param mixed[] $options
     */
    public function delete($uri, $options = []): ResponseInterface
    {
        try {
            $response = $this->httpClient->delete($uri, $options);
            return $response;
        } catch (BadResponseException $exc) {
            ExceptionHandler::handleException($exc->getResponse());
        }
    }
}
