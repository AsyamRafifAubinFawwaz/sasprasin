@extends('_admin._layout.app')

@section('title', 'Dashboard Petugas')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800 dark:text-neutral-200">
            Selamat Datang, {{ Auth::user()->name }}
        </h1>
        <p class="text-gray-500 dark:text-neutral-400 mt-1">
            Senang melihat Anda kembali. Berikut adalah ringkasan tugas pengaduan Anda hari ini.
        </p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase text-gray-400 dark:text-neutral-500 tracking-wider">
                            Total Tugas
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-neutral-200">
                                {{ number_format($stats['totals']->total ?? 0) }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-blue-100 text-blue-600 rounded-lg dark:bg-blue-500/10 dark:text-blue-500">
                        @include('_admin._layout.icons.sidebar.task')
                    </div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase text-gray-400 dark:text-neutral-500 tracking-wider">
                            Pending
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-neutral-200">
                                {{ number_format($stats['totals']->pending ?? 0) }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-amber-100 text-amber-600 rounded-lg dark:bg-amber-500/10 dark:text-amber-500">
                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase text-gray-400 dark:text-neutral-500 tracking-wider">
                            In Progress
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-neutral-200">
                                {{ number_format($stats['totals']->in_progress ?? 0) }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-blue-100 text-blue-600 rounded-lg dark:bg-blue-500/10 dark:text-blue-500">
                        @include('_admin._layout.icons.pickaxe')
                    </div>
                </div>
            </div>
        </div>

        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase text-gray-400 dark:text-neutral-500 tracking-wider">
                            Selesai
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-neutral-200">
                                {{ number_format($stats['totals']->done ?? 0) }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-emerald-100 text-emerald-600 rounded-lg dark:bg-emerald-500/10 dark:text-emerald-500">
                        @include('_admin._layout.icons.sidebar.circle-check-big')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:gap-6 mt-6">
        <div
            class="p-4 md:p-5 min-h-[400px] flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">Statistik Penugasan</h2>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">
                        Data tugas masuk dalam
                        {{ $range == '1_year' ? '1 tahun' : ($range == '30_days' ? '1 bulan' : '12 hari') }} terakhir
                    </p>
                </div>

                <div class="inline-flex rounded-lg shadow-sm">
                    <a href="{{ route('toolsman.dashboard', ['range' => '1_year']) }}" navigate
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-s-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 {{ $range == '1_year' ? 'bg-gray-100 dark:bg-neutral-800 ring-1 ring-gray-200 dark:ring-neutral-700' : '' }}">
                        Last 1 year
                    </a>
                    <a href="{{ route('toolsman.dashboard', ['range' => '30_days']) }}" navigate
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium border-t border-b border-gray-200 bg-white text-gray-800 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 {{ $range == '30_days' ? 'bg-gray-100 dark:bg-neutral-800 ring-1 ring-gray-200 dark:ring-neutral-700' : '' }}">
                        Last 30 days
                    </a>
                    <a href="{{ route('toolsman.dashboard', ['range' => '12_days']) }}" navigate
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-e-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 {{ $range == '12_days' ? 'bg-gray-100 dark:bg-neutral-800 ring-1 ring-gray-200 dark:ring-neutral-700' : '' }}">
                        Last 12 days
                    </a>
                </div>
            </div>

            <div id="hs-single-area-chart"></div>

            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-neutral-700">
                <div class="flex items-center gap-x-4">
                    <div class="inline-flex items-center">
                        <span class="size-3 inline-block bg-[#ff7d26] rounded-full me-2"></span>
                        <span class="text-sm text-gray-600 dark:text-neutral-400 font-medium">
                            Tugas Diterima
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-6">
        <div
            class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <div class="min-w-full inline-block align-middle">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                                Aspirasi Terbaru
                            </h2>
                            <p class="text-sm text-gray-500 dark:text-neutral-400">
                                Daftar tugas aspirasi terakhir yang ditugaskan kepada Anda.
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <a navigate
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-bold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 transition-all active:scale-95 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800"
                                    href="{{ route('toolsman.aspirations.index') }}">
                                    View all
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-800/50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <span
                                        class="text-[10px] font-black uppercase text-gray-400 dark:text-neutral-500 tracking-widest">
                                        No
                                    </span>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <span
                                        class="text-[10px] font-black uppercase text-gray-400 dark:text-neutral-500 tracking-widest">
                                        Siswa
                                    </span>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <span
                                        class="text-[10px] font-black uppercase text-gray-400 dark:text-neutral-500 tracking-widest">
                                        Kategori
                                    </span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-start">
                                    <span
                                        class="text-[10px] font-black uppercase text-gray-400 dark:text-neutral-500 tracking-widest">
                                        Lokasi
                                    </span>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <span
                                        class="text-[10px] font-black uppercase text-gray-400 dark:text-neutral-500 tracking-widest">
                                        Prioritas
                                    </span>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <span
                                        class="text-[10px] font-black uppercase text-gray-400 dark:text-neutral-500 tracking-widest">
                                        Status
                                    </span>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <span
                                        class="text-[10px] font-black uppercase text-gray-400 dark:text-neutral-500 tracking-widest">
                                        Tanggal
                                    </span>
                                </th>

                                <th scope="col" class="px-6 py-3 text-end"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700 font-medium">
                            @forelse ($stats['latest'] as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-900/40 transition-colors">
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="text-sm text-gray-800 dark:text-neutral-200 font-bold">{{ ($stats['latest']->currentPage() - 1) * $stats['latest']->perPage() + $loop->iteration }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                {{ $item->student_name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="h-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span
                                                class="block text-sm font-bold text-gray-800 dark:text-neutral-200 uppercase tracking-tight">
                                                {{ $item->category_name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                {{ $item->location }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            @if ($item->priority == \App\Constants\PriorityConst::HIGH)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500 uppercase">
                                                    High
                                                </span>
                                            @elseif($item->priority == \App\Constants\PriorityConst::MEDIUM)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500 uppercase">
                                                    Medium
                                                </span>
                                            @elseif($item->priority == \App\Constants\PriorityConst::LOW)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-[10px] font-black bg-gray-100 text-gray-800 dark:bg-neutral-800/30 dark:text-neutral-500 uppercase">
                                                    Low
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            @if ($item->status == \App\Constants\ProgressConst::PENDING)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">
                                                    <span class="size-1.5 rounded-full bg-amber-500"></span>
                                                    Pending
                                                </span>
                                            @elseif($item->status == \App\Constants\ProgressConst::IN_PROGRESS)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                    <span class="size-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                                    In Progress
                                                </span>
                                            @elseif($item->status == \App\Constants\ProgressConst::DONE)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-500">
                                                    <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                    Done
                                                </span>
                                            @elseif($item->status == \App\Constants\ProgressConst::REJECT)
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                                    <span class="size-1.5 rounded-full bg-red-500"></span>
                                                    Reject
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-400 dark:text-neutral-500">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M, H:i') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap text-end px-6">
                                        <a href="{{ route('toolsman.aspirations.detail', $item->id) }}" navigate
                                            class="py-2.5 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-bold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition-all active:scale-95 dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500 dark:text-neutral-500">
                                        <div class="flex flex-col items-center justify-center gap-2">
                                            <svg class="size-12 text-gray-200 dark:text-neutral-800"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                            </svg>
                                            <p class="text-gray-400 font-semibold tracking-tight">Tidak ada aspirasi yang
                                                ditugaskan kepada Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($stats['latest']->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100 dark:border-neutral-700">
                            <div class="flex justify-end">
                                {{ $stats['latest']->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

    <script>
        (function() {
            const chartId = "#hs-single-area-chart";
            const container = document.querySelector(chartId);

            if (!container || container.dataset.chartInitialized) return;
            container.dataset.chartInitialized = "true";
            container.innerHTML = '';

            const categories = {!! json_encode($stats['chart']['categories'] ?? []) !!};
            const seriesData = {!! json_encode($stats['chart']['series'] ?? []) !!};

            buildChart(
                chartId,
                (mode) => ({
                    chart: {
                        height: 300,
                        type: "area",
                        toolbar: {
                            show: false,
                        },
                        zoom: {
                            enabled: false,
                        },
                    },
                    series: [{
                        name: "Tugas Masuk",
                        data: seriesData,
                    }],
                    legend: {
                        show: false,
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        curve: "straight",
                        width: 2,
                    },
                    grid: {
                        strokeDashArray: 2,
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            type: "vertical",
                            shadeIntensity: 0,
                            opacityFrom: 0.4,
                            opacityTo: 0.1,
                            stops: [0, 100],
                        },
                    },
                    xaxis: {
                        type: "category",
                        tickPlacement: "on",
                        categories: categories,
                        tickAmount: 10, // Limit number of visible labels
                        hideOverlappingLabels: true,
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        crosshairs: {
                            stroke: {
                                dashArray: 0,
                            },
                            dropShadow: {
                                show: false,
                            },
                        },
                        tooltip: {
                            enabled: false,
                        },
                        labels: {
                            rotate: 0,
                            rotateAlways: false,
                            style: {
                                colors: mode === 'dark' ? "#a3a3a3" : "#9ca3af",
                                fontSize: "12px",
                                // fontFamily: "Inter, ui-sans-serif",
                                fontWeight: 400,
                            },
                            formatter: (title) => {
                                if (!title || typeof title !== 'string') return title;
                                const parts = title.split(' ');
                                if (parts.length === 3) {
                                    return `${parts[0]} ${parts[1]}`;
                                }
                                return title;
                            },
                        },
                    },
                    yaxis: {
                        labels: {
                            align: "left",
                            minWidth: 0,
                            maxWidth: 140,
                            style: {
                                colors: mode === 'dark' ? "#a3a3a3" : "#9ca3af",
                                fontSize: "13px",
                                fontFamily: "Inter, ui-sans-serif",
                                fontWeight: 400,
                            },
                            formatter: (value) => Math.floor(value),
                        },
                    },
                    tooltip: {
                        x: {
                            show: false,
                        },
                        y: {
                            formatter: (value) => `${Math.floor(value)} Tugas`
                        },
                        marker: {
                            show: false
                        },
                        custom: function(props) {
                            const {
                                categories
                            } = props.ctx.opts.xaxis;
                            const {
                                dataPointIndex,
                                series,
                                seriesIndex
                            } = props;
                            const titleStr = categories[dataPointIndex];
                            const value = series[seriesIndex][dataPointIndex];

                            const bgColor = mode === 'dark' ? '#262626' : '#ffffff';
                            const textColor = mode === 'dark' ? '#f5f5f5' : '#1f2937';
                            const secondaryTextColor = mode === 'dark' ? '#a3a3a3' : '#6b7280';
                            const borderColor = mode === 'dark' ? '#404040' : '#e5e7eb';

                            return `
                                 <div style="background: ${bgColor}; border: 1px solid ${borderColor}; border-radius: 8px; padding: 10px 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); min-width: 140px;">
                                     <div style="font-size: 14px; font-weight: 700; color: ${textColor}; margin-bottom: 4px;">
                                         ${Math.floor(value)} Tugas Masuk
                                     </div>
                                     <div style="font-size: 12px; color: ${secondaryTextColor}; font-weight: 400;">
                                         ${titleStr}
                                     </div>
                                 </div>
                             `;
                        }
                    }
                }), {
                    colors: ["#ff7d26"],
                    grid: {
                        borderColor: "#e5e7eb",
                    },
                }, {
                    colors: ["#ff7d26"],
                    grid: {
                        borderColor: "#404040",
                    },
                }
            );
        })();
    </script>
@endsection
