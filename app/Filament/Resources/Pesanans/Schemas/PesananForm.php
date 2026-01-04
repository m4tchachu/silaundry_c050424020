<?php

namespace App\Filament\Resources\Pesanans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;
use App\Models\JenisKiloan;
use App\Models\JenisSatuan;
use App\Models\Layanan;

class PesananForm
{
    public static function configure(Schema $schema): Schema
    {
        // return $schema
        //     ->components([
        //         Grid::make()
        //             ->schema([
        //                 Section::make('Informasi Dasar')
        //                     ->schema([
        //                         TextInput::make('ID_PESANAN')
        //                             ->label('ID Pesanan')
        //                             ->required()
        //                             ->maxLength(6),

        //                         Select::make('ID_PELANGGAN')
        //                             ->label('Pelanggan')
        //                             ->relationship('pelanggan', 'NAMA_PELANGGAN')
        //                             ->searchable()
        //                             ->preload()
        //                             ->required(),

        //                         Select::make('ID_ADMIN')
        //                             ->label('Admin')
        //                             ->relationship('admin', 'NAMA_ADMIN')
        //                             ->searchable()
        //                             ->preload()
        //                             ->required(),

        //                         Select::make('ID_KURIR')
        //                             ->label('Kurir')
        //                             ->relationship('kurir', 'NAMA_KURIR')
        //                             ->searchable()
        //                             ->preload()
        //                             ->nullable(),
        //                     ]),
        //             ])->columns(1),

        //         Section::make('Rincian Item')
        //             ->schema([
        //                 Select::make('ID_KILOAN')
        //                         ->label('Jenis Kiloan')
        //                         ->relationship('jenisKiloan', 'PAKET_KILOAN')
        //                         ->searchable()
        //                         ->preload()
        //                         ->reactive()
        //                         ->afterStateUpdated(function ($state, $set, $get) {
        //                             $price = 0;
        //                             if ($state) {
        //                                 $model = JenisKiloan::find($state);
        //                                 $price = $model ? (int) $model->HARGA : 0;
        //                             }
        //                             $berat = (float) ($get('BERAT') ?? 0);
        //                             $subtotal = $berat * $price;
        //                             $set('SUBTOTAL_KILOAN', $subtotal);
        //                             $subtotalSatuan = (float) preg_replace('/[^0-9.\-]/', '', (string) ($get('SUBTOTAL_SATUAN') ?? 0));
        //                             $subtotalLayanan = (float) preg_replace('/[^0-9.\\-]/', '', (string) ($get('SUBTOTAL_LAYANAN') ?? 0));
        //                             $set('TOTAL_BIAYA', $subtotalSatuan + $subtotal + $subtotalLayanan);
        //                         })
        //                         ->nullable(),
        //                 Grid::make()->schema([
        //                     TextInput::make('BERAT')
        //                         ->label('Berat (kg)')
        //                         ->numeric()
        //                         ->reactive()
        //                         ->afterStateUpdated(function ($state, $set, $get) {
        //                             $price = 0;
        //                             if ($get('ID_KILOAN')) {
        //                                 $model = JenisKiloan::find($get('ID_KILOAN'));
        //                                 $price = $model ? (int) $model->HARGA : 0;
        //                             }
        //                             $subtotal = ((float) ($state ?? 0)) * $price;
        //                             $set('SUBTOTAL_KILOAN', $subtotal);
        //                             $subtotalSatuan = (float) preg_replace('/[^0-9.\-]/', '', (string) ($get('SUBTOTAL_SATUAN') ?? 0));
        //                             $set('TOTAL_BIAYA', $subtotalSatuan + $subtotal);
        //                         }),

        //                     TextInput::make('JUMLAH_ITEM')
        //                         ->label('Jumlah Item (opsional)')
        //                         ->numeric()
        //                         ->nullable(),
                            
        //                     DatePicker::make('TANGGAL_MASUK')->label('Tanggal Masuk'),
        //                     DatePicker::make('ESTIMASI_SELESAI')->label('Estimasi Selesai'),

        //                 ])->columns(2),
        //                     Textarea::make('CATATAN')->label('Catatan')->nullable(),

        //             ]),
        //         Section::make('Rincian Satuan')
        //             ->schema([
        //                 Repeater::make('SATUANS')
        //                     ->label('Layanan Satuan')
        //                     ->createItemButtonLabel('Tambah Item')
        //                     ->schema([
        //                         Grid::make()->schema([
        //                             Select::make('ID_SATUAN')
        //                                 ->label('Jenis Satuan')
        //                                 ->options(function () {
        //                                     return JenisSatuan::all()->pluck('JENIS_SATUAN', 'ID_SATUAN');
        //                                 })
        //                                 ->reactive()
        //                                 ->afterStateUpdated(function ($state, $set, $get) {
        //                                     $price = 0;
        //                                     if ($state) {
        //                                         $model = JenisSatuan::find($state);
        //                                         $price = $model ? (int) $model->HARGA : 0;
        //                                     }
        //                                     $set('HARGA', $price);
        //                                     $set('SUB_TOTAL', ((int) ($get('JUMLAH_ITEM') ?? 0)) * $price);
        //                                 }),

        //                             TextInput::make('JUMLAH_ITEM')
        //                                 ->label('Jumlah Item')
        //                                 ->numeric()
        //                                 ->reactive()
        //                                 ->afterStateUpdated(function ($state, $set, $get) {
        //                                     $price = (int) ($get('HARGA') ?? 0);
        //                                     $set('SUB_TOTAL', ((int) ($state ?? 0)) * $price);
        //                                 }),

        //                             TextInput::make('HARGA')
        //                                 ->label('Harga')
        //                                 ->numeric()
        //                                 ->disabled()
        //                                 ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),

        //                             TextInput::make('SUB_TOTAL')
        //                                 ->label('Subtotal')
        //                                 ->numeric()
        //                                 ->disabled()
        //                                 ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),
        //                         ])->columns(2),
        //                     ])
        //                     ->reactive()
        //                     ->afterStateUpdated(function ($state, $set, $get) {
        //                         $sum = 0;
        //                         if (is_array($state)) {
        //                             foreach ($state as $item) {
        //                                 if (isset($item['SUB_TOTAL'])) {
        //                                     $sum += (int) $item['SUB_TOTAL'];
        //                                 } else {
        //                                     $harga = (int) ($item['HARGA'] ?? 0);
        //                                     $jumlah = (int) ($item['JUMLAH_ITEM'] ?? 0);
        //                                     $sum += $harga * $jumlah;
        //                                 }
        //                             }
        //                         }
        //                         $set('SUBTOTAL_SATUAN', $sum);
        //                         $subtotalKiloan = (float) preg_replace('/[^0-9.\-]/', '', (string) ($get('SUBTOTAL_KILOAN') ?? 0));
        //                         $set('TOTAL_BIAYA', $subtotalKiloan + $sum);
        //                     }),
        //             ]),


        //         Section::make('Ringkasan Biaya')
        //             ->schema([
        //                 // Placeholder::make('app_name')->label('Aplikasi')->content('SILaundry'),
        //                 Select::make('STATUS')
        //                     ->label('Status')
        //                     ->options([
        //                         'Pending' => 'Pending',
        //                         'Proses' => 'Proses',
        //                         'Selesai' => 'Selesai',
        //                         'Diambil' => 'Diambil',
        //                     ])
        //                     ->required(),
        //                 TextInput::make('SUBTOTAL_KILOAN')
        //                     ->label('Subtotal Kiloan')
        //                     ->disabled()
        //                     ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),

        //                 TextInput::make('SUBTOTAL_SATUAN')
        //                     ->label('Subtotal Satuan')
        //                     ->disabled()
        //                     ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),

        //                 TextInput::make('SUBTOTAL_LAYANAN')
        //                     ->label('Subtotal Layanan')
        //                     ->disabled()
        //                     ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),

        //                 TextInput::make('TOTAL_BIAYA')
        //                     ->label('Total Biaya')
        //                     ->required()
        //                     ->disabled()
        //                     ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),
        //             ]),

        //         Section::make('Layanan Tambahan')
        //             ->schema([
        //                 Repeater::make('LAYANAN')
        //                     ->label('Layanan Tambahan')
        //                     ->createItemButtonLabel('Tambah Layanan')
        //                     ->schema([
        //                         Select::make('ID_LAYANAN')
        //                             ->label('Layanan')
        //                             ->options(function () {
        //                                 return Layanan::all()->pluck('NAMA_LAYANAN', 'ID_LAYANAN');
        //                             })
        //                             ->reactive()
        //                             ->afterStateUpdated(function ($state, $set, $get) {
        //                                 $price = 0;
        //                                 if ($state) {
        //                                     $model = Layanan::find($state);
        //                                     $price = $model ? (int) $model->HARGA : 0;
        //                                 }
        //                                 $set('HARGA', $price);
        //                                 $jumlah = (int) ($get('JUMLAH_ITEM') ?? 0);
        //                                 $berat = (float) ($get('BERAT') ?? 0);
        //                                 $sub = $jumlah > 0 ? $jumlah * $price : $berat * $price;
        //                                 $set('SUB_TOTAL', $sub);
        //                             }),

        //                         TextInput::make('JUMLAH_ITEM')
        //                             ->label('Jumlah Item')
        //                             ->numeric()
        //                             ->reactive()
        //                             ->afterStateUpdated(function ($state, $set, $get) {
        //                                 $price = (int) ($get('HARGA') ?? 0);
        //                                 $berat = (float) ($get('BERAT') ?? 0);
        //                                 $sub = ((int) ($state ?? 0)) * $price;
        //                                 if ($sub <= 0 && $berat > 0) {
        //                                     $sub = (float) $berat * $price;
        //                                 }
        //                                 $set('SUB_TOTAL', $sub);
        //                             }),

        //                         TextInput::make('BERAT')
        //                             ->label('Berat (opsional)')
        //                             ->numeric()
        //                             ->reactive()
        //                             ->afterStateUpdated(function ($state, $set, $get) {
        //                                 $price = (int) ($get('HARGA') ?? 0);
        //                                 $jumlah = (int) ($get('JUMLAH_ITEM') ?? 0);
        //                                 $sub = ((float) ($state ?? 0)) * $price;
        //                                 if ($jumlah > 0) {
        //                                     $sub = $jumlah * $price;
        //                                 }
        //                                 $set('SUB_TOTAL', $sub);
        //                             }),

        //                         TextInput::make('HARGA')
        //                             ->label('Harga')
        //                             ->numeric()
        //                             ->disabled()
        //                             ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),

        //                         TextInput::make('SUB_TOTAL')
        //                             ->label('Subtotal')
        //                             ->numeric()
        //                             ->disabled()
        //                             ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Rp 0'),
        //                     ])
        //                     ->reactive()
        //                     ->afterStateUpdated(function ($state, $set, $get) {
        //                         $sum = 0;
        //                         if (is_array($state)) {
        //                             foreach ($state as $item) {
        //                                 if (isset($item['SUB_TOTAL'])) {
        //                                     $sum += (int) $item['SUB_TOTAL'];
        //                                 } else {
        //                                     $harga = (int) ($item['HARGA'] ?? 0);
        //                                     $jumlah = (int) ($item['JUMLAH_ITEM'] ?? 0);
        //                                     $berat = (float) ($item['BERAT'] ?? 0);
        //                                     $sum += ($jumlah > 0) ? $harga * $jumlah : $berat * $harga;
        //                                 }
        //                             }
        //                         }
        //                         $set('SUBTOTAL_LAYANAN', $sum);
        //                         $subtotalKiloan = (float) preg_replace('/[^0-9.\\-]/', '', (string) ($get('SUBTOTAL_KILOAN') ?? 0));
        //                         $subtotalSatuan = (float) preg_replace('/[^0-9.\\-]/', '', (string) ($get('SUBTOTAL_SATUAN') ?? 0));
        //                         $set('TOTAL_BIAYA', $subtotalKiloan + $subtotalSatuan + $sum);
        //                     }),
        //             ]),
        //     ]);
            return $schema->components([
            Section::make('Informasi Dasar')
                ->schema([
                    TextInput::make('ID_PESANAN')->label('ID Pesanan')->required()->maxLength(6),
                    Select::make('ID_PELANGGAN')->label('Pelanggan')->relationship('pelanggan', 'NAMA_PELANGGAN')->searchable()->preload()->required(),
                    Select::make('ID_ADMIN')->label('Admin')->relationship('admin', 'NAMA_ADMIN')->searchable()->preload()->required(),
                    Select::make('ID_KURIR')->label('Kurir')->relationship('kurir', 'NAMA_KURIR')->searchable()->preload()->nullable(),
                    DatePicker::make('TANGGAL_MASUK')->label('Tanggal Masuk'),
                    DatePicker::make('ESTIMASI_SELESAI')->label('Estimasi Selesai'),
                    TextInput::make('JUMLAH_ITEM')->label('Jumlah Item')->numeric()->nullable(),
                    TextInput::make('BERAT')->label('Berat (kg)')->numeric()->nullable(),
                    Select::make('STATUS')
                            ->label('Status')
                            ->options([
                                'Pending' => 'Pending',
                                'Proses' => 'Proses',
                                'Selesai' => 'Selesai',
                                'Diambil' => 'Diambil',
                            ])
                            ->required()
                            ->nullable(),
                    TextInput::make('TOTAL_BIAYA')->label('Total Biaya')->numeric()->nullable(),
                    Textarea::make('CATATAN')->label('Catatan')->nullable(),
                ]),
        ]);
    }
}