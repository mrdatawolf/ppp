<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OutdoorResearchImport implements ToArray, WithHeadingRow
{
    /**
     * @param array $array
     *
     * @return int
     */
    public function array(Array $array)
    {
       return 0;
    }
}