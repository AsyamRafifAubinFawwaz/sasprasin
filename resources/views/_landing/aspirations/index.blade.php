@extends('_landing._layout.app')

@section('title', 'Daftar Aspirasi')

@section('content')
    <section class="pt-32 pb-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
                <div class="text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#1a202c]">Semua Laporan Aspirasi</h1>
                    <p class="text-gray-500 mt-2">Daftar lengkap laporan kondisi fasilitas sekolah secara transparan.</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 mb-8">
                <form action="{{ route('landing.aspirations') }}" method="GET"
                    class="flex flex-col md:flex-row gap-3 items-center">
                    <div class="flex-1 w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari lokasi atau deskripsi..."
                            class="w-full px-4 py-2.5 rounded-xl border-gray-200 text-sm focus:ring-2 focus:ring-[#ff7d26] focus:border-[#ff7d26] transition-all">
                    </div>

                    <div class="flex flex-wrap md:flex-nowrap gap-3 w-full md:w-auto">
                        <select name="status"
                            class="px-4 py-2.5 rounded-xl border-gray-200 text-sm focus:ring-2 focus:ring-[#ff7d26] focus:border-[#ff7d26] transition-all">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Pending</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Selesai</option>
                            <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Ditolak</option>
                        </select>

                        <input type="date" name="date" value="{{ request('date') }}"
                            class="px-4 py-2.5 rounded-xl border-gray-200 text-sm focus:ring-2 focus:ring-[#ff7d26] focus:border-[#ff7d26] transition-all">

                        <button type="submit"
                            class="bg-[#ff7d26] text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-orange-600 transition-all whitespace-nowrap">
                            Cari
                        </button>

                        @if (request()->anyFilled(['search', 'status', 'date']))
                            <a href="{{ route('landing.aspirations') }}"
                                class="flex items-center justify-center px-4 py-2.5 text-gray-500 hover:text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all text-sm font-semibold whitespace-nowrap">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($aspirations as $aspiration)
                    <a href="{{ route('landing.aspirations.show', $aspiration->id) }}"
                        class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-200 group flex flex-col h-full cursor-pointer"
                        data-aos="fade-up">
                        <div class="relative h-60 overflow-hidden">
                            <img src="{{ \App\Utils\UrlHelper::getImageUrl($aspiration->image) }}"
                                alt="{{ $aspiration->category_name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>

                        <div class="p-8 flex flex-col flex-1">
                            {{-- User Profile Section --}}
                            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-100">
                                <div
                                    class="size-10 flex items-center justify-center rounded-full bg-blue-600 text-white text-sm font-extrabold shadow-sm">
                                    {{ !empty($aspiration->student_name) ? strtoupper(substr($aspiration->student_name, 0, 1)) : '?' }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-800 truncate">
                                        {{ $aspiration->student_name ?? 'Anonim' }}
                                    </p>
                                    <p class="text-[10px] text-gray-400 font-medium">
                                        Pelapor
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between gap-4 mb-4">
                                <span
                                    class="bg-gray-100 text-[#1a202c] px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                    {{ $aspiration->category_name }}
                                </span>
                                @php
                                    $statusColor = match ((int) $aspiration->status) {
                                        2 => 'bg-yellow-50 text-yellow-600 border border-yellow-100',
                                        3 => 'bg-green-50 text-green-600 border border-green-100',
                                        4 => 'bg-red-50 text-red-600 border border-red-100',
                                        default => 'bg-gray-50 text-gray-600 border border-gray-100',
                                    };
                                    $statusText = match ((int) $aspiration->status) {
                                        2 => 'Dalam Proses',
                                        3 => 'Selesai',
                                        4 => 'Ditolak',
                                        default => 'Pending',
                                    };
                                @endphp
                                <span
                                    class="{{ $statusColor }} px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest whitespace-nowrap">
                                    {{ $statusText }}
                                </span>
                            </div>

                            <h3
                                class="text-xl font-bold text-[#1a202c] mb-3 group-hover:text-[#ff7d26] transition-colors leading-tight">
                                {{ $aspiration->category_name }}
                            </h3>

                            <p class="text-gray-500 text-sm line-clamp-3 mb-6 leading-relaxed flex-1">
                                {{ $aspiration->description }}
                            </p>

                            <div
                                class="pt-6 border-t border-gray-100 flex items-center justify-between text-[11px] text-gray-400 font-medium">
                                <div class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $aspiration->location }}
                                </div>
                                <span>{{ \Carbon\Carbon::parse($aspiration->created_at)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-20 bg-gray-50 rounded-3xl">
                        <p class="text-gray-500">Tidak ada laporan yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $aspirations->links() }}
            </div>
        </div>
    </section>
@endsection
