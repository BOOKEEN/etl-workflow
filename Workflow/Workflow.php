<?php

namespace Bookeen\ETLWorkflow\Workflow;

use Bookeen\ETLWorkflow\Context\ContextInterface;
use Bookeen\ETLWorkflow\Event\WorkflowEvent;
use Bookeen\ETLWorkflow\Extractor\ExtractorAbstract;
use Bookeen\ETLWorkflow\Loader\LoaderInterface;
use Bookeen\ETLWorkflow\Transformer\TransformerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class Workflow
{
    /** @var ExtractorAbstract */
    private $extractor;

    /** @var TransformerInterface */
    private $transformer;

    /** @var LoaderInterface */
    private $loader;

    /** @var  ContextInterface */
    private $context;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /**
     * @param EventDispatcherInterface $dispatcher
     */
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
     * @return ExtractorAbstract
     */
    public function getExtractor()
    {
        return $this->extractor;
    }

    /**
     * @param ExtractorAbstract $extractor
     */
    public function setExtractor(ExtractorAbstract $extractor)
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

    /**
     *
     */
    public function process()
    {
        if ($this->dispatcher !== null) {
            $this->dispatcher->dispatch(WorkflowEvent::WORKFLOW_START, new GenericEvent($this->context));
        }

        while (null !== $extracted = $this->extractor->extract($this->context)) {
            $transformed = $this->transformer->transform($extracted, $this->context);
            $this->loader->load($transformed, $this->context);

            if ($this->dispatcher !== null) {
                $this->dispatcher->dispatch(WorkflowEvent::WORKFLOW_ADVANCE, new GenericEvent($this->context));
            }
        }

        $this->loader->flush($this->context);
        $this->extractor->purge($this->context);

        if ($this->dispatcher !== null) {
            $this->dispatcher->dispatch(WorkflowEvent::WORKFLOW_FINISH, new GenericEvent($this->context));
        }
    }
}
