@extends('_landing._layout.app')

@section('title', 'Landing')

@section('content')
    <section id="beranda"
        class="hero-section w-full min-h-screen flex items-center bg-white overflow-hidden pt-24 sm:pt-28 md:pt-32">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 sm:gap-10">

                <div class="w-full md:w-1/2 space-y-4 sm:space-y-6" data-aos="fade-right">
                    {{-- <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <span class="text-gray-700 text-sm font-medium">🌐 We host more than 120,000 websites</span>
                </div> --}}

                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-[#1a202c] leading-tight">
                        Selamat Datang <br> <span class="text-[#1a202c]">di Sarprasin</span>
                    </h1>

                    <p class="text-base sm:text-lg text-gray-500 max-w-md leading-relaxed">
                        Sistem Pengaduan Sarana Sekolah. Kami menyediakan berbagai layanan untuk mempermudah manajemen
                        aspirasi Anda secara digital dan efisien.
                    </p>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-6 pt-4">
                        <a href="/login"
                            class="bg-[#ff7d26] hover:bg-[#d55500] text-white px-6 sm:px-8 py-3 sm:py-4 rounded-2xl font-semibold transition-all shadow-lg shadow-purple-200 text-center">
                            <span class="sm:hidden">Login</span>
                            <span class="hidden sm:inline">Login Terlebih Dahulu</span>
                        </a>
                        <a href="#cara-kerja"
                            class="flex items-center justify-center gap-2 text-[#ff7d26] font-semibold hover:underline smooth-scroll border border-orange-500 px-6 sm:px-8 py-3 sm:py-4 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="hidden sm:inline">Pelajari Cara Kerja</span>
                            <span class="sm:hidden">Cara Kerja</span>
                        </a>
                    </div>
                </div>

                <div class="w-full md:w-1/2 flex justify-center items-center" data-aos="fade-left">
                    <img src="{{ asset('/image/hero.png') }}" alt="Ilustrasi" class="w-full max-w-lg object-contain">
                </div>

            </div>
        </div>
    </section>
    </section>

    <section id="aspirasi" class="py-12 sm:py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div class="max-w-2xl" data-aos="fade-right">
                    <h2 class="text-[#ff7d26] font-bold tracking-wider uppercase text-sm mb-3">Aspirasi Publik</h2>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-[#1a202c] leading-tight">
                        Pantau Kondisi Fasilitas <br> Sekolah Secara Real-Time
                    </h2>
                </div>
                <div data-aos="fade-left">
                    <a href="{{ route('landing.aspirations') }}"
                        class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-orange-600 transition-all group">
                        Lihat Semua Laporan
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 transform transition-transform group-hover:translate-x-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($aspirations as $aspiration)
                    <a href="{{ route('landing.aspirations.show', $aspiration->id) }}"
                        class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all border border-gray-200 group flex flex-col h-full cursor-pointer"
                        data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="relative h-60 sm:h-64 overflow-hidden">
                         <img src="{{ \App\Utils\UrlHelper::getImageUrl($aspiration->image) }}"
                                alt="{{ $aspiration->category_name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>

                        <div class="p-8 flex flex-col flex-1">
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
                        <p class="text-gray-500">Belum ada aspirasi publik yang dilaporkan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="keunggulan" class="py-12 sm:py-20 bg-[#f8f9fa]">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-[#1a202c]">Keunggulan Sasprasin</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-[#ffdec8] rounded-xl flex items-center justify-center mb-6 text-[#ff7d26]">
                        @include('_landing._layout.icons.photo')
                    </div>
                    <h3 class="text-xl font-bold text-[#1a202c] mb-3">Lapor dengan Foto</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Siswa dapat mengirim laporan disertai foto kerusakan.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-[#ffdec8] rounded-xl flex items-center justify-center mb-6 text-[#ff7d26]">
                        @include('_landing._layout.icons.status')
                    </div>
                    <h3 class="text-xl font-bold text-[#1a202c] mb-3">Status & Prioritas</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Setiap laporan akan diberikan status dan prioritas.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 bg-[#ffdec8] rounded-xl flex items-center justify-center mb-6 text-[#ff7d26]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[ff7d26]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a202c] mb-3">Update Real-Time</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Update status dan prioritas langsung di dashboard.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 bg-[#ffdec8] rounded-xl flex items-center justify-center mb-6 text-[#ff7d26]">
                        @include('_landing._layout.icons.document')
                    </div>
                    <h3 class="text-xl font-bold text-[#1a202c] mb-3">Sistem Laporan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Sistem laporan yang mudah dan cepat.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Dashboard Preview Section --}}
    <section id="dashboard" class="pt-24 pb-12 sm:pt-32 sm:pb-12 bg-linear-to-b from-[#f8f9fa] to-white relative z-10">
        <div class="container mx-auto px-4 sm:px-6 md:px-20 relative z-10">
            <div class="text-center mb-16 lg:mb-24 max-w-3xl mx-auto" data-aos="fade-up">
                <h2 class="text-orange-400 font-bold tracking-wider uppercase text-sm mb-3">Preview Aplikasi</h2>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#1a202c] mb-6 leading-tight">
                    Tampilan Dashboard Modern & Intuitif
                </h2>
                <p class="text-gray-500 text-lg leading-relaxed">
                    Desain dashboard yang bersih dan informatif memudahkan Anda memantau seluruh laporan secara real-time.
                </p>
            </div>

            <div class="relative group perspective-1000 max-w-5xl mx-auto">
                <div
                    class="absolute -inset-1 bg-black/5 rounded-4xl blur-xl transition duration-500 group-hover:bg-black/10">
                </div>

                <div class="relative rounded-2xl sm:rounded-4xl overflow-hidden shadow-2xl border border-gray-200/50 bg-white transform transition-all duration-500 hover:scale-[1.01] z-10"
                    data-aos="zoom-in" data-aos-duration="1000">
                    <div class="bg-gray-50 border-b border-gray-100 px-4 py-3 flex items-center gap-2">
                        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-400"></div>
                        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-400"></div>
                        <div class="ml-4 flex-1 bg-white h-5 sm:h-6 rounded-md border border-gray-100 shadow-sm"></div>
                    </div>

                    <img src="{{ asset('/image/dashboard-admin.png') }}" alt="Dashboard Admin Sasprasin"
                        class="w-full h-auto object-cover object-top hover:object-center transition-all duration-700"
                        loading="lazy">
                </div>

                <div class="absolute -bottom-12 -right-4 sm:-bottom-24 sm:-right-8 md:-right-12 w-3/4 sm:w-2/3 md:w-3/5 rounded-xl sm:rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-white/40 bg-white/80 backdrop-blur-md transform transition-all duration-500 hover:scale-[1.05] hover:-translate-y-2 z-20 group-hover:shadow-[0_25px_60px_rgba(0,0,0,0.2)]"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-gray-50/50 border-b border-gray-100 px-3 py-2 flex items-center gap-1.5">
                        <div class="w-2 h-2 rounded-full bg-red-400/80"></div>
                        <div class="w-2 h-2 rounded-full bg-yellow-400/80"></div>
                        <div class="w-2 h-2 rounded-full bg-green-400/80"></div>
                        <div class="ml-3 flex-1 bg-white/50 h-3 rounded-sm border border-gray-100/50"></div>
                    </div>

                    <img src="{{ asset('/image/pengaduan.png') }}" alt="Monitoring Pengaduan Sasprasin"
                        class="w-full h-auto object-cover" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <section id="masalah-solusi" class="pt-24 pb-12 sm:pt-48 sm:pb-24 bg-white relative z-0">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="flex flex-col md:flex-row items-center gap-16">

                <div class="w-full md:w-1/2" data-aos="fade-right">
                    <div class="relative">
                        <div
                            class="absolute -top-4 -left-4 w-72 h-72 bg-orange-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                        </div>
                        <img src="{{ asset('/image/phone.png') }}" alt="Problem Illustration" class="relative ">
                    </div>
                </div>

                <div class="w-full md:w-1/2 space-y-8" data-aos="fade-left">
                    <div class="space-y-4">
                        <h2 class="text-orange-400 font-bold tracking-wider uppercase text-sm">Masalah & Solusi</h2>
                        <h2 class="text-4xl font-extrabold text-[#1a202c] leading-tight">
                            Kenapa aplikasi ini dibuat?
                        </h2>
                        <p class="text-gray-500 text-lg">
                            Kami sadar kalau proses pelaporan manual itu ribet banget dan sering bikin frustasi.
                        </p>
                    </div>

                    <div class="grid gap-6">
                        <div
                            class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                            <span class="text-2xl items-center text-red-500">
                                @include('_landing._layout.icons.ghost')
                            </span>
                            <div>
                                <h4 class="font-bold text-gray-800">Laporan Sering Ghosting</h4>
                                <p class="text-sm text-gray-600">Pengaduan sering lupa atau malah nggak ditindaklanjuti
                                    sama
                                    sekali.</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                            <span class="text-2xl items-center text-red-500">
                                @include('_landing._layout.icons.help')
                            </span>
                            <div>
                                <h4 class="font-bold text-gray-800">Status Kagak Jelas</h4>
                                <p class="text-sm text-gray-600">Siswa nggak tahu progresnya udah sampe mana, diperbaiki
                                    atau belum.</p>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                            <span class="text-2xl items-center text-red-500">
                                @include('_landing._layout.icons.message-square-warning')
                            </span>
                            <div>
                                <h4 class="font-bold text-gray-800">Admin Kewalahan</h4>
                                <p class="text-sm text-gray-600">Admin kesulitan nyatet laporan yang numpuk dan berantakan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <p class="text-[#ff7d26] font-semibold italic">
                            "Makanya, Sarprasin hadir buat beresin itu semua secara digital!"
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="cara-kerja" class="py-12 sm:py-24 bg-[#f8f9fa]">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="text-center mb-16 space-y-4" data-aos="fade-up">
                <h2 class="text-orange-400 font-bold tracking-wider uppercase text-sm">Alur Proses</h2>
                <h2 class="text-4xl font-extrabold text-[#1a202c]">Cara Kerja Aplikasi</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                    Proses pelaporan yang simpel dan transparan dalam 4 langkah mudah
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="relative" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-[#ff7d26] h-full">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-[#ff7d26] rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            1
                        </div>
                        <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#1a202c] mb-3">Siswa Mengisi Laporan</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Siswa mengisi formulir pengaduan dengan detail kerusakan dan melampirkan foto sebagai bukti
                        </p>
                    </div>
                </div>

                <div class="relative" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-gray-100 hover:border-[#ff7d26] h-full">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            2
                        </div>
                        <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#1a202c] mb-3">Admin Menerima & Verifikasi</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Admin menerima notifikasi dan memverifikasi keaslian serta kelengkapan laporan yang masuk
                        </p>
                    </div>
                </div>

                <div class="relative" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-gray-100 hover:border-[#ff7d26] h-full">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            3
                        </div>
                        <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#1a202c] mb-3">Update Status & Prioritas</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Admin memperbarui status pengerjaan dan menentukan prioritas berdasarkan tingkat urgensi
                        </p>
                    </div>
                </div>

                <div class="relative" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-gray-100 hover:border-[#ff7d26] h-full">
                        <div
                            class="absolute -top-4 -left-4 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            4
                        </div>
                        <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#1a202c] mb-3">Siswa Memantau Progres</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Siswa dapat melihat progres perbaikan secara real-time melalui dashboard mereka
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section id="role" class="py-12 sm:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 md:px-20">
            <div class="text-center mb-16 space-y-4" data-aos="fade-up">
                <h2 class="text-orange-400 font-bold tracking-wider uppercase text-sm">Fitur Berdasarkan Role</h2>
                <h2 class="text-4xl font-extrabold text-[#1a202c]">Siapa Saja yang Menggunakan?</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                    Sistem yang dirancang khusus untuk kebutuhan siswa dan admin
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <div class="bg-gradient-to-br from-orange-50 to-white p-10 rounded-3xl shadow-lg border-2 border-orange-100 hover:shadow-xl transition-all"
                    data-aos="fade-right">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-16 h-16 bg-[#ff7d26] rounded-2xl flex items-center text-white justify-center">
                            @include('_landing._layout.icons.student')
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#1a202c]">Untuk Siswa</h3>
                            <p class="text-gray-500 text-sm">Lapor dengan mudah dan pantau progresnya</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-orange-100">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#ff7d26]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a202c] mb-1">Mengirim Pengaduan</h4>
                                <p class="text-sm text-gray-600">Laporkan kerusakan dengan formulir yang mudah dipahami
                                    disertai upload foto</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-orange-100">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#ff7d26]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a202c] mb-1">Melihat Status & Feedback</h4>
                                <p class="text-sm text-gray-600">Pantau status laporan dan terima feedback langsung dari
                                    admin</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-orange-100">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#ff7d26]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a202c] mb-1">Memantau Progres</h4>
                                <p class="text-sm text-gray-600">Lihat perkembangan perbaikan secara real-time di dashboard
                                    pribadi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-gray-50 to-white p-10 rounded-3xl shadow-lg border-2 border-gray-200 hover:shadow-xl transition-all"
                    data-aos="fade-left">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-16 h-16 bg-[#1a202c] rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#1a202c]">Untuk Admin</h3>
                            <p class="text-gray-500 text-sm">Kelola semua laporan dengan efisien</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-200">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1a202c]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a202c] mb-1">Mengelola Semua Laporan</h4>
                                <p class="text-sm text-gray-600">Akses, verifikasi, dan atur semua laporan yang masuk dalam
                                    satu dashboard</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-200">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1a202c]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a202c] mb-1">Menentukan Prioritas</h4>
                                <p class="text-sm text-gray-600">Set prioritas laporan berdasarkan tingkat urgensi dan
                                    dampak kerusakan</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-200">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1a202c]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1a202c] mb-1">Memberikan Umpan Balik</h4>
                                <p class="text-sm text-gray-600">Komunikasi langsung dengan siswa melalui sistem feedback
                                    terintegrasi</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
