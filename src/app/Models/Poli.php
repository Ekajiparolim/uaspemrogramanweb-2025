<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

public function jadwals()
{
    return $this->hasMany(Jadwal::class);
}

public function dokters()
{
    return $this->hasMany(User::class);
}


}
