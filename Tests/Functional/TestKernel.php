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

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Linkin\Component\DoctrineNamingStrategy\ORM\Mapping\CamelCaseNamingStrategy;
use Psr\Log\NullLogger;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

/**
 * @author Viktor Linkin <adrenalinkin@gmail.com>
 */
class TestKernel extends Kernel
{
    /**
     * @var string
     */
    private $varDir;

    /**
     * @var bool|null
     */
    private $legacyMode;

    public function __construct(string $varDir, string $environment, bool $debug, ?bool $legacyMode)
    {
        $this->varDir = $varDir;
        $this->legacyMode = $legacyMode;

        parent::__construct($environment, $debug);
    }

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new DoctrineBundle(),
        ];
    }

    public function getProjectDir(): string
    {
        return parent::getProjectDir().'/Tests/Functional';
    }

    public function getRootDir(): string
    {
        return $this->getProjectDir();
    }

    public function getCacheDir(): string
    {
        return $this->varDir.'/cache/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return $this->varDir.'/logs/';
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->register('logger', NullLogger::class);
            $definition = $container->register(CamelCaseNamingStrategy::class, CamelCaseNamingStrategy::class);

            if (null !== $this->legacyMode) {
                $definition->addArgument($this->legacyMode);
            }

            $container->loadFromExtension('framework', [
                'secret' => 'test',
                'test' => null,
            ]);

            $container->loadFromExtension('doctrine', [
                'dbal' => [
                    'driver' => 'pdo_sqlite',
                    'charset' => 'UTF8',
                    'memory' => true,
                ],
                'orm' => [
                    'naming_strategy' => CamelCaseNamingStrategy::class,
                    'mappings' => [
                        'TestEntity' => [
                            'type' => 'annotation',
                            'is_bundle' => false,
                            'dir' => __DIR__.'/Entity',
                            'prefix' => 'Linkin\Component\DoctrineNamingStrategy\Tests\Functional\Entity',
                        ],
                    ],
                ],
            ]);

            $container->addObjectResource($this);
        });
    }
}
