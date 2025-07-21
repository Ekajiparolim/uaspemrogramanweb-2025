<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class JanjiTemu extends Model
{
    use HasFactory;
    protected $fillable = [
        'pasien_id',
        'poli_id',
        'dokter_id',
        'hari',
        'jam',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
