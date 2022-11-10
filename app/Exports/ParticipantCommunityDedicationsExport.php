<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\ParticipantCommunityDedication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class ParticipantCommunityDedicationsExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
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
        return ParticipantCommunityDedication::with('user', 'dosen', 'dedication')->where('dedication_id', $this->id)->get();
    }

    public function map($row): array
    {
        return [
            $row->dosen_id === null ? $row->user->name : $row->dosen->name,
            $row->dosen_id === null ? $row->user->jurusan : $row->dosen->jurusan,
            $row->dosen_id === null ? $row->user->phone : $row->dosen->phone,
            $row->dosen_id === null ? 'Mahasiswa' : 'Dosen',
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Jurusan',
            'No Handphone',
            'Status',
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
