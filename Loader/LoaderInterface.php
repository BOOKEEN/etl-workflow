<?php

namespace Bookeen\ETLWorkflow\Loader;

use Bookeen\ETLWorkflow\Context\ContextInterface;

interface LoaderInterface
{
    /**
     * @param $data
     * @param ContextInterface $context
     * @return mixed
     */
    function load($data, ContextInterface $context);

    /**
     * @param ContextInterface $context
     * @return mixed
     */
    function flush(ContextInterface $context);

    /**
     * @param ContextInterface $context
     * @return mixed
     */
    function clear(ContextInterface $context);
}

