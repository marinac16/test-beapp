<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StationRepository::class)
 * @ApiResource(
 *     normalizationContext={
 *     "groups"={"stations_read"}
 *     }
 * )
 */
class Station
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stations_read", "cities_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stations_read", "cities_read"})
     */
    private $adress;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"stations_read", "cities_read"})
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"stations_read", "cities_read"})
     */
    private $bikeQuantityAvailable;

    /**
     * @ORM\OneToOne(targetEntity=Position::class, cascade={"persist", "remove"})
     * @Groups({"stations_read", "cities_read"})
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="stations")
     * @Groups({"stations_read"})
     */
    private $city;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"cities_read", "stations_read"})
     */
    private $statut = false;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getBikeQuantityAvailable(): ?int
    {
        return $this->bikeQuantityAvailable;
    }

    public function setBikeQuantityAvailable(int $bikeQuantityAvailable): self
    {
        $this->bikeQuantityAvailable = $bikeQuantityAvailable;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return bool
     */
    public function isStatut(): bool
    {
        return $this->statut;
    }

    /**
     * @param bool $statut
     */
    public function setStatut(bool $statut): void
    {
        $this->statut = $statut;
    }



}
