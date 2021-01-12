<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 * @ApiResource(
 *     normalizationContext={
 *     "groups"={"cities_read"}
 *     },
 *     attributes={
 *     "order": {"name":"asc"}
 *     }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"statut"})
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"cities_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cities_read", "stations_read"})
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Position::class, cascade={"persist", "remove"})
     * @Groups({"cities_read"})
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity=Station::class, mappedBy="city")
     * @Groups({"cities_read"})
     */
    private $stations;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"cities_read", "stations_read"})
     */
    private $statut = false;

    public function __construct()
    {
        $this->stations = new ArrayCollection();
    }

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

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Station[]
     */
    public function getStations(): Collection
    {
        return $this->stations;
    }

    public function addStation(Station $station): self
    {
        if (!$this->stations->contains($station)) {
            $this->stations[] = $station;
            $station->setCity($this);
        }

        return $this;
    }

    public function removeStation(Station $station): self
    {
        if ($this->stations->removeElement($station)) {
            // set the owning side to null (unless already changed)
            if ($station->getCity() === $this) {
                $station->setCity(null);
            }
        }

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
