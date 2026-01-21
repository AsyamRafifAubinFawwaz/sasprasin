@extends('_student._layout.app')

@section('title', 'Dashboard')

@section('content')

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                            Total Aspirasi
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                {{ $stats->total ?? 0 }}
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
                            Sedang Diproses
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                {{ ($stats->pending ?? 0) + ($stats->in_progress ?? 0) }}
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
                                {{ $stats->done ?? 0 }}
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

        <div
            class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="p-4 md:p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase text-gray-500 dark:text-neutral-500">
                            Ditolak
                        </p>
                        <div class="mt-1 flex items-center gap-x-2">
                            <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-neutral-200">
                                {{ $stats->rejected ?? 0 }}
                            </h3>
                        </div>
                    </div>
                    <div
                        class="shrink-0 flex justify-center items-center size-[46px] bg-red-100 text-red-600 rounded-lg dark:bg-red-500/10 dark:text-red-500">
                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m15 9-6 6" />
                            <path d="m9 9 6 6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4 shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-neutral-200">Jumlah Laporan per Bulan</h3>
        <div id="hs-single-area-chart"></div>
    </div>

    <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4 shadow-sm dark:bg-neutral-800 dark:border-neutral-700">
        <div class="px-2 py-3 border-b border-gray-200 dark:border-neutral-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Laporan Terbaru Kamu</h3>
        </div>

        <div class="overflow-x-auto mt-4 border border-gray-200 rounded-lg dark:border-neutral-700">
            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                No
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                Tanggal
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                Lokasi
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                Fasilitas
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                Status
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-end"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @forelse($latest ?? [] as $item)
                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700 transition">
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $loop->iteration }}
                                    </span>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm text-gray-800 dark:text-neutral-200">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                    </span>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $item->location }}
                                    </span>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                        {{ $item->facility_category_name }}
                                    </span>
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="px-6 py-3">
                                    @if ($item->status == \App\Constants\ProgressConst::PENDING)
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">
                                            Pending
                                        </span>
                                    @elseif ($item->status == \App\Constants\ProgressConst::IN_PROGRESS)
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-500">
                                            Diproses
                                        </span>
                                    @elseif ($item->status == \App\Constants\ProgressConst::DONE)
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                            Ditolak
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap text-end px-6 py-3">
                                <a navigate href="{{ route('student.complaints.detail', $item->id) }}"
                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-orange-100 text-orange-800 hover:bg-orange-200 focus:outline-none focus:bg-orange-200 disabled:opacity-50 disabled:pointer-events-none dark:text-orange-400 dark:bg-orange-800/30 dark:hover:bg-orange-800/20 dark:focus:bg-orange-800/20">
                                    @include('_admin._layout.icons.view_detail')
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-neutral-500">
                                <div class="flex flex-col items-center gap-2">
                                    <x-admin.empty-state />
                                    <span>Belum ada laporan dari Anda.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>
        <script>
            window.addEventListener('load', () => {
                let categories = @json($chart['categories'] ?? []);
                let seriesData = @json($chart['series'] ?? []);

                if (!categories.length) {
                    categories = ["Data belum tersedia"];
                    seriesData = [0];
                }

                (function () {
                    const chartContainer = document.querySelector('#hs-single-area-chart');
                    if (chartContainer) chartContainer.innerHTML = '';

                    buildChart('#hs-single-area-chart', (mode) => ({
                        chart: {
                            height: 300,
                            type: 'area',
                            toolbar: {
                                show: false
                            },
                            zoom: {
                                enabled: false
                            }
                        },
                        colors: ['#ff7d26'],
                        series: [{
                            name: 'Jumlah Laporan',
                            data: seriesData
                        }],
                        legend: {
                            show: false
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'straight',
                            width: 2,
                            colors: ['#ff7d26']
                        },
                        grid: {
                            strokeDashArray: 2
                        },
                        fill: {
                            type: 'gradient',
                            gradient: {
                                type: 'vertical',
                                shadeIntensity: 0,
                                opacityFrom: 0.4,
                                opacityTo: 0,
                                stops: [0, 100]
                            }
                        },
                        xaxis: {
                            type: 'category',
                            tickPlacement: 'on',
                            categories: categories,
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            },
                            crosshairs: {
                                stroke: {
                                    dashArray: 0
                                },
                                dropShadow: {
                                    show: false
                                }
                            },
                            tooltip: {
                                enabled: false
                            },
                            labels: {
                                style: {
                                    colors: '#9ca3af',
                                    fontSize: '13px',
                                    fontFamily: 'Inter, ui-sans-serif',
                                    fontWeight: 400
                                },
                                formatter: (title) => {
                                    let t = title;
                                    if (t && typeof t === 'string' && t.includes(' ')) {
                                        const newT = t.split(' ');
                                        t = `${newT[0]} ${newT[1].slice(0, 3)}`;
                                    }
                                    return t;
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                align: 'left',
                                minWidth: 0,
                                maxWidth: 140,
                                style: {
                                    colors: '#9ca3af',
                                    fontSize: '13px',
                                    fontFamily: 'Inter, ui-sans-serif',
                                    fontWeight: 400
                                },
                                formatter: (value) => Math.floor(value)
                            }
                        },
                        tooltip: {
                            x: {
                                show: false
                            },
                            y: {
                                formatter: (value) => `${Math.floor(value)} Laporan`
                            },
                            custom: function (props) {
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
                            }
                        },
                        responsive: [{
                            breakpoint: 568,
                            options: {
                                chart: {
                                    height: 300
                                },
                                labels: {
                                    style: {
                                        colors: '#9ca3af',
                                        fontSize: '11px',
                                        fontFamily: 'Inter, ui-sans-serif',
                                        fontWeight: 400
                                    },
                                    offsetX: -2,
                                    formatter: (title) => title.length > 3 ? title.slice(0, 3) : title
                                },
                                yaxis: {
                                    labels: {
                                        align: 'left',
                                        minWidth: 0,
                                        maxWidth: 140,
                                        style: {
                                            colors: '#9ca3af',
                                            fontSize: '11px',
                                            fontFamily: 'Inter, ui-sans-serif',
                                            fontWeight: 400
                                        },
                                        formatter: (value) => Math.floor(value)
                                    }
                                },
                            },
                        }]
                    }), {
                        colors: ['#ff7d26'],
                        fill: {
                            gradient: {
                                shadeIntensity: .1,
                                opacityFrom: .4,
                                opacityTo: 0.1,
                                stops: [0, 100]
                            }
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#9ca3af'
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#9ca3af'
                                }
                            }
                        },
                        grid: {
                            borderColor: '#e5e7eb'
                        }
                    }, {
                        colors: ['#ff7d26'],
                        fill: {
                            gradient: {
                                shadeIntensity: .1,
                                opacityFrom: .4,
                                opacityTo: 0.1,
                                stops: [0, 100]
                            }
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#a3a3a3',
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: '#a3a3a3'
                                }
                            }
                        },
                        grid: {
                            borderColor: '#404040'
                        }
                    });
                })();
            });
        </script>
    @endpush

@endsection