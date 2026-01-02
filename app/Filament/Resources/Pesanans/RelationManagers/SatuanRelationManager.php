<?php

namespace App\Filament\Resources\Pesanans\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SatuanRelationManager extends RelationManager
{
    protected static string $relationship = 'satuan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ID_SATUAN')
                    ->label('Jenis Satuan')
                    ->relationship('satuan', 'JENIS_SATUAN')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $harga = \App\Models\JenisSatuan::find($state)?->HARGA ?? 0;
                        $jumlah = $get('JUMLAH_ITEM') ?? 0;
                        $set('SUB_TOTAL', $jumlah * $harga);
                    }),

                TextInput::make('JUMLAH_ITEM')
                    ->numeric()
                    ->label('Jumlah Item')
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $harga = \App\Models\JenisSatuan::find($get('ID_SATUAN'))?->HARGA ?? 0;
                        $set('SUB_TOTAL', ($state ?? 0) * $harga);
                    }),

                TextInput::make('SUB_TOTAL')->numeric()->label('Sub Total'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ID_SATUAN')
            ->columns([
                TextColumn::make('satuan.JENIS_SATUAN')
                    ->label('Jenis Satuan')
                    ->searchable(),
                TextColumn::make('JUMLAH_ITEM')
                    ->searchable(),
                TextColumn::make('SUB_TOTAL')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
