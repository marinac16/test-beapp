<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StatutRepository::class)
 * @ApiResource(
 *     normalizationContext={
 *     "groups"={"status_read"}
 *     })
 */
class Statut
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"stations_read", "cities_read", "status_read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Station::class, mappedBy="statut", cascade={"persist", "remove"})
     */
    private $stations;

    /**
     * @ORM\OneToMany(targetEntity=City::class, mappedBy="statut", cascade={"persist", "remove"})
     */
    private $cities;

    public function __construct()
    {
        $this->stations = new ArrayCollection();
        $this->cities = new ArrayCollection();
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
            $station->setStatut($this);
        }

        return $this;
    }

    public function removeStation(Station $station): self
    {
        if ($this->stations->removeElement($station)) {
            // set the owning side to null (unless already changed)
            if ($station->getStatut() === $this) {
                $station->setStatut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setStatut($this);
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if ($this->cities->removeElement($city)) {
            // set the owning side to null (unless already changed)
            if ($city->getStatut() === $this) {
                $city->setStatut(null);
            }
        }

        return $this;
    }
}
