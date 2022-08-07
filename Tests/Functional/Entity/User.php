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
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE).
     *
     * @ORM\ManyToMany(targetEntity="Comment", inversedBy="userFavorites")
     * @ORM\JoinTable(name="userFavoriteComments")
     */
    private $favorites;

    /**
     * Unidirectional - Many users have marked many comments as read.
     *
     * @ORM\ManyToMany(targetEntity="Comment")
     * @ORM\JoinTable(name="userReadComments")
     */
    private $commentsRead;

    /**
     * Bidirectional - One-To-Many (INVERSE SIDE).
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author")
     */
    private $commentsAuthored;

    /**
     * Unidirectional - Many-To-One.
     *
     * @ORM\ManyToOne(targetEntity="Comment")
     */
    private $firstComment;
}
