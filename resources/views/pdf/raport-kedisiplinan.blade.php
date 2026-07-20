<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 25px 35px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #111;
        }
        .page {
            page-break-after: always;
        }
        .page:last-child {
            page-break-after: auto;
        }
        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .subtitle {
            text-align: center;
            font-size: 13px;
            margin-bottom: 14px;
            padding-bottom: 14px;
            border-bottom: 1.5px solid #333;
        }
        table.identitas {
            width: 100%;
            margin-bottom: 18px;
            border: 1px solid #333;
        }
        table.identitas td {
            padding: 5px 8px;
            font-size: 13px;
            vertical-align: top;
            border-bottom: 1px solid #ddd;
        }
        table.identitas tr:last-child td {
            border-bottom: none;
        }
        .label { width: 70px; color: #555; }
        .sep { width: 15px; }

        /* =====================================================
           Dua kolom (Pelanggaran | Reward) memakai FLOAT, BUKAN
           tabel bersarang (nested table di dalam <td>) seperti
           sebelumnya. Nested table adalah penyebab bug tidak
           sejajar: DomPDF menghitung tinggi baris wrapper
           mengikuti kolom yang paling tinggi, dan saat isi kedua
           tabel timpang jauh (satu banyak baris, satu kosong),
           layout jadi pecah/tidak sejajar terutama saat ganti
           halaman. Dengan float, tiap tabel berdiri sendiri,
           lebar tetap 49%, tetap sejajar di baris atas yang
           sama, tapi tidak saling mempengaruhi tinggi satu sama
           lain.
        ===================================================== */
        .wrapper {
            width: 100%;
        }
        .wrapper::after {
            content: "";
            display: block;
            clear: both;
        }
        .wrapper .col {
            width: 49%;
            float: left;
        }
        .wrapper .col:last-child {
            width: 49%;
            float: right;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }
        table.data th, table.data td {
            border: 1px solid #333;
            padding: 6px 6px;
            font-size: 11px;
            text-align: left;
        }
        table.data th {
            background-color: #eee;
            text-align: center;
        }
        tr.table-title th {
            background-color: #333;
            color: #fff;
            text-align: left;
            font-size: 12px;
            padding: 7px 8px;
        }
        table.data td.center { text-align: center; }
        table.data td.no { text-align: center; width: 22px; }
        table.data td.tanggal { width: 65px; }
        table.data td.poin { text-align: center; width: 32px; }
        table.data th.no { width: 22px; }
        table.data th.tanggal { width: 65px; }
        table.data th.poin { width: 32px; }

        tr.total td {
            font-weight: bold;
            text-align: right;
        }
        tr.total td.poin {
            text-align: center;
        }
    </style>
</head>
<body>

@foreach ($siswas as $siswa)
    @php
        $pelanggarans = $siswa->pelanggarans ?? collect();
        $rewards = $siswa->rewards ?? collect();
        $totalPoinPelanggaran = $pelanggarans->sum(fn ($p) => $p->jenis_pelanggaran->poin ?? 0);
        $totalPoinReward = $rewards->sum(fn ($r) => $r->jenis_reward->poin ?? 0);
    @endphp

    <div class="page">
        <div class="title"><img src="{{ public_path("logo.png") }}" width="200" alt=""></div>
        <div class="subtitle">SMP Negeri 3 Tuntang</div>

        <table class="identitas">
            <tr>
                <td class="label">Nama</td>
                <td class="sep">:</td>
                <td><strong>{{ $siswa->name }}</strong></td>
                <td class="label">NISN</td>
                <td class="sep">:</td>
                <td><strong>{{ $siswa->nisn }}</strong></td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td class="sep">:</td>
                <td><strong>{{ $siswa->kelas->name ?? '-' }}</strong></td>
                <td class="label">Agama</td>
                <td class="sep">:</td>
                <td><strong>{{ $siswa->agama ?? '-' }}</strong></td>
            </tr>
        </table>

        <div class="wrapper gap-3" >
            <div class="col">
                <table class="data">
                    <thead>
                        <tr class="table-title"><th colspan="4" style="text-align: center">Data Pelanggaran</th></tr>
                        <tr>
                            <th class="no">No</th>
                            <th class="tanggal">Tanggal</th>
                            <th>Jenis Pelanggaran</th>
                            <th class="poin">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggarans as $i => $p)
                            <tr>
                                <td class="no">{{ $i + 1 }}</td>
                                <td class="tanggal" style="text-align: center;">{{ $p->tanggal_pelanggaran ?? "-" }}</td>
                                <td>{{ $p->jenis_pelanggaran->nama_pelanggaran ?? '-' }}</td>
                                <td class="poin">{{ $p->jenis_pelanggaran->poin ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="center">Tidak ada data pelanggaran</td>
                            </tr>
                        @endforelse
                        <tr class="total">
                            <td colspan="3" style="text-align: start;">Total Poin:</td>
                            <td class="poin">{{ $totalPoinPelanggaran }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col">
                <table class="data">
                    <thead>
                        <tr class="table-title"><th colspan="4" style="text-align: center">Data Reward</th></tr>
                        <tr>
                            <th class="no">No</th>
                            <th class="tanggal">Tanggal</th>
                            <th>Jenis Reward</th>
                            <th class="poin">Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rewards as $i => $r)
                            <tr>
                                <td class="no">{{ $i + 1 }}</td>
                                <td class="tanggal text-center" style="text-align: center">{{ $r->tanggal_reward ?? "-" }}</td>
                                <td>{{ $r->jenis_reward->nama_reward ?? '-' }}</td>
                                <td class="poin">{{ $r->jenis_reward->poin ?? 0 }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="center">Tidak ada data reward</td>
                            </tr>
                        @endforelse
                        <tr class="total">
                            <td colspan="3">Total Poin:</td>
                            <td class="poin">{{ $totalPoinReward }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach

</body>
</html>