<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VendorImport implements ToArray, WithHeadingRow, WithChunkReading
{
    /**
     * @param array $array
     *
     * @return int
     */
    public function array(Array $array): int
    {
       return 0;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
