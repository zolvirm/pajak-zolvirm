<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemilik extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    // protected $fillable = ['nama', 'dusun', 'RT', 'RW', 'alamat'];

    public function pajak()
    {
        return $this->hasMany(Pajak::class, 'pemilik_id');
    }
}
