<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/22 0022
 * Time: 14:57
 */

namespace KaiHeiLaSDK\Containers;


use ArrayObject;

class KHLResponse extends \ArrayObject
{
    /**
     * @var string
     */
    public $raw;

    /**
     * @var array
     */
    public $headers;

    /**
     * @var array
     */
    public $raw_headers;

    /**
     * @var int
     */
    public $rate_limit;

    /**
     * @var int
     */
    public $pages;

    /**
     * @var string
     */
    protected $response_code;

    /**
     * @var mixed
     */
    protected $error_message;

    /**
     * @var mixed
     */
    protected $optional_return;

    public function __construct(
        string $data, array $headers, int $response_code)
    {

        // set the raw data to the raw property
        $this->raw = $data;

        // Normalize and parse the response headers
        $this->parseHeaders($headers);

        // decode and create an object from the data
        $data = json_decode($data);

        $this->response_code = $response_code;

        if (is_object($data)) {

            // If there is an error, set that.
            if ($data->code != 0)
                $this->error_message = $data->message;
        }

        if(property_exists($data,'meta')){
            $this->pages = $data->meta->page_total;
        }

        // Run the parent constructor
        parent::__construct(is_array($data) ? (array) $data['data'] : (object) $data->data, ArrayObject::ARRAY_AS_PROPS);
    }

    private function parseHeaders(array $headers)
    {

        // Set the raw headers as we got from the constructor.
        $this->raw_headers = $headers;

        // flatten the headers array so that values are not arrays themselves
        // but rather simple key value pairs.
        $headers = array_map(function ($value) {

            if (! is_array($value))
                return $value;

            return implode(';', $value);
        }, $headers);

        // Set the parsed headers.
        $this->headers = $headers;

        // Check for some header values that might be interesting
        // such as the current error limit and number of pages
        // available.
        $this->hasHeader('X-Rate-Limit-Remaining') ?
            $this->rate_limit = (int) $this->getHeader('X-Rate-Limit-Remaining') : null;

    }

    public function optional(string $index)
    {

        if (! $this->offsetExists($index))
            return null;

        return $this->$index;
    }

    public function error()
    {

        return $this->error_message;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {

        return $this->response_code;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader(string $name)
    {
        // turn headers into case insensitive array
        $key_map = array_change_key_case($this->headers, CASE_LOWER);

        // track for the requested header name
        return array_key_exists(strtolower($name), $key_map);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getHeader(string $name)
    {
        // turn header name into case insensitive
        $insensitive_key = strtolower($name);

        // turn headers into case insensitive array
        $key_map = array_change_key_case($this->headers, CASE_LOWER);

        // track for the requested header name and return its value if exists
        if (array_key_exists($insensitive_key, $key_map))
            return $key_map[$insensitive_key];

        return null;
    }
}
