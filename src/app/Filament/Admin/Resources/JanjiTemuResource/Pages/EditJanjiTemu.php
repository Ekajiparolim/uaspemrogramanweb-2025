<?php

namespace App\Filament\Admin\Resources\JanjiTemuResource\Pages;

use App\Filament\Admin\Resources\JanjiTemuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJanjiTemu extends EditRecord
{
    protected static string $resource = JanjiTemuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
