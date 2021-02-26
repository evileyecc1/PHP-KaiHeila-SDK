<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 10:24
 */

namespace KaiHeiLaSDK\Traits;

use KaiHeiLaSDK\Exceptions\InvalidContainerDataException;

trait ConstructsContainers
{
    public function __construct(array $data = null)
    {

        if (! is_null($data)) {

            foreach ($data as $key => $value) {

                if (! array_key_exists($key, $this->data))
                    throw new InvalidContainerDataException(
                        'Key ' . $key . ' is not valid for this container'
                    );

                $this->$key = $value;
            }
        }
    }
}
