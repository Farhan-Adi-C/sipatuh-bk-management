<?php

namespace App\Filament\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Carbon\Carbon;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class SiswaImporter extends Importer
{
    protected static ?string $model = Siswa::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Nama')
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->examples(["Budi", "Andi", "Rina"]),

            ImportColumn::make('nisn')
                ->requiredMapping()
                ->rules(['required', 'numeric', 'digits_between:1,10'])
                ->examples([2026000001, 2026000002, 2026000003]),


            ImportColumn::make('gender')
                ->requiredMapping()
                ->rules(['required', 'in:L,P'])
                ->examples(["L", "L", "P"]),

            ImportColumn::make('agama')
                ->rules(['nullable', 'max:50'])
                ->examples(["Islam", "Islam", "Kristen"]),
            ImportColumn::make('kelas')
                ->requiredMapping()
                ->rules(['required', 'max:255'])
                ->examples(["VII A", "VII B", "VII C"])
                // Cegah Filament mengisi kolom "kelas" langsung ke model,
                // karena tabel siswas hanya punya kolom kelas_id.
                ->fillRecordUsing(function (Siswa $record, string $state) {
                    // sengaja dikosongkan, resolusi dilakukan di resolveRecord()
                }),

        ];
    }

    // Cegah duplikat: kalau nisn sudah ada, update. Kalau belum, buat baru.
    public function resolveRecord(): ?Siswa
    {
        $siswa = Siswa::firstOrNew([
            'nisn' => $this->data['nisn'],
        ]);

        $kelasName = trim($this->data['kelas']);

        $kelas = Kelas::firstOrCreate([
            'name' => $kelasName,
        ]);

        $siswa->kelas_id = $kelas->id;
        

        return $siswa;
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import data siswa selesai, ' . number_format($import->successful_rows) . ' baris berhasil diimport.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' baris gagal diimport.';
        }

        return $body;
    }
}
