<?php

namespace App\Service;

class ArrayHelper
{
    /**
     * Get highest value of given array
     *
     * @param array $data
     * @return integer
     */
    public function getHighestValue(array $data): int
    {
        return floor(max($data));
    }
}
