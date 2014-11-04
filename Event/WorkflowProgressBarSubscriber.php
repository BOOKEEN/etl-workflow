<?php

namespace Bookeen\ETLWorkflow\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class WorkflowProgressBarSubscriber implements EventSubscriberInterface
{
    private $progressBar;

    public function __construct(OutputInterface &$output, $count = 0)
    {
        $this->progressBar = new ProgressBar($output, $count);
        $this->progressBar->setFormat('debug');
    }

    static public function getSubscribedEvents()
    {
        return array(
            WorkflowEvent::WORKFLOW_START => array('onStart', 1),
            WorkflowEvent::WORKFLOW_ADVANCE => array('onAdvance', 0),
            WorkflowEvent::WORKFLOW_FINISH => array('onFinish', 0)
        );
    }

    public function onStart(Event $event)
    {
        $this->progressBar->start();
    }

    public function onAdvance(Event $event)
    {
        $this->progressBar->advance();
    }

    public function onFinish(Event $event)
    {
        $this->progressBar->finish();
    }
}