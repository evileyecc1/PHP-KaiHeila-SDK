<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 11:18
 */

namespace KaiHeiLaSDK\Fetchers;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use KaiHeiLaSDK\Configuration;
use KaiHeiLaSDK\Containers\KHLResponse;
use KaiHeiLaSDK\Exceptions\RequestFailedException;
use KaiHeiLaSDK\Log\LogInterface;

class GuzzleFetcher implements FetcherInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var LogInterface
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = Configuration::getInstance()->getLogger();
    }

    public function call(string $method, string $uri, array $body, array $headers = []): KHLResponse
    {
        return $this->httpRequest($method, $uri, $headers, $body);
    }

    public function getClient(): Client
    {

        if (!$this->client)
            $this->client = new Client([
                'timeout' => 30,
                'headers' => [
                    'User-Agent' => 'PHP-KHL-SDK v1.0 /' .
                        Configuration::getInstance()->http_user_agent,
                ],
                'base_uri' => 'https://www.kaiheila.cn/',
            ]);

        return $this->client;
    }

    public function httpRequest(
        string $method, string $uri, array $headers = [], array $body = []): KHLResponse
    {
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bot ' . Configuration::getInstance()->token,
        ]);
        if (count($body) > 0 && strtolower($method) === 'post')
            $body = json_encode($body);
        elseif (strtolower($method) === 'get')
            $body = http_build_query($body);
        else
            $body = null;

        try {
            if (strtolower($method) === 'post')
                $response = $this->getClient()->send(
                    new Request($method, $uri, $headers, $body));
            elseif (strtolower($method) === 'get')
                $response = $this->getClient()->send(
                    new Request($method, $uri . '?' . $body, $headers, null));

        } catch (ClientException | ServerException $e) {
            $this->logger->error('[http ' . $e->getResponse()->getStatusCode() . ', ' .
                strtolower($e->getResponse()->getReasonPhrase()) . '] '
            );
            $responseBody = $e->getResponse()->getBody()->getContents();
            $this->logger->debug('Request for ' . $method . ' -> ' . $uri . ' failed. Response body was: ' .
                $responseBody);
            throw new RequestFailedException($e, $e->getResponse());
        }

        return $this->makeKHLResponse($response->getBody()->getContents(), $response->getHeaders(), $response->getStatusCode());
    }

    public function fileRequest(
        string $method, string $uri, array $headers = [], array $multipart = []): KHLResponse
    {
        // Include some basic headers to those already passed in. Everything
        // is considered to be json.
        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'Authorization' => 'Bot ' . Configuration::getInstance()->token,
        ]);

        try {
            $response = $this->getClient()->post($uri, [
                'headers' => $headers,
                'multipart' => $multipart
            ]);

        } catch (ClientException | ServerException $e) {
            $this->logger->error('[http ' . $e->getResponse()->getStatusCode() . ', ' .
                strtolower($e->getResponse()->getReasonPhrase()) . '] '
            );
            $responseBody = $e->getResponse()->getBody()->getContents();
            $this->logger->debug('Request for ' . $method . ' -> ' . $uri . ' failed. Response body was: ' .
                $responseBody);
            throw new RequestFailedException($e, $e->getResponse());
        }
        // Return a container response that can be parsed.
        return $this->makeKHLResponse($response->getBody()->getContents(), $response->getHeaders(), $response->getStatusCode());
    }

    public function makeKHLResponse(
        string $body, array $headers, int $status_code): KHLResponse
    {

        return new KHLResponse($body, $headers, $status_code);
    }

    public function multiPartCall(string $uri, array $body, array $headers = []): KHLResponse
    {
        return $this->fileRequest('post', $uri, $headers, $body);
    }
}
