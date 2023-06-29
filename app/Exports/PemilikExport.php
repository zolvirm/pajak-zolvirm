<?php

namespace App\Exports;

use App\Models\Pemilik;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PemilikExport implements
    FromCollection,
    WithMapping,
    WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pemilik::all();
    }
    public function map($row): array
    {
        return [
            $row->nama,
            $row->dusun,
            $row->RT,
            $row->RW,
            $row->alamat,
        ];
    }

    public function headings(): array
    {
        return ['NAMA', 'DUSUN', 'RT', 'RW', 'ALAMAT'];
    }
}
