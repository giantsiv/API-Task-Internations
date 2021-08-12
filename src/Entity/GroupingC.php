<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_grouping")
 * @ORM\Entity()
 */

class GroupingC
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     *
     * @var UserC|null
     * @ORM\ManyToOne(targetEntity="UserC")
     */
    private $user;
    /**
     *
     * @var GroupC|null
     * @ORM\ManyToOne(targetEntity="GroupC")
     */
    private $group;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return UserC|null
     */
    public function getUser(): ?UserC
    {
        return $this->user;
    }

    /**
     * @param UserC|null $user
     */
    public function setUser(?UserC $user): void
    {
        $this->user = $user;
    }

    /**
     * @return GroupC|null
     */
    public function getGroup(): ?GroupC
    {
        return $this->group;
    }

    /**
     * @param GroupC|null $group
     */
    public function setGroup(?GroupC $group): void
    {
        $this->group = $group;
    }


}