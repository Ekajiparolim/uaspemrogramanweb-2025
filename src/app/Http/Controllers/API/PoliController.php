<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PoliResource;
use App\Models\Poli;

class PoliController extends Controller
{
    /**
     * Menampilkan daftar semua poli.
     */
    public function index()
    {
        $polis = Poli::all();
        return PoliResource::collection($polis);
    }
}