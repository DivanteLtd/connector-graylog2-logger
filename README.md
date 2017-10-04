## Installation

### Add to composer.json
```
    "repositories": [
        {
            "type": "vcs",
            "url": "ssh://git@gitlab.divante.pl:60022/connector/divante-graylog2-logger.git"
        }
    ],
```

#### composer require

```
composer require divante/connector-graylog2-logger
```

### Usage

````
use Monolog\Logger;
use Divante\Connector\Graylog\Monolog\GelfHandler as DivanteGelfHandler;
use Gelf\Transport\UdpTransport;
use Monolog\Handler\StreamHandler;

$transport = new UdpTransport("graylog.divante.pl", 2514); 

$publisher = new Gelf\Publisher();
$publisher->addTransport($transport);

$fallbackLogger = new Logger('fallbackLogger');
$fallbackLogger->pushHandler(new StreamHandler('path/to/your.log', Logger::CRITICAL));

$handler = new DivanteGelfHandler($publisher);
$handler->addFallbackLogger($fileLogger);

$graylogLogger = new Logger('graylog2');
$graylogLogger->pushHandler($handler);

$graylogLogger->info('Hello world !');

````
