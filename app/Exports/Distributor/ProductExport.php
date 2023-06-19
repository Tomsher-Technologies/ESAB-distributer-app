<?php

namespace App\Exports\Distributor;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{

    public $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function headings(): array
    {
        return [
            'GIN Number',
            'Lot',
            'Description',
            'Category',
            'UOM',
            'Stock on Hand',
            'Goods in Transit',
            'Stock on Order',
            'Avg Sales/Month',
            'Overstocked',
            'Created At',
            'Last Updated At',
        ];
    }

    public function map($product): array
    {
        return [
            $product->product->GIN,
            $product->lot_number,
            $product->product->description,
            $product->product->category,
            $product->product->UOM,
            $product->stock_on_hand,
            $product->goods_in_transit,
            $product->stock_on_order,
            $product->avg_sales,
            $product->overstocked == 1 ? 'Yes' : 'No',
            $product->created_at->format('d-m-y'),
            $product->updated_at->format('d-m-y'),
            // Date::dateTimeToExcel($product->created_at),
            // Date::dateTimeToExcel($product->updated_at),
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
