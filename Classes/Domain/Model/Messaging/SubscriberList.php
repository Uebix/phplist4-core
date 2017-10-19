<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Domain\Model\Messaging;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\Table;
use PhpList\PhpList4\Domain\Model\Interfaces\Identity;
use PhpList\PhpList4\Domain\Model\Traits\IdentityTrait;

/**
 * This class represents an administrator who can log to the system, is allowed to administer
 * selected lists (as the owner), send campaigns to these lists and edit subscribers.
 *
 * @Entity(repositoryClass="PhpList\PhpList4\Domain\Repository\Messaging\SubscriberListRepository")
 * @Table(name="phplist_list")
 * @HasLifecycleCallbacks
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
class SubscriberList implements Identity
{
    use IdentityTrait;

    /**
     * @var string
     * @Column
     */
    private $name = '';

    /**
     * @var string
     * @Column
     */
    private $description = '';

    /**
     * @var \DateTime|null
     * @Column(type="datetime", nullable=true, name="entered")
     */
    private $creationDate = null;

    /**
     * @var \DateTime|null
     * @Column(type="datetime", nullable=true, name="modified")
     */
    private $modificationDate = null;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return void
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     *
     * @return void
     */
    private function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * Updates the creation date to now.
     *
     * @PrePersist
     *
     * @return void
     */
    public function updateCreationDate()
    {
        $this->setCreationDate(new \DateTime());
    }

    /**
     * @return \DateTime|null
     */
    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    /**
     * @param \DateTime $modificationDate
     *
     * @return void
     */
    private function setModificationDate(\DateTime $modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * Updates the modification date to now.
     *
     * @PrePersist
     * @PreUpdate
     *
     * @return void
     */
    public function updateModificationDate()
    {
        $this->setModificationDate(new \DateTime());
    }
}
