<?php

namespace Bookeen\ETLWorkflow\Extractor;

use Bookeen\ETLWorkflow\Context\ContextInterface;

abstract class ExtractorAbstract
{
    protected $purge = false;

    /**
     * @param ContextInterface $context
     * @return mixed
     */
    abstract public function extract(ContextInterface $context);

    /**
     * @param ContextInterface $context
     * @return boolean
     */
    public function purge(ContextInterface $context)
    {
        if ($this->purge) {
            return $this->doPurge($context);
        }

        return true;
    }

    /**
     * @param ContextInterface $context
     * @return boolean
     */
    protected function doPurge(ContextInterface $context)
    {
        return true;
    }
}
