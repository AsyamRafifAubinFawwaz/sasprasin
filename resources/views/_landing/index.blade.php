@extends('_landing._layout.app')

@section('title', 'Landing')

@section('content')
<section id="beranda" class="hero-section w-full min-h-screen flex items-center bg-white overflow-hidden pt-10">
    <div class="container mx-auto px-6 md:px-20">
        <div class="flex flex-col md:flex-row items-center justify-between gap-10">
            
            <div class="w-full md:w-1/2 space-y-6">
                <div class="inline-flex items-center gap-2 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                    <span class="text-gray-700 text-sm font-medium">🌐 We host more than 120,000 websites</span>
                </div>

                <h1 class="text-5xl md:text-6xl font-bold text-[#1a202c] leading-tight">
                    Selamat Datang di <br> <span class="text-[#1a202c]">Sarprasin</span>
                </h1>

                <p class="text-lg text-gray-500 max-w-md leading-relaxed">
                    Sistem Pengaduan Sarana Sekolah. Kami menyediakan berbagai layanan untuk mempermudah manajemen aspirasi Anda secara digital dan efisien.
                </p>

                <div class="flex items-center gap-6 pt-4">
                    <a href="/login" class="bg-[#ff7d26] hover:bg-[#d55500] text-white px-8 py-4 rounded-2xl font-semibold transition-all shadow-lg shadow-purple-200">
                        Login Terlebih Dahulu
                    </a>
                    <a href="#cara-kerja" class="flex items-center gap-2 text-[#ff7d26] font-semibold hover:underline smooth-scroll">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Pelajari Cara Kerja
                    </a>
                </div>
            </div>

            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="{{ asset('/image/hero.png') }}" alt="Ilustrasi" class="w-full max-w-lg object-contain">
            </div>

        </div>
    </div>
</section>
<section id="keunggulan" class="py-20 bg-[#f8f9fa]">
    <div class="container mx-auto px-6 md:px-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-[#1a202c]">Keunggulan Sasprasin</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]">
                <div class="w-12 h-12 bg-[#ffdec8] rounded-xl flex items-center justify-center mb-6 text-[#ff7d26]">
                   @include('_landing._layout.icons.photo')
                </div>
                <h3 class="text-xl font-bold text-[#1a202c] mb-3">Lapor dengan Foto</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                   Siswa dapat mengirim laporan disertai foto kerusakan.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]">
                <div class="w-12 h-12 bg-[#ffdec8] rounded-xl flex items-center justify-center mb-6 text-[#ff7d26]">
                    @include('_landing._layout.icons.status')
                </div>
                <h3 class="text-xl font-bold text-[#1a202c] mb-3">Status & Prioritas</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Setiap laporan akan diberikan status dan prioritas.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]">
                <div class="w-12 h-12 bg-[#ffdec8] rounded-xl flex items-center justify-center mb-6 text-[#ff7d26]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#1a202c] mb-3">Update Real-Time</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Update status dan prioritas langsung di dashboard.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100 hover:border-[#ff7d26]">
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
<section id="masalah-solusi" class="py-24 bg-white">
    <div class="container mx-auto px-6 md:px-20">
        <div class="flex flex-col md:flex-row items-center gap-16">
            
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-72 h-72 bg-orange-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <img src="{{ asset('/image/phone.png') }}" alt="Problem Illustration" class="relative ">
                </div>
            </div>

            <div class="w-full md:w-1/2 space-y-8">
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
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                        <span class="text-2xl items-center text-red-500">
                            @include('_landing._layout.icons.ghost')
                        </span>
                        <div>
                            <h4 class="font-bold text-gray-800">Laporan Sering Ghosting</h4>
                            <p class="text-sm text-gray-600">Pengaduan sering lupa atau malah nggak ditindaklanjuti sama sekali.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                        <span class="text-2xl items-center text-red-500">
                            @include('_landing._layout.icons.help')
                        </span>
                        <div>
                            <h4 class="font-bold text-gray-800">Status Kagak Jelas</h4>
                            <p class="text-sm text-gray-600">Siswa nggak tahu progresnya udah sampe mana, diperbaiki atau belum.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                        <span class="text-2xl items-center text-red-500">
                            @include('_landing._layout.icons.message-square-warning')
                        </span>
                        <div>
                            <h4 class="font-bold text-gray-800">Admin Kewalahan</h4>
                            <p class="text-sm text-gray-600">Admin kesulitan nyatet laporan yang numpuk dan berantakan.</p>
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

<section id="cara-kerja" class="py-24 bg-[#f8f9fa]">
    <div class="container mx-auto px-6 md:px-20">
        <div class="text-center mb-16 space-y-4">
            <h2 class="text-orange-400 font-bold tracking-wider uppercase text-sm">Alur Proses</h2>
            <h2 class="text-4xl font-extrabold text-[#1a202c]">Cara Kerja Aplikasi</h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                Proses pelaporan yang simpel dan transparan dalam 4 langkah mudah
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-[#ff7d26] h-full">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-[#ff7d26] rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        1
                    </div>
                    <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a202c] mb-3">Siswa Mengisi Laporan</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Siswa mengisi formulir pengaduan dengan detail kerusakan dan melampirkan foto sebagai bukti
                    </p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-gray-100 hover:border-[#ff7d26] h-full">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        2
                    </div>
                    <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a202c] mb-3">Admin Menerima & Verifikasi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Admin menerima notifikasi dan memverifikasi keaslian serta kelengkapan laporan yang masuk
                    </p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-gray-100 hover:border-[#ff7d26] h-full">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        3
                    </div>
                    <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a202c] mb-3">Update Status & Prioritas</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Admin memperbarui status pengerjaan dan menentukan prioritas berdasarkan tingkat urgensi
                    </p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border-2 border-gray-100 hover:border-[#ff7d26] h-full">
                    <div class="absolute -top-4 -left-4 w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        4
                    </div>
                    <div class="w-16 h-16 bg-[#ffdec8] rounded-2xl flex items-center justify-center mb-6 mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
<section id="role" class="py-24 bg-white">
    <div class="container mx-auto px-6 md:px-20">
        <div class="text-center mb-16 space-y-4">
            <h2 class="text-orange-400 font-bold tracking-wider uppercase text-sm">Fitur Berdasarkan Role</h2>
            <h2 class="text-4xl font-extrabold text-[#1a202c]">Siapa Saja yang Menggunakan?</h2>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                Sistem yang dirancang khusus untuk kebutuhan siswa dan admin
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Untuk Siswa -->
            <div class="bg-gradient-to-br from-orange-50 to-white p-10 rounded-3xl shadow-lg border-2 border-orange-100 hover:shadow-xl transition-all">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1a202c] mb-1">Mengirim Pengaduan</h4>
                            <p class="text-sm text-gray-600">Laporkan kerusakan dengan formulir yang mudah dipahami disertai upload foto</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-orange-100">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1a202c] mb-1">Melihat Status & Feedback</h4>
                            <p class="text-sm text-gray-600">Pantau status laporan dan terima feedback langsung dari admin</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-orange-100">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1a202c] mb-1">Memantau Progres</h4>
                            <p class="text-sm text-gray-600">Lihat perkembangan perbaikan secara real-time di dashboard pribadi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Untuk Admin -->
            <div class="bg-gradient-to-br from-gray-50 to-white p-10 rounded-3xl shadow-lg border-2 border-gray-200 hover:shadow-xl transition-all">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-16 h-16 bg-[#1a202c] rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1a202c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1a202c] mb-1">Mengelola Semua Laporan</h4>
                            <p class="text-sm text-gray-600">Akses, verifikasi, dan atur semua laporan yang masuk dalam satu dashboard</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-200">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1a202c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1a202c] mb-1">Menentukan Prioritas</h4>
                            <p class="text-sm text-gray-600">Set prioritas laporan berdasarkan tingkat urgensi dan dampak kerusakan</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-gray-200">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#1a202c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#1a202c] mb-1">Memberikan Umpan Balik</h4>
                            <p class="text-sm text-gray-600">Komunikasi langsung dengan siswa melalui sistem feedback terintegrasi</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- <section id="cta" class="py-24 bg-gradient-to-br from-[#ff7d26] to-[#ff9d52] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-0 right-4 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="container mx-auto px-6 md:px-20 relative z-10">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-5 py-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-white font-medium text-sm">Sudah Siap Melaporkan?</span>
            </div>

            <h2 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Sudah Menemukan Sarana <br> yang Rusak?
            </h2>

            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Laporkan sekarang agar segera ditangani oleh tim kami. Proses cepat, transparan, dan dapat dipantau kapan saja!
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-6">
                <a href="#" class="group bg-white hover:bg-gray-50 text-[#ff7d26] px-10 py-5 rounded-2xl font-bold text-lg transition-all shadow-2xl hover:shadow-3xl hover:scale-105 flex items-center gap-3">
                    <span>Laporkan Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                
                <a href="#cara-kerja" class="group text-white font-semibold text-lg hover:text-white/80 transition-all flex items-center gap-2">
                    <span>Pelajari Cara Kerjanya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:translate-y-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </a>
            </div>

            <div class="flex items-center justify-center gap-8 pt-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">120K+</div>
                    <div class="text-white/80 text-sm">Laporan Terselesaikan</div>
                </div>
                <div class="w-px h-12 bg-white/30"></div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">98%</div>
                    <div class="text-white/80 text-sm">Kepuasan Pengguna</div>
                </div>
                <div class="w-px h-12 bg-white/30"></div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">24/7</div>
                    <div class="text-white/80 text-sm">Akses Sistem</div>
                </div>
            </div>

        </div>
    </div>
</section> -->

@endsection