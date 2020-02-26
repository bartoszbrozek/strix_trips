<?php

namespace App\Service;

use App\Entity\Trips as EntityTrips;
use App\Repository\TripsRepository;

class Trips
{
    /**
     * Repository of Trips
     *
     * @var TripsRepository
     */
    private $tripsRepository;

    /**
     * Helper for array
     *
     * @var ArrayHelper
     */
    private $arrayHelper;

    /**
     * Class contstructor
     *
     * @param TripsRepository $tripsRepository
     * @param ArrayHelper $arrayHelper
     */
    public function __construct(TripsRepository $tripsRepository, ArrayHelper $arrayHelper)
    {
        $this->tripsRepository = $tripsRepository;
        $this->arrayHelper = $arrayHelper;
    }

    /**
     * Calculate all available trips in database
     *
     * @return array
     */
    public function calculateTrips(): array
    {
        $trips = $this->getAll();
        $data = [];

        foreach ($trips as $trip) {
            $data[] = $this->calculateSingleTrip($trip);
        }

        return $data;
    }

    /**
     * Calculate single trip data
     *
     * @param EntityTrips $trip
     * @return array
     */
    public function calculateSingleTrip(EntityTrips $trip): array
    {
        $highestAverageSpeed = 0;

        if (count($trip->getTripMeasures()) > 1) {
            $averageSpeeds = $this->calculateAverageSpeeds($trip);
            $highestAverageSpeed = $this->arrayHelper->getHighestValue($averageSpeeds);
        }

        return [
            'trip' => $trip->getName(),
            'distance' => $this->getDistance($trip),
            'measure_interval' => $trip->getMeasureInterval(),
            'avg_speed' => $highestAverageSpeed,
        ];
    }

    /**
     * Calculate distance based on trip
     *
     * @param EntityTrips $trip
     * @return float
     */
    private function getDistance(EntityTrips $trip): float
    {
        $tripMeasures = $trip->getTripMeasures()->toArray();
        $lastTripMeasure = end($tripMeasures);

        return $lastTripMeasure->getDistance();
    }

    /**
     * Get all trips
     *
     * @return array
     */
    private function getAll(): array
    {
        $trips = $this->tripsRepository->findAll();

        return $trips;
    }

    /**
     * Calculate average speed of trip
     *
     * @param EntityTrips $trip
     * @return array
     */
    private function calculateAverageSpeeds(EntityTrips $trip): array
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

    /**
     * Calculate delta
     *
     * @param float $delta
     * @param float $second
     * @return float
     */
    private function calculateDelta(float $delta, float $second): float
    {
        if ($second === 0) {
            return 0;
        }

        return (3600 * $delta) / $second;
    }
}
