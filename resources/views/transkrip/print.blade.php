<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai - {{ $mahasiswa->user->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .logo {
            max-width: 80px;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 18px;
            margin: 5px 0;
        }
        .student-info {
            margin-bottom: 20px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .semester-section {
            margin-bottom: 30px;
        }
        h2 {
            font-size: 16px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f2f2f2;
        }
        .summary {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .signature {
            margin-top: 50px;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
        .signature-box {
            text-align: center;
        }
        .sign-line {
            margin-top: 50px;
            border-bottom: 1px solid #000;
            width: 80%;
            margin: 50px auto 10px;
        }
        @media print {
            body {
                padding: 0;
                margin: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print();" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Cetak Transkrip
        </button>
    </div>

    <div class="header">
        <h1>TRANSKRIP NILAI AKADEMIK</h1>
        <h1>UNIVERSITAS TEKNOLOGI DIGITAL</h1>
    </div>

    <div class="student-info">
        <div class="info-grid">
            <div>
                <strong>Nama:</strong> {{ $mahasiswa->user->name }}
            </div>
            <div>
                <strong>NIM:</strong> {{ $mahasiswa->nim }}
            </div>
            <div>
                <strong>Program Studi:</strong> {{ $mahasiswa->prodi->nama_prodi }}
            </div>
            <div>
                <strong>Jurusan:</strong> {{ $mahasiswa->jurusan->nama_jurusan }}
            </div>
        </div>
    </div>

    @foreach($transcriptData as $transcript)
    <div class="semester-section">
        <h2>Semester {{ ucfirst($transcript['semester']) }} {{ $transcript['tahun_ajaran'] }}</h2>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Kode MK</th>
                    <th width="40%">Mata Kuliah</th>
                    <th width="10%">SKS</th>
                    <th width="15%">Nilai Angka</th>
                    <th width="15%">Nilai Huruf</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSks = 0; @endphp
                @foreach($transcript['mataKuliah'] as $index => $krs)
                    @php $totalSks += $krs->kelas->mataKuliah->sks; @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $krs->kelas->mataKuliah->kode_mk }}</td>
                        <td>{{ $krs->kelas->mataKuliah->nama_mk }}</td>
                        <td>{{ $krs->kelas->mataKuliah->sks }}</td>
                        <td>{{ $krs->nilai->nilai_angka }}</td>
                        <td>{{ $krs->nilai->nilai_huruf }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="right"><strong>Total SKS:</strong></td>
                    <td><strong>{{ $totalSks }}</strong></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="3" align="right"><strong>IP Semester:</strong></td>
                    <td colspan="3"><strong>{{ number_format($transcript['ip'], 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endforeach

<div class="summary">
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <div>
            <strong>Total SKS Lulus:</strong> {{ $totalSks }}
        </div>
        <div>
            <strong>IPK:</strong> {{ number_format($ipk, 2) }}
        </div>
    </div>
</div>

    <div class="signature">
        <div></div>
        <div class="signature-box">
            <div>Jakarta, {{ date('d F Y') }}</div>
            <div>Kepala Program Studi</div>
            <div class="sign-line"></div>
            <div>Dr. Nama Kaprodi</div>
        </div>
    </div>
</body>
</html>
