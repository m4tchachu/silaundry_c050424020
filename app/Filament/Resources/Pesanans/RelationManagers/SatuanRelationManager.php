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

class SatuanRelationManager extends RelationManager
{
    protected static string $relationship = 'satuan';

    public function form(Schema $schema): Schema
    {
    //     return $schema
    //         ->components([
    //             Select::make('ID_SATUAN')
    //                 ->label('Jenis Satuan')
    //                 ->relationship('satuan', 'JENIS_SATUAN')
    //                 ->required()
    //                 ->searchable()
    //                 ->preload(),
    //             TextInput::make('JUMLAH_ITEM')
    //                 ->numeric()
    //                 ->label('Jumlah Item'),
    //             TextInput::make('SUB_TOTAL')
    //                 ->numeric()
    //                 ->label('Sub Total'),
    //         ]);
    // }

    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->recordTitleAttribute('ID_SATUAN')
    //         ->columns([
    //             TextColumn::make('satuan.JENIS_SATUAN')
    //                 ->label('Jenis Satuan'),
    //             TextColumn::make('JUMLAH_ITEM')
    //                 ->label('Jumlah Item'),
    //             TextColumn::make('SUB_TOTAL')
    //                 ->label('Sub Total')
    //                 ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format((int)$state, 0, ',', '.') : 'Rp 0'),
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->headerActions([
    //             CreateAction::make(),
    //             AssociateAction::make(),
    //         ])
    //         ->recordActions([
    //             EditAction::make(),
    //             DissociateAction::make(),
    //             DeleteAction::make(),
    //         ])
    //         ->toolbarActions([
    //             BulkActionGroup::make([
    //                 DissociateBulkAction::make(),
    //                 DeleteBulkAction::make(),
    //             ]),
    //         ]);
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
                        $price = 0;
                        if ($state) {
                            $model = \App\Models\JenisSatuan::find($state);
                            $price = $model ? (int) $model->HARGA : 0;
                        }
                        $jumlah = (int) ($get('JUMLAH_ITEM') ?? 0);
                        $set('SUB_TOTAL', $price * $jumlah);
                    }),

                TextInput::make('JUMLAH_ITEM')
                    ->numeric()
                    ->label('Jumlah Item')
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        $price = 0;
                        $id = $get('ID_SATUAN');
                        if ($id) {
                            $model = \App\Models\JenisSatuan::find($id);
                            $price = $model ? (int) $model->HARGA : 0;
                        }
                        $set('SUB_TOTAL', ((int) ($state ?? 0)) * $price);
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
            ->recordTitleAttribute('ID_SATUAN')
            ->columns([
                TextColumn::make('satuan.JENIS_SATUAN')
                    ->label('Jenis Satuan')
                    ->searchable(),
                TextColumn::make('JUMLAH_ITEM')
                    ->searchable(),
                TextColumn::make('SUB_TOTAL')
                    ->label('Sub Total')
                    ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format((int)$state, 0, ',', '.') : 'Rp 0')
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
