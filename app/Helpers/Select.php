<?php

namespace App\Helpers;

class Select
{
    public static function getIdsFromArray(array $data): array
    {
        $ids = [];
        foreach ($data as $datum) {
            $ids[] = $datum['id'];
        }

        return $ids;
    }
}
