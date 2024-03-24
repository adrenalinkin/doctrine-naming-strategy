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

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

/**
 * @author Viktor Linkin <adrenalinkin@gmail.com>
 */
class CamelCaseNamingStrategyFunctionalTest extends DoctrineNamingStrategyWebTestCase
{
    public function testApplyCamelCase(): void
    {
        self::createClient();
        $entityManager = self::getTestContainer()->get('doctrine')->getManager();
        self::assertInstanceOf(EntityManagerInterface::class, $entityManager);

        $expectedSql = $this->convertSqlToArray(file_get_contents(__DIR__.'/Sql/camelCaseNamingStrategyWithFk.sql'));

        $schemaTool = new SchemaTool($entityManager);
        $allMetadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $sqlList = $schemaTool->getUpdateSchemaSql($allMetadata);

        foreach ($sqlList as $sql) {
            self::assertSame(array_shift($expectedSql), $sql);
        }
    }

    private function convertSqlToArray(string $sql): array
    {
        $sql = preg_replace('/\n/', '', $sql);
        $sql = preg_replace('/\s+/', ' ', $sql);
        $sql = preg_replace('/ \( /', ' (', $sql);
        $sql = preg_replace('/ \);/', ');', $sql);

        return explode(';', $sql);
    }
}
