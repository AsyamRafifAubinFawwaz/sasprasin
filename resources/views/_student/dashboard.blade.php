@extends('_student._layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">

    {{-- TOTAL --}}
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
        <div class="p-4 md:p-5">
            <p class="text-xs uppercase text-gray-500">Total Aspirasi</p>
            <h3 class="text-xl sm:text-2xl font-medium mt-1">
                {{ $stats->total ?? 0 }}
            </h3>
        </div>
    </div>

    {{-- DIPROSES --}}
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
        <div class="p-4 md:p-5">
            <p class="text-xs uppercase text-gray-500">Sedang Diproses</p>
            <h3 class="text-xl sm:text-2xl font-medium mt-1">
                {{ ($stats->pending ?? 0) + ($stats->in_progress ?? 0) }}
            </h3>
        </div>
    </div>

    {{-- SELESAI --}}
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
        <div class="p-4 md:p-5">
            <p class="text-xs uppercase text-gray-500">Selesai</p>
            <h3 class="text-xl sm:text-2xl font-medium mt-1">
                {{ $stats->done ?? 0 }}
            </h3>
        </div>
    </div>

    {{-- DITOLAK --}}
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl">
        <div class="p-4 md:p-5">
            <p class="text-xs uppercase text-gray-500">Ditolak</p>
            <h3 class="text-xl sm:text-2xl font-medium mt-1">
                {{ $stats->rejected ?? 0 }}
            </h3>
        </div>
    </div>

</div>

{{-- CHART --}}
<div class="mt-6 bg-white border border-gray-200 rounded-xl p-4">
    <h3 class="text-lg font-semibold mb-3">Jumlah Laporan per Bulan</h3>
    <div id="hs-multiple-bar-charts"></div>
</div>

{{-- TABEL TERBARU --}}
<div class="mt-6 bg-white border border-gray-200 rounded-xl p-4">
    <h3 class="text-lg font-semibold mb-3">Laporan Terbaru Kamu</h3>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Tanggal</th>
                    <th class="text-left p-2">Lokasi</th>
                    <th class="text-left p-2">Fasilitas</th>
                    <th class="text-left p-2">Status</th>
                    <th class="text-left p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latest ?? [] as $item)
                    <tr class="border-b">
                        <td class="p-2">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                        </td>
                        <td class="p-2">{{ $item->location }}</td>
                        <td class="p-2">{{ $item->facility_category_name }}</td>
                        <td class="p-2">
                            @if ($item->status == \App\Constants\ProgressConst::PENDING)
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">
                                    Pending
                                </span>
                            @elseif ($item->status == \App\Constants\ProgressConst::IN_PROGRESS)
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                                    Diproses
                                </span>
                            @elseif ($item->status == \App\Constants\ProgressConst::DONE)
                                <span class="bg-teal-100 text-teal-800 px-2 py-1 rounded text-xs">
                                    Selesai
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">
                                    Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="p-2">
                            <a navigate href="{{ route('student.complaints.detail', $item->id) }}"
                               class="text-blue-600 text-sm">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            Belum ada laporan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
window.addEventListener("load", () => {
    let categories = @json($chart['categories'] ?? []);
    let seriesData = @json($chart['series'] ?? []);

    if (!categories.length) {
        categories = ["Data belum tersedia"];
        seriesData = [0];
    }

    var options = {
        chart: {
            type: "bar",
            height: 300,
            toolbar: { show: false }
        },
        series: [{
            name: "Jumlah Laporan",
            data: seriesData
        }],
        plotOptions: {
            bar: {
                columnWidth: "16px",
                borderRadius: 4,
            },
        },
        xaxis: {
            categories: categories,
        },
        yaxis: {
            min: 0,
            forceNiceScale: true,
            labels: {
                formatter: (val) => Math.floor(val)
            }
        }
    };

    var chart = new ApexCharts(
        document.querySelector("#hs-multiple-bar-charts"),
        options
    );
    chart.render();
});
</script>

@endsection
