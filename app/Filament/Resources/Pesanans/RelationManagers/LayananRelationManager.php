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
use Filament\Forms\Components\Placeholder;
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
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $price = 0;
                        if ($state) {
                            $model = \App\Models\Layanan::find($state);
                            $price = $model ? (int) $model->HARGA : 0;
                        }
                        $jumlah = (int) ($get('JUMLAH_ITEM') ?? 0);
                        $berat = (float) ($get('BERAT') ?? 0);
                        $sub = $jumlah > 0 ? $jumlah * $price : $berat * $price;
                        $set('SUB_TOTAL', $sub);
                    }),

                TextInput::make('JUMLAH_ITEM')
                    ->numeric()
                    ->label('Jumlah Item')
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $price = 0;
                        $id = $get('ID_LAYANAN');
                        if ($id) {
                            $model = \App\Models\Layanan::find($id);
                            $price = $model ? (int) $model->HARGA : 0;
                        }
                        $berat = (float) ($get('BERAT') ?? 0);
                        $sub = ((int) ($state ?? 0)) * $price;
                        if ($sub <= 0 && $berat > 0) {
                            $sub = $berat * $price;
                        }
                        $set('SUB_TOTAL', $sub);
                    }),

                TextInput::make('BERAT')
                    ->numeric()
                    ->label('Berat')
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $price = 0;
                        $id = $get('ID_LAYANAN');
                        if ($id) {
                            $model = \App\Models\Layanan::find($id);
                            $price = $model ? (int) $model->HARGA : 0;
                        }
                        $jumlah = (int) ($get('JUMLAH_ITEM') ?? 0);
                        $sub = ((float) ($state ?? 0)) * $price;
                        if ($jumlah > 0) {
                            $sub = $jumlah * $price;
                        }
                        $set('SUB_TOTAL', $sub);
                    }),

                TextInput::make('SUB_TOTAL')->numeric()->label('Sub Total')->disabled(),
                Placeholder::make('SUB_TOTAL_FORMAT')
                    ->label('Sub Total (Rp)')
                    ->content(fn($get) => $get('SUB_TOTAL') ? ('Rp ' . number_format((int) $get('SUB_TOTAL'), 0, ',', '.')) : 'Rp 0'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ID_LAYANAN')
            ->columns([
                TextColumn::make('layanan.NAMA_LAYANAN')
                    ->label('Layanan'),
                TextColumn::make('JUMLAH_ITEM')
                    ->label('Jumlah Item'),
                TextColumn::make('BERAT')
                    ->label('Berat'),
                TextColumn::make('SUB_TOTAL')
                    ->label('Sub Total')
                    ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format((int)$state, 0, ',', '.') : 'Rp 0'),
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
