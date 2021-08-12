<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="app_group")
 * @ORM\Entity()
 */

class GroupC
{
    /**
     * @var int|null
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string|null
     * @ORM\Column(name="name", type="string")
     */
    private $group_name;

    /**
     * @return string|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getGroupName(): ?string
    {
        return $this->group_name;
    }

    /**
     * @param string|null $group_name
     */
    public function setGroupName(?string $group_name): void
    {
        $this->group_name = $group_name;
    }

}