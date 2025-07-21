<?php

namespace App\Filament\Admin\Resources\JanjiTemuResource\Pages;

use App\Filament\Admin\Resources\JanjiTemuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJanjiTemus extends ListRecords
{
    protected static string $resource = JanjiTemuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
