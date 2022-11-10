<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ParticipantsExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Participant::with('user', 'training')->where('training_id', $this->id)->get();
    }

    public function map($row): array
    {
        return [
            $row->user->name,
            $row->user->nim,
            $row->user->jurusan,
            $row->absent
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'Jurusan',
            'Keterangan'
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
