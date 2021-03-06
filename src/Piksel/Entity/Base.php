<?php
/**
 * This file is part of the Piksel package.
 *
 * @copyright 2015 Alex Druhet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Piksel\Entity;

use Cocur\Slugify\Slugify;

/**
 * Base class to extend for a Piksel entity creation
 *
 * Base is a class containing a very basic object description.
 * It provide id, title and slug. Minimalistic but useful.
 *
 * @author Alex Druhet <alex@pixadelic.com>
 * @package Piksel\Entity
 */
class Base
{

    /** @var string A unique identifier */
    protected $id;

    /** @var string The entity human title */
    protected $title;

    /** @var string The entity slug */
    protected $slug;

    /** @var \DateTime The last modified time */
    protected $lastModified;

    /**
     * Create an entity
     *
     * Since we consider an entity could be define with its title,
     * this is the only required argument
     *
     * @param string $title The human title
     * @param null $slug Optional, the slug
     * @param null $id Optional, an identifier
     */
    public function __construct($title, $slug = null, $id = null)
    {
        $this->setTitle($title);
        $this->setSlug($slug);
        $this->setId($id);
        $this->setLastModified(new \DateTime('now'));
    }

    /**
     * Get the id property
     *
     * @return string The entity id
     */
    public function getId()
    {
        return $this->setId();
    }

    /**
     * Set the id property
     *
     * @param null $id A new entity id
     * @return string The entity id
     */
    public function setId($id = null)
    {
        if (!$this->id && $id) {
            $this->id = $id;
            $this->setLastModified(new \DateTime('now'));
        }

        return $this->id;
    }

    /**
     * Get the title
     *
     * @return string The entity title
     */
    public function getTitle()
    {
        return $this->setTitle();
    }

    /**
     * Set the title
     *
     * @param null $title A new entity title
     * @return string The entity title
     */
    public function setTitle($title = null)
    {
        if (!$this->title || $title) {
            $this->title = $title;
        }

        return $this->title;
    }

    /**
     * Get the slug
     *
     * @return string The entity slug
     */
    public function getSlug()
    {
        return $this->setSlug();
    }

    /**
     * Set the slug
     *
     * @param null $slug A new entity slug
     * @return string The entity slug
     */
    public function setSlug($slug = null)
    {
        if (!$this->slug || $slug) {
            if (!$slug) {
                $slug = $this->getTitle();
            }
            $slug = str_replace('-', '666', $slug);
            $slugify = new Slugify();
            $this->slug = str_replace('666', '--', $slugify->slugify($slug));
        }

        return $this->slug;
    }

    /**
     * Get the last modified time
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->setLastModified();

    }

    /**
     * Set the last modified time
     *
     * @param \DateTime $dateTime
     * @return \DateTime
     */
    public function setLastModified(\DateTime $dateTime = null)
    {
        if (!$this->lastModified || $dateTime) {
            $this->lastModified = $dateTime;
        }

        return $this->lastModified;

    }
}