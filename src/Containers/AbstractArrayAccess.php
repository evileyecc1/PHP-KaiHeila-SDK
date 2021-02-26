<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 10:41
 */

namespace KaiHeiLaSDK\Containers;


abstract class AbstractArrayAccess implements \ArrayAccess
{

    /**
     * @var
     */
    protected $data;

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {

        return array_key_exists($offset, $this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {

        return $this->data[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {

        $this->data[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {

        unset($this->data[$offset]);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {

        return $this[$key];
    }

    /**
     * @param $key
     * @param $val
     */
    public function __set($key, $val)
    {

        $this[$key] = $val;
    }
}
