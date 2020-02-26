<?php

namespace App\Service;


class ArrayHelper
{
    public function getHighestValue(array $data): int
    {
        return floor(max($data));
    }
}
