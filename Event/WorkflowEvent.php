<?php

namespace Bookeen\ETLWorkflow\Event;

class WorkflowEvent
{
    const WORKFLOW_START    = 'workflow.start';
    const WORKFLOW_ADVANCE  = 'workflow.advance';
    const WORKFLOW_FINISH   = 'workflow.finish';
}