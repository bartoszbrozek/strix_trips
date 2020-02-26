<?php

namespace App\Service;

use Symfony\Component\Console\Helper\Table;

class TableConsoleOutput extends Table
{
    /**
     * Render table based on given data
     *
     * @param array $data
     * @return void
     */
    public function renderTable(array $data): void
    {
        if (count($data) > 0) {
            $this->setHeaders(array_keys(reset($data)));
            $tableRows = [];

            foreach ($data as $row) {
                $tableRows[] = $row;
            }

            $this->setRows($tableRows);
        }

        $this->render();
    }
}
