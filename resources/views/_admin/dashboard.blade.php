@extends('_admin._layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                            Total Keluhan
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
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
                        <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                            Pending
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                {{ number_format($stats['totals']->pending ?? 0) }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-red-100 text-red-600 rounded-lg dark:bg-red-500/10 dark:text-red-500">
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
                        <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                            In Progress
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                {{ number_format($stats['totals']->in_progress ?? 0) }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-yellow-100 text-yellow-600 rounded-lg dark:bg-yellow-500/10 dark:text-yellow-500">
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
                        <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                            Selesai
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                {{ number_format($stats['totals']->done ?? 0) }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-green-100 text-green-600 rounded-lg dark:bg-green-500/10 dark:text-green-500">
                        @include('_admin._layout.icons.sidebar.circle-check-big')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:gap-6">
        <div
            class="p-4 md:p-5 min-h-[400px] flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-800 dark:text-neutral-200">Total Laporan</h1>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">
                        Total laporan untuk
                        {{ $range == '1_year' ? '1 tahun' : ($range == '30_days' ? '1 bulan' : '12 hari') }} terakhir
                    </p>
                </div>

                <div class="inline-flex rounded-lg shadow-sm">
                    <a href="{{ route('admin.dashboard', ['range' => '1_year']) }}" navigate
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-s-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 {{ $range == '1_year' ? 'bg-gray-100 dark:bg-neutral-800 ring-1 ring-gray-200 dark:ring-neutral-700' : '' }}">
                        Last 1 year
                    </a>
                    <a href="{{ route('admin.dashboard', ['range' => '30_days']) }}" navigate
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium border-t border-b border-gray-200 bg-white text-gray-800 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 {{ $range == '30_days' ? 'bg-gray-100 dark:bg-neutral-800 ring-1 ring-gray-200 dark:ring-neutral-700' : '' }}">
                        Last 30 days
                    </a>
                    <a href="{{ route('admin.dashboard', ['range' => '12_days']) }}" navigate
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
                        <span class="text-sm text-gray-600 dark:text-neutral-400">
                            Total Laporan ({{ str_replace('_', ' ', $range) }})
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div
            class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <div class="min-w-full inline-block align-middle">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                Aspirasi Terbaru
                            </h2>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                Daftar aspirasi terakhir yang masuk.
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    href="{{ route('admin.aspirations.index') }}">
                                    View all
                                </a>

                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#ff7d26] text-white hover:bg-[#ff6702] focus:outline-hidden focus:bg-[#ff7d26] disabled:opacity-50 disabled:pointer-events-none"
                                    href="#">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="M12 5v14" />
                                    </svg>
                                    Add user
                                </a>
                            </div>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-800">
                            <tr>
                                <th scope="col" class="ps-6 py-3 text-start">
                                    <label for="hs-at-with-checkboxes-main" class="flex">
                                        <input type="checkbox"
                                            class="shrink-0 border-gray-300 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                            id="hs-at-with-checkboxes-main">
                                        <span class="sr-only">Checkbox</span>
                                    </label>
                                </th>

                                <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Siswa
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Kategori & Lokasi
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Status
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-start">
                                    <div class="flex items-center gap-x-2">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Tanggal
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-3 text-end"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                            @foreach ($stats['latest'] as $item)
                                <tr>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 py-3">
                                            <span
                                                class="text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration }}</span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                            <div class="flex items-center gap-x-3">
                                                <div class="grow">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                        {{ $item->student_name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="h-px w-72 whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $item->category_name }}
                                            </span>
                                            <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                {{ $item->location }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            @if ($item->status == \App\Constants\ProgressConst::PENDING)
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-500/10 dark:text-blue-500">
                                                    Pending
                                                </span>
                                            @elseif($item->status == \App\Constants\ProgressConst::IN_PROGRESS)
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                                                    In Progress
                                                </span>
                                            @else
                                                <span
                                                    class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                    Selesai
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-3">
                                            <span class="text-sm text-gray-500 dark:text-neutral-500">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M, H:i') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="size-px whitespace-nowrap">
                                        <div class="px-6 py-1.5">
                                            <a class="inline-flex items-center gap-x-1 text-sm text-orange-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-orange-500"
                                                href="{{ route('admin.aspirations.detail', $item->id) }}">
                                                Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                                <span class="font-semibold text-gray-800 dark:text-neutral-200">12</span> results
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                <button type="button"
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6" />
                                    </svg>
                                    Prev
                                </button>

                                <button type="button"
                                    class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                    Next
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="spa-scripts" style="display:none;"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

    <script>
        window.addEventListener("load", () => {
            (function () {
                const categories = {!! json_encode($stats['chart']['categories'] ?? []) !!};
                const seriesData = {!! json_encode($stats['chart']['series'] ?? []) !!};

                buildChart(
                    "#hs-single-area-chart",
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
                            name: "Total Laporan",
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
                                style: {
                                    colors: mode === 'dark' ? "#a3a3a3" : "#9ca3af",
                                    fontSize: "13px",
                                    fontFamily: "Inter, ui-sans-serif",
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
                                formatter: (value) => `${Math.floor(value)} Laporan`,
                            },
                            custom: function (props) {
                                const { categories } = props.ctx.opts.xaxis;
                                const { dataPointIndex, series, seriesIndex } = props;
                                const titleStr = categories[dataPointIndex];
                                const value = series[seriesIndex][dataPointIndex];

                                const bgColor = mode === 'dark' ? '#262626' : '#ffffff';
                                const textColor = mode === 'dark' ? '#e5e5e5' : '#1f2937';
                                const secondaryTextColor = mode === 'dark' ? '#a3a3a3' : '#6b7280';
                                const borderColor = mode === 'dark' ? '#404040' : '#e5e7eb';

                                return `
                                <div style="
                                    background: ${bgColor};
                                    border: 1px solid ${borderColor};
                                    border-radius: 8px;
                                    padding: 10px 12px;
                                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                                    min-width: 140px;
                                ">
                                    <div style="
                                        font-size: 14px;
                                        font-weight: 700;
                                        color: ${textColor};
                                        margin-bottom: 4px;
                                    ">
                                        ${Math.floor(value)} Laporan
                                    </div>
                                    <div style="
                                        font-size: 12px;
                                        color: ${secondaryTextColor};
                                        font-weight: 400;
                                    ">
                                        ${titleStr}
                                    </div>
                                </div>
                            `;
                            },
                        },
                        responsive: [{
                            breakpoint: 568,
                            options: {
                                chart: {
                                    height: 300
                                },
                                labels: {
                                    style: {
                                        fontSize: '11px',
                                    },
                                    formatter: (title) => title.length > 3 ? title.slice(0, 3) : title
                                },
                                yaxis: {
                                    labels: {
                                        style: {
                                            fontSize: '11px',
                                        },
                                        formatter: (value) => Math.floor(value)
                                    }
                                },
                            },
                        }]
                    }),
                    {
                        colors: ["#ff7d26"],
                        grid: {
                            borderColor: "#e5e7eb",
                        },
                    },
                    {
                        colors: ["#ff7d26"],
                        grid: {
                            borderColor: "#404040",
                        },
                    }
                );
            })();
        });
    </script>

@endsection