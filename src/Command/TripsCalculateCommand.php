<?php

namespace App\Command;

use App\Service\TableConsoleOutput;
use App\Service\Trips;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        $calculatedTrips = $this->trips->calculateTrips();
        $tableConsoleOutput = new TableConsoleOutput($output);

        $tableConsoleOutput->renderTable($calculatedTrips);
        return 0;
    }
}
