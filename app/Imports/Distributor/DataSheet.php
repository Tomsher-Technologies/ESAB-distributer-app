<?php

namespace App\Imports\Distributor;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class DataSheet implements ToArray, WithCalculatedFormulas
{
    public function array($row)
    {
    }
}
