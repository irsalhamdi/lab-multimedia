<?php

namespace App\Exports;

use App\Models\Tool;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ToolExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return collect(Tool::latest()->get());
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->quantity,
            $row->description,
            $row->category === 0 ? 'Praktikum' : 'Penelitian',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jumlah',
            'Deskripsi',
            'Kategori'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
