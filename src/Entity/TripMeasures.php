<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripMeasuresRepository")
 */
class TripMeasures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trips", inversedBy="tripMeasures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trip_id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $distance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTripId(): ?Trips
    {
        return $this->trip_id;
    }

    public function setTripId(?Trips $trip_id): self
    {
        $this->trip_id = $trip_id;

        return $this;
    }

    public function getDistance(): ?string
    {
        return $this->distance;
    }

    public function setDistance(string $distance): self
    {
        $this->distance = $distance;

        return $this;
    }
}
