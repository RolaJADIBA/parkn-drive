<?php

namespace App\Entity;

use App\Repository\UsersCarsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersCarsRepository::class)
 */
class UsersCars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="usersCars")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Cars::class, inversedBy="usersCars")
     */
    private $cars;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getCars(): ?Cars
    {
        return $this->cars;
    }

    public function setCars(?Cars $cars): self
    {
        $this->cars = $cars;

        return $this;
    }
}
