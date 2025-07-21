<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JanjiTemuResource\Pages;
use App\Filament\Admin\Resources\JanjiTemuResource\RelationManagers;
use App\Models\JanjiTemu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use App\Models\Poli;
use App\Models\User;
use App\Models\Jadwal;

class JanjiTemuResource extends Resource
{
    protected static ?string $model = JanjiTemu::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Janji Temu';
    protected static ?string $pluralModelLabel = 'Daftar Janji Temu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pasien_id')
                    ->label('Pasien')
                    ->relationship('pasien', 'name')
                    ->options(User::whereHas('roles', fn($q) => $q->where('name', 'pasien'))->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('poli_id')
                    ->label('Poli')
                    ->options(Poli::pluck('name', 'id'))
                    ->searchable()
                    ->reactive()
                    ->required(),

                Forms\Components\Select::make('dokter_id')
                    ->label('Dokter')
                    ->options(function (callable $get) {
                        $poliId = $get('poli_id');
                        if (!$poliId) return [];
                        return User::where('poli_id', $poliId)
                            ->whereHas('roles', fn($q) => $q->where('name', 'dokter'))
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('hari')
                    ->label('Hari')
                    ->options(function (callable $get) {
                        $poliId = $get('poli_id');
                        if (!$poliId) return [];

                        return \App\Models\Jadwal::where('poli_id', $poliId)
                            ->pluck('hari', 'hari')
                            ->unique()
                            ->toArray();
                    })
                    ->reactive()
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('jam')
                    ->label('Jam')
                    ->required()
                    ->options([
                        '09:00' => '09:00',
                        '10:00' => '10:00',
                        '11:00' => '11:00',
                        '12:00' => '12:00',
                        '13:00' => '13:00',
                        '14:00' => '14:00',
                        '15:00' => '15:00',
                        '16:00' => '16:00',
                    ])
                    ->native(false),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.name')->label('Pasien'),
                Tables\Columns\TextColumn::make('poli.name')->label('Poli'),
                Tables\Columns\TextColumn::make('dokter.name')->label('Dokter'),
                Tables\Columns\TextColumn::make('hari')->label('Hari'),
                Tables\Columns\TextColumn::make('jam')->label('Jam')->time(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJanjiTemus::route('/'),
            'create' => Pages\CreateJanjiTemu::route('/create'),
            'edit' => Pages\EditJanjiTemu::route('/{record}/edit'),
        ];
    }
}
