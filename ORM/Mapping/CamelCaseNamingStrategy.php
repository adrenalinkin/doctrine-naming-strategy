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

namespace Linkin\Component\DoctrineNamingStrategy\ORM\Mapping;

use Doctrine\ORM\Mapping\DefaultNamingStrategy;

/**
 * @author Viktor Linkin <adrenalinkin@gmail.com>
 */
class CamelCaseNamingStrategy extends DefaultNamingStrategy
{
    /**
     * {@inheritdoc}
     */
    public function embeddedFieldToColumnName(
        $propertyName,
        $embeddedColumnName,
        $className = null,
        $embeddedClassName = null
    ): string {
        return $propertyName.ucfirst($embeddedColumnName);
    }

    /**
     * {@inheritdoc}
     */
    public function joinColumnName($propertyName, $className = null): string
    {
        return $propertyName.ucfirst($this->referenceColumnName());
    }

    /**
     * {@inheritdoc}
     */
    public function joinTableName($sourceEntity, $targetEntity, $propertyName = null): string
    {
        return $this->classToTableName($sourceEntity).ucfirst($this->classToTableName($targetEntity));
    }

    /**
     * {@inheritdoc}
     */
    public function joinKeyColumnName($entityName, $referencedColumnName = null): string
    {
        if (null === $referencedColumnName) {
            $referencedColumnName = $this->referenceColumnName();
        }

        return lcfirst($this->classToTableName($entityName).ucfirst($referencedColumnName));
    }
}
