@extends('_admin._layout.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Card -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                        Total Keluhan
                    </p>
                </div>

                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['totals']->total ?? 0) }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                        Pending
                    </p>
                </div>

                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['totals']->pending ?? 0) }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                        In Progress
                    </p>
                </div>

                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['totals']->in_progress ?? 0) }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                        Selesai
                    </p>
                </div>

                <div class="mt-1 flex items-center gap-x-2">
                    <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                        {{ number_format($stats['totals']->done ?? 0) }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Grid -->
    <!-- End Grid -->

    <div class="grid grid-cols-1 gap-4 sm:gap-6">
        <!-- Card -->
        <div
            class="p-4 md:p-5 min-h-102.5 flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <!-- Header -->
            <div class="flex flex-wrap justify-between items-center gap-2 mb-4">
                <div>
                    <h2 class="text-sm text-gray-500 dark:text-neutral-500">
                        Statistik Aspiration (12 Hari Terakhir)
                    </h2>
                </div>

                <!-- Legend Indicator -->
                <div class="flex justify-center sm:justify-end items-center gap-x-4 mb-3 sm:mb-6">
                    <div class="inline-flex items-center">
                        <span class="size-2.5 inline-block bg-red-600 rounded-sm me-2"></span>
                        <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                            Pending
                        </span>
                    </div>
                    <div class="inline-flex items-center">
                        <span class="size-2.5 inline-block bg-orange-500 rounded-sm me-2"></span>
                        <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                            In Progress
                        </span>
                    </div>
                    <div class="inline-flex items-center">
                        <span class="size-2.5 inline-block bg-green-500 rounded-sm me-2"></span>
                        <span class="text-[13px] text-gray-600 dark:text-neutral-400">
                            Selesai
                        </span>
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <div id="hs-multiple-line-charts"></div>
        </div>
        <!-- End Card -->
    </div>

    <!-- Card -->
    <div class="flex flex-col">
        <div
            class="overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
            <div class="min-w-full inline-block align-middle">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                    <!-- Header -->
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

                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
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
                    <!-- End Header -->

                    <!-- Table -->
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
                                            Mahasiswa
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
                                            <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-hidden focus:underline font-medium dark:text-blue-500"
                                                href="{{ route('admin.aspirations.detail', $item->id) }}">
                                                Detail
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <!-- End Table -->

                    <!-- Footer -->
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
                    <!-- End Footer -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Card -->
    </div>
    </div>
    <!-- End Content -->

    <!-- SPA Script Container - keeps scripts inside #main-content for SPA navigation -->
    <div id="spa-scripts" style="display:none;"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

   <script>
window.addEventListener("load", () => {
    (function () {
        buildChart(
            "#hs-multiple-line-charts",
            (mode) => ({
                chart: {
                    height: 250,
                    type: "line",
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false,
                    },
                },
                series: [{
                    name: "Pending",
                    data: {!! json_encode($stats['chart']['pending'] ?? []) !!},
                },
                {
                    name: "In Progress",
                    data: {!! json_encode($stats['chart']['in_progress'] ?? []) !!},
                },
                {
                    name: "Selesai",
                    data: {!! json_encode($stats['chart']['done'] ?? []) !!},
                },
                ],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "straight",
                    width: [4, 4, 4],
                    dashArray: [0, 0, 0],
                },
                title: {
                    show: false,
                },
                legend: {
                    show: false,
                },
                markers: {
                    size: 4,
                    colors: (mode === 'dark' ? ["#f87171", "#fb923c", "#4ade80"] : ["#ef4444", "#f97316", "#22c55e"]),
                    strokeColors: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 6,
                    }
                },
                grid: {
                    strokeDashArray: 0,
                    borderColor: mode === 'dark' ? "#404040" : "#e5e7eb",
                    padding: {
                        top: -20,
                        right: 0,
                    },
                },
                xaxis: {
                    type: "category",
                    categories: {!! json_encode($stats['chart']['categories'] ?? []) !!},
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    crosshairs: {
                        show: true,
                        stroke: {
                            color: mode === 'dark' ? "#737373" : "#e5e7eb",
                            width: 1,
                            dashArray: 3,
                        },
                    },
                    tooltip: {
                        enabled: false,
                    },
                    labels: {
                        offsetY: 5,
                        style: {
                            colors: mode === 'dark' ? "#a3a3a3" : "#9ca3af",
                            fontSize: "13px",
                            fontFamily: "Inter, ui-sans-serif",
                            fontWeight: 400,
                        },
                        formatter: (title) => {
                            let t = title;
                            if (t) {
                                const newT = t.split(" ");
                                t = `${newT[0]} ${newT[1].slice(0, 3)}`;
                            }
                            return t;
                        },
                    },
                },
                yaxis: {
                    min: 0,
                    tickAmount: 4,
                    labels: {
                        align: "left",
                        minWidth: 0,
                        maxWidth: 140,
                        style: {
                            colors: mode === 'dark' ? "#a3a3a3" : "#9ca3af",
                            fontSize: "12px",
                            fontFamily: "Inter, ui-sans-serif",
                            fontWeight: 400,
                        },
                        formatter: (value) => value >= 1000 ? `${value / 1000}k` : value,
                    },
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    custom: function ({series, seriesIndex, dataPointIndex, w}) {
                        const categories = w.config.xaxis.categories;
                        const title = categories[dataPointIndex];
                        
                        // Get values for all series at this point
                        const pendingValue = series[0][dataPointIndex];
                        const inProgressValue = series[1][dataPointIndex];
                        const doneValue = series[2][dataPointIndex];
                        
                        // Define colors based on mode
                        const colors = mode === 'dark' 
                            ? ["#f87171", "#fb923c", "#4ade80"]
                            : ["#ef4444", "#f97316", "#22c55e"];
                        
                        const bgColor = mode === 'dark' ? '#262626' : '#ffffff';
                        const textColor = mode === 'dark' ? '#e5e5e5' : '#1f2937';
                        const secondaryTextColor = mode === 'dark' ? '#a3a3a3' : '#6b7280';
                        const borderColor = mode === 'dark' ? '#404040' : '#e5e7eb';
                        
                        return `
                            <div style="
                                background: ${bgColor};
                                border: 1px solid ${borderColor};
                                border-radius: 8px;
                                padding: 12px 14px;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                                min-width: 160px;
                            ">
                                <div style="
                                    font-size: 13px;
                                    font-weight: 600;
                                    color: ${textColor};
                                    margin-bottom: 8px;
                                    padding-bottom: 8px;
                                    border-bottom: 1px solid ${borderColor};
                                "></div>
                                
                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="
                                                width: 10px;
                                                height: 10px;
                                                background: ${colors[0]};
                                                border-radius: 2px;
                                                display: inline-block;
                                            "></span>
                                            <span style="
                                                font-size: 12px;
                                                color: ${secondaryTextColor};
                                            ">Pending:</span>
                                        </div>
                                        <span style="
                                            font-size: 13px;
                                            font-weight: 600;
                                            color: ${textColor};
                                            margin-left: 12px;
                                        ">${pendingValue}</span>
                                    </div>
                                    
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="
                                                width: 10px;
                                                height: 10px;
                                                background: ${colors[1]};
                                                border-radius: 2px;
                                                display: inline-block;
                                            "></span>
                                            <span style="
                                                font-size: 12px;
                                                color: ${secondaryTextColor};
                                            ">In Progress:</span>
                                        </div>
                                        <span style="
                                            font-size: 13px;
                                            font-weight: 600;
                                            color: ${textColor};
                                            margin-left: 12px;
                                        ">${inProgressValue}</span>
                                    </div>
                                    
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <div style="display: flex; align-items: center; gap: 8px;">
                                            <span style="
                                                width: 10px;
                                                height: 10px;
                                                background: ${colors[2]};
                                                border-radius: 2px;
                                                display: inline-block;
                                            "></span>
                                            <span style="
                                                font-size: 12px;
                                                color: ${secondaryTextColor};
                                            ">Selesai:</span>
                                        </div>
                                        <span style="
                                            font-size: 13px;
                                            font-weight: 600;
                                            color: ${textColor};
                                            margin-left: 12px;
                                        ">${doneValue}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    },
                },
            }), {
            colors: ["#ef4444", "#f97316", "#22c55e"],
            grid: {
                borderColor: "#e5e7eb",
            },
        }, {
            colors: ["#f87171", "#fb923c", "#4ade80"],
            grid: {
                borderColor: "#404040",
            },
        }
        ); 
    })();
});
</script>

@endsection