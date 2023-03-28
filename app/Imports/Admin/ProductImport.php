<?php

namespace App\Imports\Admin;

use App\Models\Product\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToModel, WithStartRow, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (
            !isset($row[0]) ||
            !isset($row[1]) ||
            !isset($row[3]) ||
            !isset($row[4])
        ) {
            return null;
        }

        return new Product([
            'GIN' => $row[0],
            'lot_no' => $row[1],
            'description' => $row[2],
            'UOM' => $row[3],
            'category' => $row[4],
            'status' => 1,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
