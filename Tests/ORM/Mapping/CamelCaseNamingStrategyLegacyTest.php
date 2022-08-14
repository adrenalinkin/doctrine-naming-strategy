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

namespace Linkin\Component\DoctrineNamingStrategy\Tests\ORM\Mapping;

use Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy;
use PHPUnit\Framework\TestCase;

/**
 * @author Viktor Linkin <adrenalinkin@gmail.com>
 */
class CamelCaseNamingStrategyLegacyTest extends TestCase
{
    /**
     * @var CamelCaseNamingStrategy
     */
    private $sut;

    protected function setUp(): void
    {
        $this->sut = new CamelCaseNamingStrategy(false);
    }

    public function testEmbeddedFieldToColumnName(): void
    {
        $result = $this->sut->embeddedFieldToColumnName('property', 'column');

        self::assertSame('propertyColumn', $result);
    }

    public function testJoinColumnName(): void
    {
        $result = $this->sut->joinColumnName('property');

        self::assertSame('propertyId', $result);
    }

    public function testJoinTableName(): void
    {
        $result = $this->sut->joinTableName('App\\First', 'App\\Second');

        self::assertSame('FirstSecond', $result);
    }

    public function testJoinKeyColumnName(): void
    {
        $result = $this->sut->joinKeyColumnName('App\\First');

        self::assertSame('firstId', $result);

        $result = $this->sut->joinKeyColumnName('App\\First', 'referenceId');

        self::assertSame('firstReferenceId', $result);
    }
}
