Doctrine Naming Strategy [![На Русском](https://img.shields.io/badge/Перейти_на-Русский-green.svg?style=flat-square)](./README.RU.md)
======================

[![PHPUnit](https://github.com/adrenalinkin/doctrine-naming-strategy/workflows/UnitTests/badge.svg)](https://github.com/adrenalinkin/doctrine-naming-strategy/actions/workflows/unit-tests.yml)
[![Coverage Status](https://coveralls.io/repos/github/adrenalinkin/doctrine-naming-strategy/badge.svg?branch=master)](https://coveralls.io/github/adrenalinkin/doctrine-naming-strategy?branch=master)
[![Latest Stable Version](https://poser.pugx.org/adrenalinkin/doctrine-naming-strategy/v/stable)](https://packagist.org/packages/adrenalinkin/doctrine-naming-strategy)
[![Total Downloads](https://poser.pugx.org/adrenalinkin/doctrine-naming-strategy/downloads)](https://packagist.org/packages/adrenalinkin/doctrine-naming-strategy)

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
<?php declare(strict_types=1);
$namingStrategy = new \Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy();
/** @var \Doctrine\ORM\Configuration $configuration */
$configuration->setNamingStrategy($namingStrategy);
```

In that case, when you use Doctrine as part of the Symfony Framework - you should look into appropriated part of the
`DoctrineBundle` documentation:
[Configuration Reference](https://symfony.com/doc/master/bundles/DoctrineBundle/configuration.html).

```yaml
# Register CamelCaseNamingStrategy as service
services:
    Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy:
        class: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy

doctrine:
    orm:
        naming_strategy: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy
```

#### How to disable legacy mode?
```yaml
services:
    Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy:
        class: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy
        arguments:
            - false # disable Legacy Mode
```

How will the generated SQL change?
----------------------------------

To demonstrate difference let's take
[association example entities](https://www.doctrine-project.org/projects/doctrine-orm/en/2.12/reference/working-with-associations.html#association-example-entities)
from the official Doctrine documentation

### How work by default
![Compare](https://user-images.githubusercontent.com/4967813/183507072-c05d17ae-4742-4602-958d-fc8676b6e9d6.png)

### Compare SQL for different strategies
- [DefaultNamingStrategy](./Tests/Functional/Sql/defaultNamingStrategyWithFk.sql)
- [CamelCaseNamingStrategy](./Tests/Functional/Sql/camelCaseNamingStrategyLegacyWithFk.sql)
- [CamelCaseNamingStrategy - Legacy](./Tests/Functional/Sql/camelCaseNamingStrategyLegacyWithFk.sql)

License
-------

[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](./LICENSE)
