<?php

namespace App\Exports;

use App\Models\Pajak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PajakExport implements
    FromCollection,
    WithMapping,
    WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pajak::all();
    }

    public function map($pajak): array
    {
        $pajak->NOP = "'" . $pajak->NOP;
        return [
            //data yang dari kolom tabel database yang akan diambil
            $pajak->NOP,
            $pajak->nama,
            $pajak->yang_harus_dibayar,
            $pajak->tahun
        ];
    }

    public function headings(): array
    {
        return [
            'NOP',
            'Nama',
            'Yang Harus Dibayar',
            'Tahun'
        ];
    }
}
