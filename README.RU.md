Doctrine Naming Strategy [![In English](https://img.shields.io/badge/Switch_To-English-green.svg?style=flat-square)](./README.md)
========================

[![Latest Stable Version](https://poser.pugx.org/adrenalinkin/doctrine-naming-strategy/v/stable)](https://packagist.org/packages/adrenalinkin/doctrine-naming-strategy)
[![Total Downloads](https://poser.pugx.org/adrenalinkin/doctrine-naming-strategy/downloads)](https://packagist.org/packages/adrenalinkin/doctrine-naming-strategy)

Введение
--------

Компонент содержит стратегию именования столбцов, индексов и таблиц в формате `CamelCase`.

Установка
---------

Откройте консоль и, перейдя в директорию проекта, выполните следующую команду для загрузки наиболее подходящей
стабильной версии этого компонента:
```bash
    composer require adrenalinkin/doctrine-naming-strategy
```
*Эта команда подразумевает что [Composer](https://getcomposer.org) установлен и доступен глобально.*

Пример использования
--------------------

Для регистрации новой стратегии необходимо воспользоваться инструкцией, описанной в официальной
документации Doctrine [Implementing a NamingStrategy](https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/namingstrategy.html).

```php
<?php

$namingStrategy = new \Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy();
/** @var \Doctrine\ORM\Configuration $configuration */
$configuration->setNamingStrategy($namingStrategy);
```

Если вы используете `Symfony`, то воспользуйтесь соответствующим разделом документации `DoctrineBundle` -
[Configuration Reference](https://symfony.com/doc/master/bundles/DoctrineBundle/configuration.html).

```yaml
doctrine:
    orm:
        naming_strategy: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy
```
*Предварительно зарегистрируйте `CamelCaseNamingStrategy` в контейнере сервисов*

Лицензия
--------

[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](./LICENSE)
