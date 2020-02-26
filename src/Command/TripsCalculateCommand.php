<?php

namespace App\Command;

use App\Service\Trips;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TripsCalculateCommand extends Command
{
    protected static $defaultName = 'trips:calculate';
    private $trips;

    public function __construct(Trips $trips)
    {
        $this->trips = $trips;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->trips->calculateTrips();

        return 0;
    }
}
