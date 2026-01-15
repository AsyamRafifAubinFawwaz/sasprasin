@extends('_landing._layout.app')

@section('title', 'Landing')


<section id="beranda" class="hero-section w-full min-h-screen flex items-center bg-[#f8f9fa] overflow-hidden pt-10">
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
                    Sistem Aspirasi dan Prasangka. Kami menyediakan berbagai layanan untuk mempermudah manajemen aspirasi Anda secara digital dan efisien.
                </p>

                <div class="flex items-center gap-6 pt-4">
                    <a href="#" class="bg-[#ff7d26] hover:bg-[#d55500] text-white px-8 py-4 rounded-2xl font-semibold transition-all shadow-lg shadow-purple-200">
                        Login Terlebih Dahulu
                    </a>
                    <a href="#" class="flex items-center gap-2 text-[#ff7d26] font-semibold hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Laporkan Sekarang
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
            
            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100">
                <div class="w-12 h-12 bg-[ff7d26]-50 rounded-xl flex items-center justify-center mb-6 text-[ff7d26]">
                   @include('_landing._layout.icons.photo')
                </div>
                <h3 class="text-xl font-bold text-[#1a202c] mb-3">Lapor dengan Foto</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                   Siswa dapat mengirim laporan disertai foto kerusakan.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100">
                <div class="w-12 h-12 bg-[ff7d26]-50 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#1a202c] mb-3">Status & Prioritas</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Setiap laporan akan diberikan status dan prioritas.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100">
                <div class="w-12 h-12 bg-[ff7d26]-50 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#1a202c] mb-3">Update Real-Time</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Update status dan prioritas langsung di dashboard.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-100">
                <div class="w-12 h-12 bg-[ff7d26]-50 rounded-xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[ff7d26]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
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
                    <img src="{{ asset('/image/problem-illustration.png') }}" alt="Problem Illustration" class="relative rounded-3xl shadow-2xl">
                </div>
            </div>

            <div class="w-full md:w-1/2 space-y-8">
                <div class="space-y-4">
                    <h2 class="text-indigo-600 font-bold tracking-wider uppercase text-sm">Masalah & Solusi</h2>
                    <h2 class="text-4xl font-extrabold text-[#1a202c] leading-tight">
                        Kenapa aplikasi ini dibuat?
                    </h2>
                    <p class="text-gray-500 text-lg">
                        Kami sadar kalau proses pelaporan manual itu ribet banget dan sering bikin frustasi.
                    </p>
                </div>

                <div class="grid gap-6">
                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                        <span class="text-2xl">❌</span>
                        <div>
                            <h4 class="font-bold text-gray-800">Laporan Sering Ghosting</h4>
                            <p class="text-sm text-gray-600">Pengaduan sering lupa atau malah nggak ditindaklanjuti sama sekali.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                        <span class="text-2xl">❌</span>
                        <div>
                            <h4 class="font-bold text-gray-800">Status Kagak Jelas</h4>
                            <p class="text-sm text-gray-600">Siswa nggak tahu progresnya udah sampe mana, diperbaiki atau belum.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-2xl bg-red-50 border border-red-100 transition-all hover:scale-[1.02]">
                        <span class="text-2xl">❌</span>
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
