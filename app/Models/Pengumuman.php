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
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'selesai',
        'tags'
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'selesai' => 'boolean',
        'tags' => 'array'
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

    public static function generateTags($text)
    {
        $text = strtolower($text);

        $keywords = [
            'hp' => ['hp', 'smartphone', 'xiaomi', 'samsung', 'iphone', 'oppo', 'vivo', 'realme'],
            'laptop' => ['laptop', 'notebook', 'macbook', 'asus', 'lenovo', 'acer'],
            'kunci' => ['kunci', 'key', 'gembok'],
            'dompet' => ['dompet', 'wallet', 'uang'],
            'tas' => ['tas', 'backpack', 'ransel'],
            // tambah lagi sesuai kebutuhan
        ];

        $tags = [];

        foreach ($keywords as $category => $syns) {
            foreach ($syns as $word) {
                if (str_contains($text, $word)) {
                    $tags = array_merge($tags, $syns);
                    break;
                }
            }
        }

        return array_values(array_unique($tags));
    }
}
