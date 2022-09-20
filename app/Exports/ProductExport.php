<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Description',
            'Order',
            'status',
            'Created',
            'Created By',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all();
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->description,
            $product->order,
            $product->status,
            $product->created_at->diffForHumans(),
            $product->Created,
        ];
    }
}
