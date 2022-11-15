<?php

namespace App\Exports;

use App\Models\ResearchParticipant;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ParticpantResearchTeacherExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings, WithEvents
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
        return ResearchParticipant::with('user', 'dosen', 'research')->where('research_id', $this->id)->get();
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
