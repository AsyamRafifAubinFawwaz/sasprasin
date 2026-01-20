<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aspirasi Sarpras</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #ff7d26;
            padding-bottom: 15px;
        }

        .header h1 {
            color: #ff7d26;
            font-size: 20px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 11px;
        }

        .filter-info {
            background-color: #fff4ed;
            border-left: 4px solid #ff7d26;
            padding: 10px;
            margin-bottom: 15px;
        }

        .filter-info h3 {
            color: #ff7d26;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .filter-info p {
            font-size: 9px;
            color: #666;
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background-color: #ff7d26;
            color: white;
        }

        table th {
            padding: 8px 5px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
        }

        table td {
            padding: 8px 5px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9px;
            vertical-align: top;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        table tbody tr:hover {
            background-color: #fff4ed;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-progress {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-done {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-low {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-medium {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-high {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .image-cell {
            text-align: center;
        }

        .image-cell img {
            max-width: 60px;
            max-height: 60px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 8px;
            color: #999;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }

        .no-data {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN ASPIRASI SARANA DAN PRASARANA</h1>
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>

    @if(!empty($filters['export_all']) || !empty($filters['status']) || !empty($filters['priority']) || !empty($filters['search']) || !empty($filters['date']) || !empty($filters['start_date']))
        <div class="filter-info">
            <h3>Filter yang Diterapkan:</h3>
            @if(!empty($filters['export_all']))
                <p><strong>Cakupan Data:</strong> Keseluruhan Data (Tanpa Filter)</p>
            @else
                @if(!empty($filters['status']))
                    <p><strong>Status:</strong>
                        @if($filters['status'] == 1) Pending
                        @elseif($filters['status'] == 2) Dalam Progress
                        @elseif($filters['status'] == 3) Selesai
                        @endif
                    </p>
                @endif
                @if(!empty($filters['priority']))
                    <p><strong>Prioritas:</strong>
                        @if($filters['priority'] == 1) Rendah
                        @elseif($filters['priority'] == 2) Sedang
                        @elseif($filters['priority'] == 3) Tinggi
                        @endif
                    </p>
                @endif
                @if(!empty($filters['search']))
                    <p><strong>Pencarian:</strong> {{ $filters['search'] }}</p>
                @endif
                @if(!empty($filters['date']))
                    <p><strong>Tanggal:</strong> {{ date('d F Y', strtotime($filters['date'])) }}</p>
                @endif
                @if(!empty($filters['start_date']))
                    <p><strong>Rentang Tanggal:</strong>
                        {{ date('d/m/Y', strtotime($filters['start_date'])) }}
                        @if(!empty($filters['end_date']))
                            s/d {{ date('d/m/Y', strtotime($filters['end_date'])) }}
                        @endif
                    </p>
                @endif
            @endif
        </div>
    @endif

    @if(count($data) > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 12%;">Nama Siswa</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 8%;">Gambar</th>
                    <th style="width: 12%;">Lokasi</th>
                    <th style="width: 10%;">Kategori</th>
                    <th style="width: 7%;">Prioritas</th>
                    <th style="width: 25%;">Deskripsi</th>
                    <th style="width: 8%;">Status</th>
                    <th style="width: 15%;">Feedback</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->student_name ?? 'N/A' }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                        <td class="image-cell">
                            @if($item->image)
                                <img src="{{ public_path('storage/' . $item->image) }}" alt="Gambar">
                            @else
                                <span style="color: #999; font-size: 8px;">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>{{ $item->location }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>
                            @if($item->priority == 1)
                                <span class="badge badge-low">Rendah</span>
                            @elseif($item->priority == 2)
                                <span class="badge badge-medium">Sedang</span>
                            @elseif($item->priority == 3)
                                <span class="badge badge-high">Tinggi</span>
                            @endif
                        </td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @php
                                $status = $item->status ?? 1;
                            @endphp
                            @if($status == 1)
                                <span class="badge badge-pending">Pending</span>
                            @elseif($status == 2)
                                <span class="badge badge-progress">Progress</span>
                            @elseif($status == 3)
                                <span class="badge badge-done">Selesai</span>
                            @endif
                        </td>
                        <td>{{ $item->feedback ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 10px; font-size: 9px; color: #666;">
            <strong>Total Data:</strong> {{ count($data) }} laporan
        </div>
    @else
        <div class="no-data">
            Tidak ada data aspirasi yang ditemukan.
        </div>
    @endif

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh Sistem Informasi Sarana dan Prasarana</p>
    </div>
</body>

</html>