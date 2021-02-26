<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 16:22
 */

namespace KaiHeiLaSDK\Fetchers;


use GuzzleHttp\Psr7\Response;
use KaiHeiLaSDK\Containers\KHLResponse;
use Psr\Http\Message\ResponseInterface;

interface FetcherInterface
{
    public function call(string $method, string $uri, array $body, array $headers = []) : KHLResponse;

    public function multiPartCall(string $uri, array $body, array $headers = []) : KHLResponse;
}
