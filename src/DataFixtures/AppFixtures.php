<?php

namespace App\DataFixtures;

use App\Entity\TripMeasures;
use App\Entity\Trips;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * Sample Data Trips
     */
    const DATA_TRIPS = [
        [
            "name" => "Trip 1", "measureInterval" => 15,
            "measures" => [
                0.0, 0.19,
                0.5, 0.75,
                1.0, 1.25,
                1.5, 1.75,
                2.0, 2.25,
            ],
        ],
        [
            "name" => "Trip 2", "measureInterval" => 20,
            "measures" => [
                0.0, 0.23,
                0.46, 0.69,
                0.92, 1.15,
                1.38, 1.61,
            ],
        ],
        [
            "name" => "Trip 3", "measureInterval" => 12,
            "measures" => [
                0.0, 0.11,
                0.22, 0.33,
                0.44, 0.65,
                1.08, 1.26,
                1.68, 1.68,
                1.89, 2.1,
                2.31, 2.52,
                3.25,
            ],
        ],
    ];

    /**
     * Load data fixtures into DB
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::DATA_TRIPS as $dataTrip) {
            $trip = new Trips;
            $trip->setName($dataTrip["name"]);
            $trip->setMeasureInterval($dataTrip["measureInterval"]);

            $manager->persist($trip);

            foreach ($dataTrip["measures"] as $measure) {
                $tripMeasure = new TripMeasures;
                $tripMeasure->setDistance($measure);
                $tripMeasure->setTripId($trip);
                $manager->persist($tripMeasure);
            }
        }

        $manager->flush();
    }
}
