Doctrine Naming Strategy [![На Русском](https://img.shields.io/badge/Перейти_на-Русский-green.svg?style=flat-square)](./README.RU.md)
======================

Introduction
------------

Component contains Doctrine `CamelCase` naming strategy.

Installation
------------

Open a command console, enter your project directory and execute the following command to download the latest stable
version of this component:
```bash
    composer require adrenalinkin/doctrine-naming-strategy
```
*This command requires you to have [Composer](https://getcomposer.org) install globally.*

Usage
-----

For registration new naming strategy you should use manual from the official Doctrine documentation
[Implementing a NamingStrategy](https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/namingstrategy.html).

```php
<?php

$namingStrategy = new \Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy();
/** @var \Doctrine\ORM\Configuration $configuration */
$configuration->setNamingStrategy($namingStrategy);
```

In that case, when you use Doctrine as part of the Symfony Framework - you should look into appropriated part of the
`DoctrineBundle` documentation: 
[Configuration Reference](https://symfony.com/doc/master/bundles/DoctrineBundle/configuration.html).

```yaml
doctrine:
    orm:
        naming_strategy: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy
```
*Register `CamelCaseNamingStrategy` in the service container*

License
-------

[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](./LICENSE)
