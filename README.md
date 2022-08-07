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

How will the generated SQL change?
----------------------------------

To demonstrate difference let's take 
[association example entities](https://www.doctrine-project.org/projects/doctrine-orm/en/2.12/reference/working-with-associations.html#association-example-entities) 
from the official Doctrine documentation
#### DefaultNamingStrategy
```sql
    CREATE TABLE User (id VARCHAR(255) NOT NULL, firstComment_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id));
    CREATE INDEX IDX_2DA179776A54F90 ON User (firstComment_id);
    CREATE TABLE userFavoriteComments (user_id VARCHAR(255) NOT NULL, comment_id VARCHAR(255) NOT NULL, PRIMARY KEY(user_id, comment_id));
    CREATE INDEX IDX_F7CC4B71A76ED395 ON userFavoriteComments (user_id);
    CREATE INDEX IDX_F7CC4B71F8697D13 ON userFavoriteComments (comment_id);
    CREATE TABLE userReadComments (user_id VARCHAR(255) NOT NULL, comment_id VARCHAR(255) NOT NULL, PRIMARY KEY(user_id, comment_id));
    CREATE INDEX IDX_81D0D71EA76ED395 ON userReadComments (user_id);
    CREATE INDEX IDX_81D0D71EF8697D13 ON userReadComments (comment_id);
    CREATE TABLE Comment (id VARCHAR(255) NOT NULL, author_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id));
    CREATE INDEX IDX_5BC96BF0F675F31B ON Comment (author_id);
```

#### CamelCaseNamingStrategy 
```sql
    CREATE TABLE User (id VARCHAR(255) NOT NULL, firstCommentId VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id));
    CREATE INDEX IDX_2DA179777EB9366D ON User (firstCommentId);
    CREATE TABLE userFavoriteComments (UserId VARCHAR(255) NOT NULL, CommentId VARCHAR(255) NOT NULL, PRIMARY KEY(UserId, CommentId));
    CREATE INDEX IDX_F7CC4B71631A48FA ON userFavoriteComments (UserId);
    CREATE INDEX IDX_F7CC4B71E4614156 ON userFavoriteComments (CommentId);
    CREATE TABLE userReadComments (UserId VARCHAR(255) NOT NULL, CommentId VARCHAR(255) NOT NULL, PRIMARY KEY(UserId, CommentId));
    CREATE INDEX IDX_81D0D71E631A48FA ON userReadComments (UserId);
    CREATE INDEX IDX_81D0D71EE4614156 ON userReadComments (CommentId);
    CREATE TABLE Comment (id VARCHAR(255) NOT NULL, authorId VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id));
    CREATE INDEX IDX_5BC96BF0A196F9FD ON Comment (authorId);
```

License
-------

[![license](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](./LICENSE)
