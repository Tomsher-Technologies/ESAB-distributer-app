<?php

namespace App\Imports\Distributor;

use App\Models\Country;
use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class FirstSheetImport implements ToCollection, WithStartRow, WithBatchInserts
{

    public $user;
    public $errors;

    public function  __construct($user)
    {
        $this->user = $user;
    }

    /* Rows
        0- GIN
        1- Lot
        2- Description
        3- UOM
        4- Stock on hand
        5- Goods in transit
        6- Stock on order
        7- AVg sales
        8 - Category
        9 - Overstock
    */

    public function collection(Collection $rows)
    {
        $r_count = 2;
        $product_id = 0;
        $oversocked = 0;

        if ($rows->count() < 1) {
            $this->errors[] = array('The file seems to be empty');
            return 0;
        }

        foreach ($rows as $row) {
            $errors = array();

            if (!isset($row[0])) {
                $errors[] =  $this->missing('GIN', $r_count);
            } else {
                $product = Product::where([
                    'GIN' => $row[0],
                ])->first();
                if (!$product) {
                    $errors[] = 'Invalid GIN "' .  $row[0] . '" in row ' . $r_count;
                } else {
                    $product_id = $product->id;
                }
            }

            if (!isset($row[9])) {
                $errors[] =  $this->missing('Overstocked', $r_count);
            } else {
                $over = strtolower($row[9]);
                $over = trim($over);
                if ($over == 'yes') {
                    $oversocked = 1;
                } elseif ($over == 'no') {
                    $oversocked = 0;
                } else {
                    $errors[] = 'Invalid Overstocked "' .  $row[9] . '" in row ' . $r_count;
                }
            }

            if (count($errors)) {
                $this->errors[] = $errors;
            }

            if (empty($errors)) {
                DistributorProduct::updateOrCreate([
                    'user_id' => $this->user->id,
                    'product_id' => $product_id,
                    'lot_number' => $row[1]
                ], [
                    'stock_on_hand' => isset($row[4]) ? $row[4] : null,
                    'goods_in_transit' => isset($row[5]) ? $row[5] : null,
                    'stock_on_order' => isset($row[6]) ? $row[6] : null,
                    'avg_sales' => isset($row[7]) ? $row[7] : null,
                    'overstocked' => $oversocked,
                ]);
            }

            $r_count++;
        }
        // dd($errors);
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
