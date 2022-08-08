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

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Viktor Linkin <adrenalinkin@gmail.com>
 */
class DoctrineNamingStrategyWebTestCase extends WebTestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        (new Filesystem())->remove(self::varDir());
    }

    protected static function getTestContainer(): ContainerInterface
    {
        if (Kernel::VERSION_ID >= 60000) {
            return self::getContainer();
        }

        if (Kernel::VERSION_ID >= 40100) {
            return self::$container;
        }

        return self::$kernel->getContainer();
    }

    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        $class = static::getKernelClass();

        return new $class(self::varDir(), $options['environment'] ?? 'test', $options['debug'] ?? true);
    }

    private static function varDir(): string
    {
        return sys_get_temp_dir().'/'.str_replace('\\', '_', static::class);
    }
}
