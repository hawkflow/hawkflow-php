![HawkFLow.ai](https://hawkflow.ai/static/images/emails/bars.png)

# HawkFlow.ai

## Monitoring for anyone that writes code

1. Install: `composer update`
2. Usage:
```php
<?php

require 'vendor/autoload.php';

use HawkFlow\HawkFlow\HawkFlow;

// Authenticate with your API key
$hawkFlow = new HawkFlow("YOUR_API_KEY");

// Start timing your code - pass through process (required) and meta (optional) parameters
echo "Sending timing start data to hawkflow\n";
$hawkFlow->start("your_process_name", "your_meta_data");

// Do some work
echo "Sleeping for 5 seconds...\n";
sleep(5);

// End timing this piece of code - process (required) and meta (optional) parameters should match the start
echo "Sending timing end data to hawkflow\n";
$hawkFlow->end("your_process_name", "your_meta_data");
```

More examples: [HawkFlow.ai PHP examples](https://github.com/hawkflow/hawkflow-examples/tree/master/php)

Read the docs: [HawkFlow.ai documentation](https://docs.hawkflow.ai/)

## What is HawkFlow.ai?

HawkFlow.ai is a new monitoring platform that makes it easier than ever to make monitoring part of your development
process. Whether you are an Engineer, a Data Scientist, an Analyst, or anyone else that writes code, HawkFlow.ai helps
you and your team take ownership of monitoring.

# Testing this package

1. Install dependencies: `composer update --dev`
2. Run tests: `./vendor/bin/phpunit --verbose tests` 
