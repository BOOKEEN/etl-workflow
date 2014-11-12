<?php

namespace Bookeen\ETLWorkflow\Extractor;

use Bookeen\ETLWorkflow\Context\ContextInterface;

interface ExtractorInterface
{
    /**
     * @param ContextInterface $context
     * @return mixed
     */
    function extract(ContextInterface $context);
}

