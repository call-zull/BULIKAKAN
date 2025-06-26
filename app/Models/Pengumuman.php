<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengumuman';

    protected $fillable = [
        'user_id',
        'judul',
        'foto_barang',
        'waktu',
        'tempat',
        'deskripsi',
        'status',
        'kontak',
        'jenis_pengumuman',
        'tipe_barang_id',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tipeBarang()
    {
        return $this->belongsTo(TipeBarang::class);
    }
    public function scopeKehilangan($query)
    {
        return $query->where('jenis_pengumuman', 'kehilangan');
    }

    public function scopePenemuan($query)
    {
        return $query->where('jenis_pengumuman', 'penemuan');
    }
    public function getFotoBarangUrlAttribute()
    {
        return asset('storage/' . $this->foto_barang);
    }
}
