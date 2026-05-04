@extends('_landing._layout.app')

@section('title', 'Detail Aspirasi - ' . $aspiration->category_name)

@section('content')
    <section class="pt-32 pb-24 bg-[#f8fafc]">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="mb-8 cursor-pointer" data-aos="fade-down">
                <a onclick="history.back()"
                    class="group inline-flex items-center gap-2.5 text-gray-500 cursor-pointer hover:text-[#ff7d26] font-semibold transition-all">
                    <div
                        class="w-8 h-8 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center group-hover:bg-orange-50 group-hover:border-orange-100 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </div>
                    Kembali ke Daftar Aspirasi
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 space-y-8">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100" data-aos="fade-up">
                        <div class="flex items-start justify-between gap-4 mb-6">
                            <div>
                                <span
                                    class="inline-block bg-orange-50 text-[#ff7d26] px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider border border-orange-100 mb-3">
                                    {{ $aspiration->category_name }}
                                </span>
                                <h1 class="text-3xl font-bold text-[#1a202c] mb-2">
                                    {{ $aspiration->category_name }} di {{ $aspiration->location }}
                                </h1>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $aspiration->location  }}
                                </div>
                            </div>
                            @php
                                $statusColor = match ((int) $aspiration->status) {
                                    2 => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                                    3 => 'bg-green-50 text-green-600 border-green-200',
                                    4 => 'bg-red-50 text-red-600 border-red-200',
                                    default => 'bg-gray-50 text-gray-600 border-gray-200',
                                };
                                $statusText = match ((int) $aspiration->status) {
                                    2 => 'DALAM PROSES',
                                    3 => 'SELESAI',
                                    4 => 'DITOLAK',
                                    default => 'PENDING',
                                };
                            @endphp
                            <span
                                class="inline-block {{ $statusColor }} px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider border whitespace-nowrap">
                                {{ $statusText }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Dilaporkan:
                            {{ \Carbon\Carbon::parse($aspiration->created_at)->translatedFormat('d F Y - H:i') }} WIB
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100" data-aos="fade-up">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Dokumentasi Visual</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative group">
                                <div class="absolute top-3 left-3 z-10">
                                    <span
                                        class="bg-gray-800/80 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-bold uppercase">
                                        Kondisi Sebelum
                                    </span>
                                </div>
                                <div class="aspect-video rounded-2xl overflow-hidden bg-gray-100">
                                    <img src="{{ \App\Utils\UrlHelper::getImageUrl($aspiration->image) }}" alt="Kondisi Sebelum"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                            </div>

                            @if ($aspiration->status == 3 && $aspiration->aspiration_image)
                                <div class="relative group">
                                    <div class="absolute top-3 left-3 z-10">
                                        <span
                                            class="bg-green-600/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-bold uppercase">
                                            Kondisi Sesudah
                                        </span>
                                    </div>
                                    <div class="aspect-video rounded-2xl overflow-hidden bg-green-50">
                                        <img src="{{ \App\Utils\UrlHelper::getImageUrl($aspiration->image) }}" alt="Kondisi Sesudah"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100" data-aos="fade-up">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Detail Kejadian</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $aspiration->description }}
                        </p>

                        @if ($aspiration->feedback)
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Respon Petugas
                                </h4>
                                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-xl">
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        {{ $aspiration->feedback }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 sticky top-24"
                        data-aos="fade-up">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-6">Timeline Status</h3>

                        @if (count($logs) > 0)
                            <ol class="relative border-s border-gray-200 ms-3">
                                @foreach ($logs as $log)
                                    @php
                                        $iconColors = [
                                            1 => 'bg-amber-100 text-amber-600 ring-white',
                                            2 => 'bg-blue-100 text-blue-600 ring-white',
                                            3 => 'bg-emerald-100 text-emerald-600 ring-white',
                                            4 => 'bg-red-100 text-red-600 ring-white',
                                        ];
                                        $badgeColors = [
                                            1 => 'bg-amber-50 text-amber-700 border-amber-100',
                                            2 => 'bg-blue-50 text-blue-700 border-blue-100',
                                            3 => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            4 => 'bg-red-50 text-red-700 border-red-100',
                                        ];
                                    @endphp
                                    <li class="mb-10 ms-6">
                                        <span
                                            class="absolute flex items-center justify-center w-6 h-6 {{ $iconColors[$log->new_status] ?? 'bg-gray-100 text-gray-500' }} rounded-full -start-3 ring-8 ring-white">
                                            @if ($log->new_status == 1)
                                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <polyline points="12 6 12 12 16 14" />
                                                </svg>
                                            @elseif($log->new_status == 2)
                                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 2v4" />
                                                    <path d="m16.2 7.8 2.9-2.9" />
                                                    <path d="M18 12h4" />
                                                    <path d="m16.2 16.2 2.9 2.9" />
                                                    <path d="M12 18v4" />
                                                    <path d="m4.9 19.1 2.9-2.9" />
                                                    <path d="M2 12h4" />
                                                    <path d="m4.9 4.9 2.9 2.9" />
                                                </svg>
                                            @elseif($log->new_status == 3)
                                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 6 9 17l-5-5" />
                                                </svg>
                                            @elseif($log->new_status == 4)
                                                <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                                                    <path d="M12 8v4" />
                                                    <path d="M12 16h.01" />
                                                </svg>
                                            @endif
                                        </span>
                                        <time
                                            class="bg-gray-50 border border-gray-100 text-gray-500 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider">
                                            {{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d M Y, H:i') }}
                                        </time>
                                        <h3 class="flex items-center mb-1 text-sm font-bold text-gray-800 mt-3 capitalize">
                                            {{ $log->new_status == 1 ? 'Pending' : ($log->new_status == 2 ? 'In Progress' : ($log->new_status == 3 ? 'Selesai' : 'Ditolak')) }}
                                            @if ($loop->first)
                                                <span
                                                    class="ms-2 {{ $badgeColors[$log->new_status] ?? 'bg-gray-100' }} border text-[9px] font-black px-1.5 py-0.5 rounded uppercase tracking-tighter">Terbaru</span>
                                            @endif
                                        </h3>
                                        @if ($log->note)
                                            <p class="text-sm text-gray-500 mb-4 leading-relaxed italic">
                                                "{{ $log->note }}"
                                            </p>
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <div class="flex flex-col items-center justify-center py-10 text-center">
                                <div class="size-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <svg class="size-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 8v4l3 3" />
                                        <circle cx="12" cy="12" r="10" />
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">Belum ada pembaruan status</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
