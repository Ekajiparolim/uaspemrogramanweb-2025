<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JadwalResource\Pages;
use App\Filament\Admin\Resources\JadwalResource\RelationManagers;
use App\Models\Jadwal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Jadwal Praktik';
    protected static ?string $pluralModelLabel = 'Daftar Jadwal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('poli_id')
                ->label('Poli')
                ->options(Poli::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),

                Select::make('hari')
                ->label('Hari')
                ->options([
                    'Senin' => 'Senin',
                    'Selasa' => 'Selasa',
                    'Rabu' => 'Rabu',
                    'Kamis' => 'Kamis',
                    'Jumat' => 'Jumat',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hari')
                ->label('Hari')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('poli.name')
                ->label('Nama Poli')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('jam_mulai'),

            Tables\Columns\TextColumn::make('jam_selesai'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Diperbarui Pada')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->hasRole('super_admin')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasRole('super_admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])->visible(fn () => auth()->user()->hasRole('super_admin')),
            ]);
    }
    public static function canCreate(): bool
    {
        // Hanya user dengan peran super_admin yang bisa membuat jadwal baru
        return auth()->user()->hasRole('super_admin');
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Jika pengguna yang login adalah dokter
        if (auth()->user()->hasRole('dokter')) {
            // Hanya tampilkan jadwal yang sesuai dengan poli dokter tersebut
            return $query->where('poli_id', auth()->user()->poli_id);
        }

        return $query;
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
            'index' => Pages\ListJadwals::route('/'),
            'create' => Pages\CreateJadwal::route('/create'),
            'edit' => Pages\EditJadwal::route('/{record}/edit'),
        ];
    }

}

