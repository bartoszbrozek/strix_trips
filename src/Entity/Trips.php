<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripsRepository")
 */
class Trips
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $measure_interval;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TripMeasures", mappedBy="trip_id", orphanRemoval=true)
     */
    private $tripMeasures;

    public function __construct()
    {
        $this->tripMeasures = new ArrayCollection();
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

    public function getMeasureInterval(): ?int
    {
        return $this->measure_interval;
    }

    public function setMeasureInterval(int $measure_interval): self
    {
        $this->measure_interval = $measure_interval;

        return $this;
    }

    /**
     * @return Collection|TripMeasures[]
     */
    public function getTripMeasures(): Collection
    {
        return $this->tripMeasures;
    }

    public function addTripMeasure(TripMeasures $tripMeasure): self
    {
        if (!$this->tripMeasures->contains($tripMeasure)) {
            $this->tripMeasures[] = $tripMeasure;
            $tripMeasure->setTripId($this);
        }

        return $this;
    }

    public function removeTripMeasure(TripMeasures $tripMeasure): self
    {
        if ($this->tripMeasures->contains($tripMeasure)) {
            $this->tripMeasures->removeElement($tripMeasure);
            // set the owning side to null (unless already changed)
            if ($tripMeasure->getTripId() === $this) {
                $tripMeasure->setTripId(null);
            }
        }

        return $this;
    }
}
