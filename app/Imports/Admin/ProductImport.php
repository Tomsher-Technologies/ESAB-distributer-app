<?php

namespace App\Imports\Admin;

use App\Models\Country;
use App\Models\Product\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
// use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ProductImport implements ToCollection, WithStartRow, WithBatchInserts, WithUpserts
{

    public $user;
    public $countries;

    public function  __construct($user)
    {
        $this->user = $user;
        $this->countries = Country::all();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            if (
                isset($row[0]) &&
                isset($row[1]) &&
                isset($row[3]) &&
                isset($row[4]) &&
                isset($row[5])
            ) {

                if ($this->countries->where('code', $row[5])->first()) {
                    $country = $row[5];
                } else {
                    $country = 'AE';
                }

                Product::updateOrCreate([
                    'GIN' => $row[0],
                    'lot_no' => $row[1],
                ], [
                    'description' => $row[2],
                    'UOM' => $row[3],
                    'category' => $row[4],
                    'country_code' => $country,
                    'status' => 1,
                    'created_by' => $this->user->id,
                    'updated_by' => $this->user->id,
                ]);
            }
        }
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     if (
    //         !isset($row[0]) ||
    //         !isset($row[1]) ||
    //         !isset($row[3]) ||
    //         !isset($row[4])
    //     ) {
    //         return null;
    //     }

    //     return new Product([
    //         'GIN' => $row[0],
    //         'lot_no' => $row[1],
    //         'description' => $row[2],
    //         'UOM' => $row[3],
    //         'category' => $row[4],
    //         'status' => 1,
    //         'created_by' => $this->user->id,
    //         'updated_by' => $this->user->id,
    //     ]);
    // }

    public function uniqueBy()
    {
        return 'email';
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
