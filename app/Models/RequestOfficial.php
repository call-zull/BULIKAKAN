<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOfficial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_instansi', 'alasan', 'dokumen_pendukung', 'status_request',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
