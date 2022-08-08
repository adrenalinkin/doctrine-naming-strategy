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

Как будет выглядеть SQL?
------------------------

Для демонстрации изменений возьмем 
[пример ассоциаций сущностей](https://www.doctrine-project.org/projects/doctrine-orm/en/2.12/reference/working-with-associations.html#association-example-entities)
из официальной документации Doctrine

#### DefaultNamingStrategy
```sqlite
    CREATE TABLE User (
        id VARCHAR(255) NOT NULL,
        firstComment_id VARCHAR(255) DEFAULT NULL,
        PRIMARY KEY(id), 
        CONSTRAINT FK_2DA179776A54F90 
            FOREIGN KEY (firstComment_id) 
            REFERENCES Comment (id) 
            NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_2DA179776A54F90 ON User (firstComment_id);
    CREATE TABLE userFavoriteComments (
        user_id VARCHAR(255) NOT NULL, 
        comment_id VARCHAR(255) NOT NULL, 
        PRIMARY KEY(user_id, comment_id), 
            CONSTRAINT FK_F7CC4B71A76ED395 
            FOREIGN KEY (user_id) 
            REFERENCES User (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
        CONSTRAINT FK_F7CC4B71F8697D13 
            FOREIGN KEY (comment_id) 
            REFERENCES Comment (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_F7CC4B71A76ED395 ON userFavoriteComments (user_id);
    CREATE INDEX IDX_F7CC4B71F8697D13 ON userFavoriteComments (comment_id);
    CREATE TABLE userReadComments (
        user_id VARCHAR(255) NOT NULL, 
        comment_id VARCHAR(255) NOT NULL,
        PRIMARY KEY(user_id, comment_id), 
        CONSTRAINT FK_81D0D71EA76ED395 
            FOREIGN KEY (user_id) 
            REFERENCES User (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE,
        CONSTRAINT FK_81D0D71EF8697D13 
            FOREIGN KEY (comment_id) 
            REFERENCES Comment (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_81D0D71EA76ED395 ON userReadComments (user_id);
    CREATE INDEX IDX_81D0D71EF8697D13 ON userReadComments (comment_id);
    CREATE TABLE Comment (
        id VARCHAR(255) NOT NULL, 
        author_id VARCHAR(255) DEFAULT NULL, 
        PRIMARY KEY(id), 
        CONSTRAINT FK_5BC96BF0F675F31B 
            FOREIGN KEY (author_id) 
            REFERENCES User (id) 
            NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_5BC96BF0F675F31B ON Comment (author_id);
```

#### CamelCaseNamingStrategy
```sqlite
    CREATE TABLE User (
        id VARCHAR(255) NOT NULL, 
        firstCommentId VARCHAR(255) DEFAULT NULL, 
        PRIMARY KEY(id), 
        CONSTRAINT FK_2DA179777EB9366D 
            FOREIGN KEY (firstCommentId) 
            REFERENCES Comment (id) 
            NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_2DA179777EB9366D ON User (firstCommentId);
    CREATE TABLE userFavoriteComments (
        UserId VARCHAR(255) NOT NULL, 
        CommentId VARCHAR(255) NOT NULL, 
        PRIMARY KEY(UserId, CommentId), 
        CONSTRAINT FK_F7CC4B71631A48FA 
            FOREIGN KEY (UserId) 
            REFERENCES User (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, 
        CONSTRAINT FK_F7CC4B71E4614156 
            FOREIGN KEY (CommentId) 
            REFERENCES Comment (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_F7CC4B71631A48FA ON userFavoriteComments (UserId);
    CREATE INDEX IDX_F7CC4B71E4614156 ON userFavoriteComments (CommentId);
    CREATE TABLE userReadComments (
        UserId VARCHAR(255) NOT NULL, 
        CommentId VARCHAR(255) NOT NULL, 
        PRIMARY KEY(UserId, CommentId), 
        CONSTRAINT FK_81D0D71E631A48FA 
            FOREIGN KEY (UserId) 
            REFERENCES User (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE,
        CONSTRAINT FK_81D0D71EE4614156 
            FOREIGN KEY (CommentId) 
            REFERENCES Comment (id) 
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_81D0D71E631A48FA ON userReadComments (UserId);
    CREATE INDEX IDX_81D0D71EE4614156 ON userReadComments (CommentId);
    CREATE TABLE Comment (
        id VARCHAR(255) NOT NULL, 
        authorId VARCHAR(255) DEFAULT NULL, 
        PRIMARY KEY(id), 
        CONSTRAINT FK_5BC96BF0A196F9FD 
            FOREIGN KEY (authorId) 
            REFERENCES User (id) 
            NOT DEFERRABLE INITIALLY IMMEDIATE
    );
    CREATE INDEX IDX_5BC96BF0A196F9FD ON Comment (authorId);
```

Лицензия
--------

[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](./LICENSE)
