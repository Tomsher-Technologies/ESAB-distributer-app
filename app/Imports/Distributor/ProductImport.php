<?php

namespace App\Imports\Distributor;

use App\Models\Product\DistributorProduct;
use App\Models\Product\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
// use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToCollection, WithStartRow, WithBatchInserts
{

    public $user;

    public function  __construct($user)
    {
        $this->user = $user;
    }


    public function collection(Collection $rows)
    {

        // dd($rows);

        foreach ($rows as $row) {
            if (
                isset($row[0]) &&
                isset($row[1]) &&
                isset($row[2]) &&
                isset($row[3]) &&
                isset($row[4]) &&
                isset($row[5]) &&
                isset($row[6])
            ) {

                $product = Product::where([
                    'GIN' => $row[0],
                    'lot_no' => $row[1],
                ])->first();

                if ($product) {

                    $oversocked = 0;

                    if ($row[6] == 'yes' || $row[6] == 'Yes') {
                        $oversocked = 1;
                    }

                    DistributorProduct::updateOrCreate([
                        'user_id' => $this->user->id,
                        'product_id' => $product->id,
                    ], [
                        'stock_on_hand' => $row[2],
                        'goods_in_transit' => $row[3],
                        'stock_on_order' => $row[4],
                        'avg_sales' => $row[5],
                        'overstocked' => $oversocked,
                    ]);
                }
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
}
