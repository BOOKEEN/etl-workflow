<?php

namespace Bookeen\ETLWorkflow\Workflow;

use Knp\ETL\ContextInterface;
use Knp\ETL\ExtractorInterface;
use Knp\ETL\LoaderInterface;
use Knp\ETL\TransformerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Bookeen\EtlWorkflow\Event\WorkflowEvent;

class Workflow
{
    private $extractor;
    private $transformer;
    private $loader;
    private $context;
    private $dispatcher;

    public function setDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return ContextInterface
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param ContextInterface $context
     */
    public function setContext(ContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * @return ExtractorInterface
     */
    public function getExtractor()
    {
        return $this->extractor;
    }

    /**
     * @param ExtractorInterface $extractor
     */
    public function setExtractor(ExtractorInterface $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * @return LoaderInterface
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * @param LoaderInterface $loader
     */
    public function setLoader(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @return TransformerInterface
     */
    public function getTransformer()
    {
        return $this->transformer;
    }

    /**
     * @param TransformerInterface $transformer
     */
    public function setTransformer(TransformerInterface $transformer)
    {
        $this->transformer = $transformer;
    }

    public function process()
    {
        if ($this->dispatcher !== null) {
            $this->dispatcher->dispatch(WorkflowEvent::WORKFLOW_START);
        }

        while (null !== $extracted = $this->extractor->extract($this->context)) {
            $transformed = $this->transformer->transform($extracted, $this->context);
            $this->loader->load($transformed, $this->context);

            if ($this->dispatcher !== null) {
                $this->dispatcher->dispatch(WorkflowEvent::WORKFLOW_ADVANCE);
            }
        }

        $this->loader->flush($this->context);

        if ($this->dispatcher !== null) {
            $this->dispatcher->dispatch(WorkflowEvent::WORKFLOW_FINISH);
        }
    }
} 