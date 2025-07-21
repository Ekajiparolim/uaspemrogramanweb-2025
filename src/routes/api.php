<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PoliController;

Route::get('/poli', [PoliController::class, 'index']);