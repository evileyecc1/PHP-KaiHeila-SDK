<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 11:21
 */

namespace KaiHeiLaSDK\Traits;


trait ValidatesContainers
{
    /**
     * Determine is a Container should be considered valid by
     * check if there are any null values in the data property.
     *
     * @return bool
     */
    public function valid(): bool
    {

        return ! in_array(null, $this->data, true);
    }
}
