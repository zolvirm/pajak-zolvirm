<?php

namespace App\Imports;

use App\Models\Pajak;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PajakImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        if (substr($row['nop'], 0, 1) == "'") {
            $row['nop'] = substr($row['nop'], 1);
        }
        return new Pajak([
            'NOP' => $row['nop'],
            'nama' => Str::upper($row['nama']),
            'tahun' => $row['tahun'],
            'yang_harus_dibayar' => $row['yang_harus_dibayar'],
            'pemilik_id' => $row['id_pemilik'],
            'status' => '0'
        ]);
    }

    //agar heading tidak ikut di import atau bisa di bilang di mulai dari kolom 2 (return 2)
    // public function startRow(): int
    // {
    //     return 2;
    // }

    public function rules(): array
    {
        //
        return [
            '*.nop' => ['required', 'unique:pajaks', 'numeric', 'digits:18'],
            '*.nama' => ['required', 'max:255'],
            '*.tahun' => ['required', 'digits:4', 'numeric'],
            '*.yang_harus_dibayar' => ['required', 'numeric'],
        ];
    }
}
