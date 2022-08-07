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

namespace Linkin\Component\DoctrineNamingStrategy\Tests\Functional\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Viktor Linkin <adrenalinkin@gmail.com>
 *
 * @ORM\Entity()
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * Bidirectional - Many comments are favorited by many users (INVERSE SIDE).
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="favorites")
     */
    private $userFavorites;

    /**
     * Bidirectional - Many Comments are authored by one user (OWNING SIDE).
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="commentsAuthored")
     */
    private $author;
}
