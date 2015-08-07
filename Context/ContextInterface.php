<?php

namespace Bookeen\ETLWorkflow\Context;

/**
 * The context is created to be some information that will be passed to each function within workflow::process
 * Interface ContextInterface
 * @package Bookeen\ETLWorkflow\Context
 */
interface ContextInterface
{
    /**
     * @param String $key
     * @return mixed
     */
    public function getData($key);

    /**
     * you should verify the key here to be sur that you only have what you accept.
     * @param string $key
     * @param $val
     * @return mixed
     */
    public function setData($key, $val);
}
