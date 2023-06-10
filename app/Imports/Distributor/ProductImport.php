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

class ProductImport implements ToCollection, WithStartRow, WithBatchInserts
{

    public $user;
    public $errors;

    public function  __construct($user)
    {
        $this->user = $user;
    }

    /* Rows
        0 - Country
        1 - Distributor
        2 - GIN
        3 - Lot
        4 - Description
        5 - UOM
        6 - Stock on hand
        7 - Goods in transit
        8 - Stock on order
        9 - AVg sales
        10 - Category
        11 - Overstock
    */

    public function collection(Collection $rows)
    {
        $r_count = 2;
        $product_id = 0;
        $oversocked = 0;

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

            if (!isset($row[4])) {
                $errors[] = $this->missing('Stock on Hand', $r_count);
            }
            if (!isset($row[5])) {

                $errors[] = $this->missing('Goods in Transit', $r_count);
            }
            if (!isset($row[6])) {
                $errors[] = $this->missing('Stock on Order', $r_count);
            }
            if (!isset($row[7])) {
                $errors[] =  $this->missing('Average Sales per Month', $r_count);
            }
            if (!isset($row[9])) {
                $errors[] =  $this->missing('Overstocked', $r_count);
            } else {
                $over = strtolower($row[9]);
                if ($over == 'yes') {
                    $oversocked = 1;
                } elseif ($over == 'no') {
                    $oversocked = 1;
                } else {
                    $errors[] = 'Invalid Overstocked "' .  $row[9] . '" in row ' . $r_count;
                }
            }

            if (!isset($row[8])) {
                $errors[] =  $this->missing('Category', $r_count);
            } else {
                $cat = strtolower($row[8]);

                if ($cat !== 'fm' && $cat !== 'non-fm') {
                    $errors[] = 'Invalid Category "' .  $row[8] . '" in row ' . $r_count;
                }

                $cat = ($cat == 'fm') ? "FM" : "Non-FM";
            }

            if (count($errors)) {
                $this->errors[] = $errors;
            }

            if (empty($errors)) {

                // if ($product->lot_no !==  $row[2]) {
                //     $n_product = Product::where([
                //         'GIN' => $row[0],
                //         'lot_no' => $row[1],
                //     ])->first();

                //     if (!$n_product) {
                //         $country = $this->countries->where('name', $this->cleanString($row[0]))->first();
                //         $o_product = Product::create([
                //             'GIN' => $row[2],
                //             'lot_no' => $row[3],
                //             'description' => $row[4],
                //             'UOM' => $row[5],
                //             'category' => $cat,
                //             'country_code' => $country->code,
                //             'status' => 1,
                //         ]);

                //         $product_id = $o_product->id;
                //     } else {
                //         $product_id = $n_product->id;
                //     }
                // }

                DistributorProduct::updateOrCreate([
                    'user_id' => $this->user->id,
                ], [
                    'stock_on_hand' => $row[6],
                    'goods_in_transit' => $row[7],
                    'stock_on_order' => $row[8],
                    'avg_sales' => $row[9],
                    'overstocked' => $oversocked,
                ]);
            }

            $r_count++;
        }
    }

    // public function collection(Collection $rows)
    // {
    //     $r_count = 2;

    //     foreach ($rows as $row) {
    //         $errors = [];
    //         if (!isset($row[0])) {
    //             $errors[] = 'GIN';
    //         }
    //         if (!isset($row[2])) {
    //             $errors[] = 'Stock on Hand';
    //         }
    //         if (!isset($row[3])) {
    //             $errors[] = 'Goods in Transit';
    //         }
    //         if (!isset($row[4])) {
    //             $errors[] = 'Stock on Order';
    //         }
    //         if (!isset($row[5])) {
    //             $errors[] = 'Average Sales per Month';
    //         }
    //         if (!isset($row[6])) {
    //             $errors[] = 'Overstocked';
    //         }

    //         $this->errors['missing'][$r_count] =  $errors;

    //         if (empty($errors)) {
    //             $product = Product::where([
    //                 'GIN' => $row[0]
    //             ])->first();

    //             if ($product) {
    //                 $oversocked = 0;
    //                 if ($row[6] == 'yes' || $row[6] == 'Yes') {
    //                     $oversocked = 1;
    //                 }
    //                 DistributorProduct::updateOrCreate([
    //                     'user_id' => $this->user->id,
    //                     'product_id' => $product->id,
    //                 ], [
    //                     'stock_on_hand' => $row[2],
    //                     'goods_in_transit' => $row[3],
    //                     'stock_on_order' => $row[4],
    //                     'avg_sales' => $row[5],
    //                     'overstocked' => $oversocked,
    //                 ]);
    //             } else {
    //                 $this->errors['invalid_gins'] = $row[0];
    //             }
    //         }

    //         $r_count++;
    //     }
    // }

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
    //     ]);
    // }

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
