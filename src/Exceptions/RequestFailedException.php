<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/22 0022
 * Time: 9:49
 */

namespace KaiHeiLaSDK\Exceptions;


use Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class RequestFailedException extends \Exception
{
    /**
     * @var Response
     */
    private $response;

    private $original_exception;

    public function __construct(\Exception $exception,ResponseInterface $response)
    {
        $this->response = $response;
        if($this->getResponse()->getStatusCode() == 403){
            parent::__construct('Forbidden', $this->getResponse()->getStatusCode(), $exception->getPrevious());
        }
        parent::__construct($this->getError(), $this->getResponse()->getStatusCode(), $exception->getPrevious());
    }

    public function getError()
    {
        $body = json_decode($this->response->getBody()->getContents());
        return property_exists($body,'message') ? $body->message : 'Unknown error';
    }

    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return \Exception
     */
    public function getOriginalException(): Exception
    {

        return $this->original_exception;
    }
}
