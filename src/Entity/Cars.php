<?php

namespace App\Entity;

use App\Repository\CarsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsRepository::class)
 */
class Cars
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $gearBox;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mileage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $prodctionDate;

    /**
     * @ORM\OneToMany(targetEntity=UsersCars::class, mappedBy="cars")
     */
    private $usersCars;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;


    public function __construct()
    {
        $this->usersCars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getGearBox(): ?string
    {
        return $this->gearBox;
    }

    public function setGearBox(string $gearBox): self
    {
        $this->gearBox = $gearBox;

        return $this;
    }

    public function getMileage(): ?string
    {
        return $this->mileage;
    }

    public function setMileage(string $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getProdctionDate(): ?\DateTimeInterface
    {
        return $this->prodctionDate;
    }

    public function setProdctionDate(\DateTimeInterface $prodctionDate): self
    {
        $this->prodctionDate = $prodctionDate;

        return $this;
    }

    /**
     * @return Collection|UsersCars[]
     */
    public function getUsersCars(): Collection
    {
        return $this->usersCars;
    }

    public function addUsersCar(UsersCars $usersCar): self
    {
        if (!$this->usersCars->contains($usersCar)) {
            $this->usersCars[] = $usersCar;
            $usersCar->setCars($this);
        }

        return $this;
    }

    public function removeUsersCar(UsersCars $usersCar): self
    {
        if ($this->usersCars->removeElement($usersCar)) {
            // set the owning side to null (unless already changed)
            if ($usersCar->getCars() === $this) {
                $usersCar->setCars(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->mark;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

}
