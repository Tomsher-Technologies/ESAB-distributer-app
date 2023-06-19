<?php

namespace App\Exports\Admin;

use App\Models\Product\DistributorProduct;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DashboardExport implements FromCollection, WithHeadings, WithMapping
{

    public function headings(): array
    {
        return [
            'Distributor',
            'Country',
            'GIN Number',
            'Lot',
            'Category',
            'UOM',
            'Stock on Hand',
            'Overstocked',
        ];
    }

    public $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function map($product): array
    {
        return [
            $product->distributor->name,
            $product->product->country->name,
            $product->product->GIN,
            $product->lot_number,
            $product->product->category,
            $product->product->UOM,
            $product->stock_on_hand,
            $product->overstocked == 1 ? 'Yes' : 'No',
            // Date::dateTimeToExcel($product->created_at),
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->products;
    }
}
