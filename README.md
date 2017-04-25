# Symfony Command Bus Bundle
This bundle will help you to use `Command Query Responsibility Segregation`

Please see [CQRS][cqrs-link]

[![SensioLabsInsight][sensiolabs-insight-image]][sensiolabs-insight-link]

[![License][license-image]][license-link]


Installation
------------
* Require the bundle with composer:

``` bash
composer require symfony-notes/command-bus-bundle
```

* Enable the bundle in the kernel:

``` php
public function registerBundles()
{
    $bundles = [
        // ...
        new SymfonyNotes\CommandBusBundle\SymfonyNotesCommandBusBundle(),
        // ...
    ];
    ...
}
```

How to use?
-----------
* Command class
``` php
class YourCommand implements CommandInterface
{
    public $id;
}
```

* Command Handler class
``` php
class CreateFaceHandler implements CommandHandlerInterface
{
    public function handle(CommandInterface $command)
    {
        ...
    }
}
```

* Call `command bus`
``` php
$this->get('notes.command_bus')->handle($command);
```

[cqrs-link]: https://martinfowler.com/bliki/CQRS.html
[sensiolabs-insight-link]: https://insight.sensiolabs.com/projects/9a7946b5-3eec-4b5f-8382-7cb098ada63a
[sensiolabs-insight-image]: https://insight.sensiolabs.com/projects/9a7946b5-3eec-4b5f-8382-7cb098ada63a/big.png
[license-image]: https://img.shields.io/dub/l/vibe-d.svg
[license-link]: https://github.com/symfony-notes/command-bus-bundle/blob/master/LICENSE
