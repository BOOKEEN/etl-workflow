bookeen-etl-workflow
================

This bundle provide a simple Extract-Transform-Load Workflow

The Extractor, Transformer and Loader classes need to implements the php-etl library: [docteurklein/php-etl](https://github.com/docteurklein/php-etl)

Install
-------
``` shell
composer require "bookeen/etl-workflow:1.0.0"
```

In your Smfony CLI
------------------
```php
$workflow = $this->getContainer()->get('workflow');

$workflow->setExtractor(new YourExtractor());
$workflow->setTransformer(new YourTransformer());
$workflow->setLoader(new YourLoader());

$workflow->process();
```

You can add a ProgressBar for CLI
```php
$workflow = $this->getContainer()->get('workflow');

// Dispatch ProgressBar helper for CLI
$dispatcher = $this->getContainer()->get('event_dispatcher');
$dispatcher->addSubscriber(new WorkflowProgressBarSubscriber($output));
$workflow->setDispatcher($dispatcher);

// ...

$workflow->process();
```