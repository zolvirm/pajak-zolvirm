<?php

namespace App\Imports;

use App\Models\Pemilik;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PemilikImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Pemilik([
            'nama' => $row['nama'],
            'dusun' => $row['dusun'],
            'RT' => $row['rt'],
            'RW' => $row['rw'],
            'alamat' => $row['alamat'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nama' => ['required', 'unique:pemiliks'],
            '*.dusun' => ['required'],
            '*.rt' => ['required', 'numeric'],
            '*.rw' => ['required', 'numeric'],
            '*.alamat' => ['required'],
        ];
    }
}
