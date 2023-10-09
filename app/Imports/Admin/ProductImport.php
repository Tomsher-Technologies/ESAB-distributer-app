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
    public $errors;
    public $completed;

    public function  __construct($user)
    {
        $this->user = $user;
    }

    public function collection(Collection $rows)
    {
        $r_count = 2;

        dd($rows->count());

        if ($rows->count() <= 1) {
            $this->errors[] = array('The file seems to be empty');
            return 0;
        }

        foreach ($rows as $row) {
            $errors = array();

            if (!isset($row[0])) {
                $errors[] =  $this->missing('GIN', $r_count);
            }
            if (!isset($row[1])) {
                $errors[] =  $this->missing('Description', $r_count);
            }
            if (!isset($row[2])) {
                $errors[] =  $this->missing('UOM', $r_count);
            }
            if (!isset($row[3])) {
                $errors[] =  $this->missing('Category', $r_count);
            } else {
                $cat = strtolower($row[3]);

                if ($cat !== 'fm' && $cat !== 'non-fm') {
                    $errors[] = 'Invalid Category "' .  $row[3] . '" in row ' . $r_count;
                }

                $cat = ($cat == 'fm') ? "FM" : "Non-FM";
            }


            if (count($errors)) {
                $this->errors[] = $errors;
            }

            if (empty($errors)) {
                Product::updateOrCreate([
                    'GIN' => $row[0],
                ], [
                    'description' => $row[1],
                    'UOM' => $row[2],
                    'category' => $cat,
                    'status' => 1,
                    'created_by' => $this->user->id,
                    'updated_by' => $this->user->id,
                ]);
                $this->completed[] = $r_count;
            }

            $r_count++;
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

    public function cleanString($str)
    {
        return trim($str);
    }

    public function missing($str, $row)
    {
        return "Missing $str in row $row";
    }
}
