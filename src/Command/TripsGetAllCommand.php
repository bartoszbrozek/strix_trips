<?php

namespace App\Command;

use App\Service\Trips;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class TripsGetAllCommand extends Command
{
    use ContainerAwareTrait;

    protected static $defaultName = 'trips:get-all';
    private $trips;

    public function __construct(Trips $trips)
    {
        $this->trips = $trips;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);
        $table->setHeaders(['trip', 'measure interval']);
        $tableRows = [];

        foreach ($this->trips->getAll() as $trip) {
            $tableRows[] = [
                $trip->getName(),
                $trip->getMeasureInterval()
            ];
        }

        $table->setRows($tableRows);

        $table->render();

        return 0;
    }
}
