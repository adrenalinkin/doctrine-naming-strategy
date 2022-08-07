<?php

declare(strict_types=1);

/*
 * This file is part of the DoctrineNamingStrategy component package.
 *
 * (c) Viktor Linkin <adrenalinkin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Linkin\Component\DoctrineNamingStrategy\Tests\Functional;

use Doctrine\ORM\Tools\SchemaTool;

/**
 * @author Viktor Linkin <adrenalinkin@gmail.com>
 */
class CamelCaseNamingStrategyFunctionalTest extends DoctrineNamingStrategyWebTestCase
{
    public function testApplyCamelCase(): void
    {
        $expected = [
            'CREATE TABLE User (id VARCHAR(255) NOT NULL, firstCommentId VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))',
            'CREATE INDEX IDX_2DA179777EB9366D ON User (firstCommentId)',
            'CREATE TABLE userFavoriteComments (UserId VARCHAR(255) NOT NULL, CommentId VARCHAR(255) NOT NULL,'.
                ' PRIMARY KEY(UserId, CommentId))',
            'CREATE INDEX IDX_F7CC4B71631A48FA ON userFavoriteComments (UserId)',
            'CREATE INDEX IDX_F7CC4B71E4614156 ON userFavoriteComments (CommentId)',
            'CREATE TABLE userReadComments (UserId VARCHAR(255) NOT NULL, CommentId VARCHAR(255) NOT NULL,'.
                ' PRIMARY KEY(UserId, CommentId))',
            'CREATE INDEX IDX_81D0D71E631A48FA ON userReadComments (UserId)',
            'CREATE INDEX IDX_81D0D71EE4614156 ON userReadComments (CommentId)',
            'CREATE TABLE Comment (id VARCHAR(255) NOT NULL, authorId VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))',
            'CREATE INDEX IDX_5BC96BF0A196F9FD ON Comment (authorId)',
        ];

        self::createClient();
        $entityManager = self::getTestContainer()->get('doctrine')->getManager();
        $schemaTool = new SchemaTool($entityManager);
        $allMetadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $sqlList = $schemaTool->getUpdateSchemaSql($allMetadata);

        foreach ($sqlList as $sql) {
            self::assertSame(array_shift($expected), $sql);
        }
    }
}
