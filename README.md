bookeen-etl-workflow
================

This bundle provide a simple Extract-Transform-Load Workflow with ETL interfaces.

Install
-------
``` shell
composer require "bookeen/etl-workflow:1.2.1"
```

In your Smfony CLI
------------------
```php
$workflow = new Workflow();

$workflow->setExtractor(new YourExtractor());
$workflow->setTransformer(new YourTransformer());
$workflow->setLoader(new YourLoader());

$workflow->process();
```

You can add a ProgressBar for CLI
```php
$workflow = new Workflow();

// Dispatch ProgressBar helper for CLI
$dispatcher = $this->getContainer()->get('event_dispatcher');
$dispatcher->addSubscriber(new WorkflowProgressBarSubscriber($output));
$workflow->setDispatcher($dispatcher);

// ...

$workflow->process();
```
