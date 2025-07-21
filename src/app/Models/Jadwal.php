<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'poli_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];


    public function poli()
    {
    return $this->belongsTo(Poli::class);
    }

}
