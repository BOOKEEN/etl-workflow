<?php

namespace Bookeen\ETLWorkflow\Transformer;

use Bookeen\ETLWorkflow\Context\ContextInterface;

interface TransformerInterface
{
    /**
     * @param $data
     * @param ContextInterface $context
     * @return mixed
     */
    function transform($data, ContextInterface $context);
}