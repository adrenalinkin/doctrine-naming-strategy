Doctrine Naming Strategy [![In English](https://img.shields.io/badge/Switch_To-English-green.svg?style=flat-square)](./README.md)
========================

[![PHPUnit](https://github.com/adrenalinkin/doctrine-naming-strategy/workflows/UnitTests/badge.svg)](https://github.com/adrenalinkin/doctrine-naming-strategy/actions/workflows/unit-tests.yml)
[![Coverage Status](https://coveralls.io/repos/github/adrenalinkin/doctrine-naming-strategy/badge.svg?branch=master)](https://coveralls.io/github/adrenalinkin/doctrine-naming-strategy?branch=master)
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
<?php declare(strict_types=1);
$namingStrategy = new \Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy();
/** @var \Doctrine\ORM\Configuration $configuration */
$configuration->setNamingStrategy($namingStrategy);
```

Если вы используете `Symfony`, то воспользуйтесь соответствующим разделом документации `DoctrineBundle` -
[Configuration Reference](https://symfony.com/doc/master/bundles/DoctrineBundle/configuration.html).

```yaml
# Регистрируем CamelCaseNamingStrategy как сервис
services:
    Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy:
        class: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy

doctrine:
    orm:
        naming_strategy: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy
```

#### Как активировать обновленную стратегию?
```yaml
services:
    Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy:
        class: Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy
        arguments:
            - false # Отключаем Legacy Mode
```

Как будет выглядеть SQL?
------------------------

Для демонстрации изменений возьмем
[пример ассоциаций сущностей](https://www.doctrine-project.org/projects/doctrine-orm/en/2.12/reference/working-with-associations.html#association-example-entities)
из официальной документации Doctrine

### Сравнение SQL для разных стратегий
<details><summary>ПО УМОЛЧАНИЮ: Устаревший CamelCaseNamingStrategy к DefaultNamingStrategy </summary>
<p>

![Compare](https://user-images.githubusercontent.com/4967813/184545111-dbdf179a-828d-4427-91c6-277593ed070f.png)

</p>
</details>

<details><summary>Устаревший CamelCaseNamingStrategy к новому CamelCaseNamingStrategy </summary>
<p>

![Compare](https://user-images.githubusercontent.com/4967813/184545155-a523dfb7-ac8b-45d2-9514-28cebf79a203.png)

</p>
</details>

<details><summary>DefaultNamingStrategy к новому CamelCaseNamingStrategy </summary>
<p>

![Compare](https://user-images.githubusercontent.com/4967813/184545148-8f07cb13-5a84-4470-a84f-6bb70626fee1.png)

</p>
</details>

#### Сарой SQL для всех стратегий
- [DefaultNamingStrategy](./Tests/Functional/Sql/defaultNamingStrategyWithFk.sql)
- [CamelCaseNamingStrategy](./Tests/Functional/Sql/camelCaseNamingStrategyLegacyWithFk.sql)
- [CamelCaseNamingStrategy - Legacy](./Tests/Functional/Sql/camelCaseNamingStrategyLegacyWithFk.sql)

Лицензия
--------

[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](./LICENSE)
