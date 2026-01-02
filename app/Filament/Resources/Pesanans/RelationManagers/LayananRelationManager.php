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

class LayananRelationManager extends RelationManager
{
    protected static string $relationship = 'layanan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ID_LAYANAN')
                    ->label('Layanan')
                    ->relationship('layanan', 'NAMA_LAYANAN')
                    ->required()
                    ->searchable()
                    ->preload(),

                TextInput::make('JUMLAH_ITEM')->numeric()->label('Jumlah Item'),
                TextInput::make('BERAT')->numeric()->label('Berat'),
                TextInput::make('SUB_TOTAL')->numeric()->label('Sub Total'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ID_LAYANAN')
            ->columns([
                TextColumn::make('layanan.NAMA_LAYANAN')
                    ->label('Layanan')
                    ->searchable(),
                TextColumn::make('JUMLAH_ITEM')
                    ->searchable(),
                TextColumn::make('BERAT')
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
