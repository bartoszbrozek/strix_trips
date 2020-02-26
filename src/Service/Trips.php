<?php

namespace App\Service;

use App\Entity\Trips as EntityTrips;
use App\Repository\TripsRepository;

class Trips
{
    private $tripsRepository;
    private $arrayHelper;

    public function __construct(TripsRepository $tripsRepository, ArrayHelper $arrayHelper)
    {
        $this->tripsRepository = $tripsRepository;
        $this->arrayHelper = $arrayHelper;
    }

    public function calculateTrips(): array
    {
        $trips = $this->getAll();

        $data = [];

        foreach ($trips as $trip) {
            $highestAverageSpeed = 0;

            if (count($trip->getTripMeasures()) > 1) {
                $averageSpeeds = $this->calculateAverageSpeeds($trip);
                $highestAverageSpeed = $this->arrayHelper->getHighestValue($averageSpeeds);
            }

            $data[] = [
                'trip' => $trip->getName(),
                'distance' => $this->getDistance($trip),
                'measure_interval' => $trip->getMeasureInterval(),
                'avg_speed' => $highestAverageSpeed,
            ];
        }

        return $data;
    }

    private function getDistance(EntityTrips $trip): int
    {
        $tripMeasures = $trip->getTripMeasures()->toArray();
        $lastTripMeasure = end($tripMeasures);

        return $lastTripMeasure->getDistance();
    }

    public function getAll(): array
    {
        $trips = $this->tripsRepository->findAll();

        return $trips;
    }

    public function getTripByID(int $id): EntityTrips
    {
        $trip = $this->tripsRepository->findOneBy(["id" => $id]);

        return $trip;
    }

    public function calculateAverageSpeeds(EntityTrips $trip): array
    {
        $intervals = $trip->getTripMeasures();
        $averageSpeeds = [];
        $qty = count($intervals);

        for ($i = 1; $i < $qty; $i++) {
            $averageSpeeds[] = $this->calculateDelta(
                $intervals[$i]->getDistance() - $intervals[$i - 1]->getDistance(),
                $trip->getMeasureInterval()
            );
        }

        return $averageSpeeds;
    }

    private function calculateDelta(float $delta, float $second): float
    {
        return (3600 * $delta) / $second;
    }
}
