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
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductImport implements WithCalculatedFormulas, WithMultipleSheets
{

    public $user;
    public $sheets;

    public function sheets(): array
    {
        $this->sheets = new FirstSheetImport($this->user);

        return [
            0 => $this->sheets
        ];
    }

    public function  __construct($user)
    {
        $this->user = $user;
    }
}
