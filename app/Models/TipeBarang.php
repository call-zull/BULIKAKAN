<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeBarang extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function pengumumen()
    {
        return $this->hasMany(Pengumuman::class);
    }
}
