<?php

namespace App\Filament\Resources\Pesanans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use App\Models\Admin;

class PesananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ID_PESANAN')
                    ->label('ID Pesanan')
                    ->required()
                    ->maxLength(6),

                Select::make('ID_PELANGGAN')
                    ->label('Pelanggan')
                    ->relationship('pelanggan', 'NAMA_PELANGGAN')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('ID_ADMIN')
                    ->label('Admin')
                    ->relationship('admin', 'NAMA_ADMIN')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('ID_KILOAN')
                    ->label('Jenis Kiloan')
                    ->relationship('jenisKiloan', 'PAKET_KILOAN')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                DatePicker::make('TANGGAL_MASUK')->label('Tanggal Masuk'),
                DatePicker::make('ESTIMASI_SELESAI')->label('Estimasi Selesai'),

                // Inline layanan has-many repeater
                Repeater::make('layanan')
                    ->relationship('layanan')
                    ->label('Layanan')
                    ->schema([
                        Select::make('ID_LAYANAN')
                            ->label('Layanan')
                            ->relationship('layanan', 'NAMA_LAYANAN')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $harga = \App\Models\Layanan::find($state)?->HARGA ?? 0;
                                $jumlah = $get('JUMLAH_ITEM') ?? 0;
                                $set('SUB_TOTAL', $jumlah * $harga);

                                // update parent total
                                $totalLayanan = collect($get('layanan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $totalSatuan = collect($get('satuan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $set('TOTAL_BIAYA', $totalLayanan + $totalSatuan);
                            }),

                        TextInput::make('JUMLAH_ITEM')
                            ->numeric()
                            ->label('Jumlah')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $harga = \App\Models\Layanan::find($get('ID_LAYANAN'))?->HARGA ?? 0;
                                $set('SUB_TOTAL', ($state ?? 0) * $harga);

                                $totalLayanan = collect($get('layanan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $totalSatuan = collect($get('satuan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $set('TOTAL_BIAYA', $totalLayanan + $totalSatuan);
                            }),

                        TextInput::make('BERAT')
                            ->numeric()
                            ->label('Berat (kg)')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                // if layanan also uses berat factor into sub_total, handle here if needed
                            }),

                        TextInput::make('SUB_TOTAL')
                            ->numeric()
                            ->label('Sub Total')
                            ->disabled(),
                    ])
                    ->columns(4),

                // Inline satuan has-many repeater
                Repeater::make('satuan')
                    ->relationship('satuan')
                    ->label('Satuan')
                    ->schema([
                        Select::make('ID_SATUAN')
                            ->label('Satuan')
                            ->relationship('satuan', 'JENIS_SATUAN')
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $harga = \App\Models\JenisSatuan::find($state)?->HARGA ?? 0;
                                $jumlah = $get('JUMLAH_ITEM') ?? 0;
                                $set('SUB_TOTAL', $jumlah * $harga);

                                $totalLayanan = collect($get('layanan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $totalSatuan = collect($get('satuan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $set('TOTAL_BIAYA', $totalLayanan + $totalSatuan);
                            }),

                        TextInput::make('JUMLAH_ITEM')
                            ->numeric()
                            ->label('Jumlah')
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set, $get) {
                                $harga = \App\Models\JenisSatuan::find($get('ID_SATUAN'))?->HARGA ?? 0;
                                $set('SUB_TOTAL', ($state ?? 0) * $harga);

                                $totalLayanan = collect($get('layanan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $totalSatuan = collect($get('satuan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0);
                                $set('TOTAL_BIAYA', $totalLayanan + $totalSatuan);
                            }),

                        TextInput::make('SUB_TOTAL')
                            ->numeric()
                            ->label('Sub Total')
                            ->disabled(),
                    ])
                    ->columns(4),

                TextInput::make('BERAT')->numeric()->label('Berat (kg)')->nullable(),
                TextInput::make('JUMLAH_ITEM')->numeric()->label('Jumlah Item')->nullable(),
                TextInput::make('STATUS')->label('Status')->nullable(),

                Select::make('ID_KURIR')
                    ->label('Kurir')
                    ->relationship('kurir', 'NAMA_KURIR')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                TextInput::make('TOTAL_BIAYA')
                    ->numeric()
                    ->label('Total Biaya')
                    ->disabled()
                    ->default(fn ($get) =>
                        collect($get('layanan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0)
                        + collect($get('satuan') ?? [])->sum(fn($i) => $i['SUB_TOTAL'] ?? 0)
                    ),
                Textarea::make('CATATAN')->label('Catatan')->nullable(),
            ]);
    }
}
