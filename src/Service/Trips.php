<?php

namespace App\Service;

use App\Repository\TripsRepository;

class Trips
{
    private $tripsRepository;

    public function __construct(TripsRepository $tripsRepository)
    {
        $this->tripsRepository = $tripsRepository;
    }

    public function getAll() {
        $trips = $this->tripsRepository->findAll();

        return $trips;
    }
}
