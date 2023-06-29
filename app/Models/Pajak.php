<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pajak extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $with = ['pemilik'];

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id')->withDefault([
            'nama' => 'BELUM DI SET',
        ]);
    }
}
