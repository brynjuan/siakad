<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai - {{ $mahasiswa->user->name }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: #f6f8fa;
        }
        .container {
            max-width: 900px;
            margin: 30px auto 30px auto;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08), 0 1.5px 4px rgba(0,0,0,0.04);
            padding: 32px 36px 36px 36px;
        }
        .header {
            text-align: center;
            margin-bottom: 32px;
            border-bottom: 3px solid #1e293b;
            padding-bottom: 18px;
            background: linear-gradient(90deg, #1e293b 0%, #3b82f6 100%);
            color: #fff;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 2px 8px rgba(30,41,59,0.07);
        }
        .logo {
            max-width: 80px;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 22px;
            margin: 6px 0;
            letter-spacing: 1px;
            font-weight: 700;
        }
        .student-info {
            margin-bottom: 28px;
            background: #f1f5f9;
            border-radius: 8px;
            padding: 18px 20px;
            box-shadow: 0 1px 4px rgba(59,130,246,0.06);
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px 30px;
        }
        .info-grid div {
            font-size: 15px;
            color: #1e293b;
        }
        .semester-section {
            margin-bottom: 32px;
            background: #f9fafb;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(30,41,59,0.04);
            padding: 18px 18px 10px 18px;
        }
        h2 {
            font-size: 17px;
            margin-bottom: 12px;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 6px;
            color: #2563eb;
            font-weight: 600;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(30,41,59,0.04);
        }
        th, td {
            border: none;
            padding: 10px 8px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background: #e0e7ef;
            color: #1e293b;
            font-weight: 600;
            border-bottom: 2px solid #3b82f6;
        }
        tr:not(:last-child) td {
            border-bottom: 1px solid #e5e7eb;
        }
        tr:hover td {
            background: #f1f5f9;
        }
        .summary {
            margin-top: 36px;
            border-top: 2px solid #3b82f6;
            padding-top: 18px;
            background: #f1f5f9;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 1px 4px rgba(59,130,246,0.04);
        }
        .summary strong {
            color: #1e293b;
        }
        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            text-align: center;
            min-width: 260px;
        }
        .sign-line {
            margin-top: 60px;
            border-bottom: 1.5px solid #1e293b;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 12px;
        }
        .no-print {
            margin-bottom: 24px;
            text-align: right;
        }
        .print-btn {
            padding: 10px 22px;
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(59,130,246,0.08);
            transition: background 0.2s;
        }
        .print-btn:hover {
            background: linear-gradient(90deg, #1e40af 0%, #2563eb 100%);
        }
        @media print {
            body {
                padding: 0;
                margin: 0;
                background: #fff;
            }
            .container {
                box-shadow: none;
                padding: 0;
                margin: 0;
                background: #fff;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print();" class="print-btn">
            Cetak Transkrip
        </button>
    </div>
    <div class="container">
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
            <div class="signature-box">
                <div>Jakarta, {{ date('d F Y') }}</div>
                <div>Kepala Program Studi</div>
                <div class="sign-line"></div>
                <div>Dr. Nama Kaprodi</div>
            </div>
        </div>
    </div>
</body>
</html>
