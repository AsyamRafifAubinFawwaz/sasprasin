@extends('_admin._layout.app')

@section('title', 'Detail Pengaduan Sarana')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Detail Pengaduan
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Informasi lengkap laporan sarpras
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate href="{{ route('toolsman.aspirations.index') }}"
                    class="py-2.5 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-gray-600 text-white hover:bg-gray-700 focus:outline-hidden transition-all shadow-md shadow-gray-500/20 active:scale-95 cursor-pointer">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    @if (!$data)
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/30 rounded-xl p-6 text-center">
            <h3 class="text-lg font-semibold text-red-900 dark:text-red-100">Data Tidak Ditemukan</h3>
            <p class="text-sm text-red-700 dark:text-red-300 mt-1">Laporan tidak tersedia.</p>
        </div>
    @else
        @php
            $status = $data->status ?? \App\Constants\ProgressConst::PENDING;
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <div class="lg:col-span-8 order-2 lg:order-1">

                <div
                    class="bg-white shadow-sm border border-gray-100 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div
                        class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-[#1e293b] dark:text-neutral-200">Informasi Pengaduan</h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Nama
                                    Siswa</label>
                                <p class="text-sm font-bold text-gray-800 dark:text-neutral-200 transition-colors">
                                    {{ $data->student_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Tanggal
                                    Dibuat</label>
                                <div
                                    class="flex items-center gap-x-2 text-sm font-bold text-gray-800 dark:text-neutral-200">
                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y H:i') }} WIB
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Kategori</label>
                                <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                    {{ $data->category_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Lokasi</label>
                                <div
                                    class="flex items-center gap-x-1.5 text-sm font-bold text-gray-800 dark:text-neutral-200">
                                    <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    {{ $data->location_name ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Deskripsi</label>
                            <div
                                class="bg-gray-50/50 dark:bg-neutral-900/30 border border-gray-100 dark:border-neutral-700 rounded-2xl p-5">
                                <p class="text-sm text-gray-600 dark:text-neutral-400 leading-relaxed">
                                    {{ $data->description }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Prioritas</label>
                                @if ($data->priority == 3)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">Tinggi</span>
                                @elseif($data->priority == 2)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">Sedang</span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">Rendah</span>
                                @endif
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Status
                                    Progres</label>
                                @if ($status == \App\Constants\ProgressConst::PENDING)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500 border border-amber-200/50">
                                        <span class="size-1.5 rounded-full bg-amber-500"></span>Pending
                                    </span>
                                @elseif ($status == \App\Constants\ProgressConst::IN_PROGRESS)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500 border border-blue-200/50">
                                        <span class="size-1.5 rounded-full bg-blue-500 animate-pulse"></span>In Progress
                                    </span>
                                @elseif ($status == \App\Constants\ProgressConst::DONE)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-500 border border-emerald-200/50">
                                        <span class="size-1.5 rounded-full bg-emerald-500"></span>Done
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if ($data->complaint_image)
                            <div class="pb-2">
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-3">Gambar
                                    Pengaduan</label>
                                <div class="cursor-pointer group relative overflow-hidden rounded-2xl"
                                    onclick="zoomImage(event)">
                                    <img src="{{ asset($data->complaint_image) }}" alt="Gambar pengaduan"
                                        class="w-full max-h-[400px] rounded-2xl object-cover border border-gray-100 dark:border-neutral-700 group-hover:scale-[1.02] transition-all duration-500">
                                    <div
                                        class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <div class="p-2 bg-white/20 backdrop-blur-md rounded-full text-white shadow-xl">
                                            <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-gray-400 dark:text-neutral-500 mt-2 font-medium italic">Klik
                                        gambar untuk memperbesar</p>
                                </div>
                            </div>
                        @endif

                        @if ($data->feedback)
                            <div>
                                <label
                                    class="flex items-center gap-x-1.5 text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">
                                    <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                    </svg>
                                    Catatan / Feedback
                                </label>
                                <div
                                    class="bg-blue-50/40 dark:bg-blue-900/10 border border-blue-100/50 dark:border-blue-800/20 rounded-2xl p-5">
                                    <p class="text-sm font-medium text-blue-800 dark:text-blue-300 italic leading-relaxed">
                                        "{{ $data->feedback }}"</p>
                                </div>
                            </div>
                        @endif

                        @if ($data->image)
                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-3">Bukti
                                    Tindak Lanjut</label>
                                <div class="cursor-pointer group relative overflow-hidden rounded-2xl"
                                    onclick="zoomImage(event)">
                                    <img src="{{ asset($data->image) }}" alt="Bukti Tindak Lanjut"
                                        class="w-full max-h-[400px] rounded-2xl object-cover border border-gray-100 dark:border-neutral-700 group-hover:scale-[1.02] transition-all duration-500">
                                    <div
                                        class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                        <div class="p-2 bg-white/20 backdrop-blur-md rounded-full text-white shadow-xl">
                                            <svg class="size-6" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-[10px] text-gray-400 dark:text-neutral-500 mt-2 font-medium italic">Klik
                                        gambar untuk memperbesar</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div
                    class="mt-6 bg-white shadow-sm border border-gray-100 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700">
                        <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Riwayat Progres</h2>
                    </div>
                    <div class="p-6">
                        @if ($timeline->isEmpty())
                            <div class="text-center py-6">
                                <p class="text-sm text-gray-400 italic">Belum ada riwayat perubahan status.</p>
                            </div>
                        @else
                            <ol class="relative border-s border-gray-200 dark:border-neutral-700 ms-3 space-y-8">
                                @foreach ($timeline as $log)
                                    @php
                                        $statusLabels = [
                                            1 => 'Pending',
                                            2 => 'In Progress',
                                            3 => 'Done',
                                            4 => 'Reject',
                                        ];
                                        $newStatusLabel = $statusLabels[$log->new_status] ?? '-';
                                    @endphp
                                    <li class="ms-8 group">
                                        <span
                                            class="absolute flex items-center justify-center size-8 rounded-full -start-4 ring-4 ring-white dark:ring-neutral-800 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 group-hover:scale-110 transition-transform shadow-sm">
                                            <svg class="size-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </span>
                                        <div
                                            class="p-5 bg-gray-50 dark:bg-neutral-900 rounded-2xl border border-gray-100 dark:border-neutral-700 group-hover:shadow-md transition-all duration-300">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">Status:
                                                    {{ $newStatusLabel }}</p>
                                                <span
                                                    class="text-[11px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}</span>
                                            </div>
                                            @if ($log->note)
                                                <p
                                                    class="text-sm text-gray-600 dark:text-neutral-400 leading-relaxed mb-2 font-medium">
                                                    "{{ $log->note }}"</p>
                                            @endif
                                            <div
                                                class="flex items-center gap-x-1.5 pt-2 border-t border-gray-200 dark:border-neutral-800">
                                                <div
                                                    class="size-5 rounded-full bg-gray-200 dark:bg-neutral-800 flex items-center justify-center text-[10px] font-bold text-gray-500">
                                                    {{ strtoupper(substr($log->changed_by_name ?? 'S', 0, 1)) }}</div>
                                                <p
                                                    class="text-[10px] font-bold text-gray-500 dark:text-neutral-500 uppercase tracking-tight">
                                                    Oleh: {{ $log->changed_by_name ?? 'Sistem' }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 order-1 lg:order-2 flex flex-col gap-6">

                @if ($status == \App\Constants\ProgressConst::DONE)
                    <div
                        class="bg-emerald-50/50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-900/30 rounded-2xl p-6 text-center animate-in fade-in zoom-in duration-500">
                        <div
                            class="size-16 bg-white dark:bg-neutral-800 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm border border-emerald-100/50">
                            <svg class="size-8 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-black text-emerald-900 dark:text-emerald-100 uppercase tracking-tight">
                            Tugas Selesai</h3>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-2 font-medium">Laporan ini telah
                            ditangani dan ditutup secara final.</p>
                    </div>
                @else
                    <div
                        class="bg-white shadow-sm border border-gray-100 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700 bg-gray-50/50 dark:bg-neutral-900/10">
                            <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Update Progres</h2>
                        </div>
                        <div class="p-6">
                            @if (session('success'))
                                <div
                                    class="mb-5 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl text-xs font-bold dark:bg-emerald-900/20 dark:border-emerald-800 dark:text-emerald-400 flex items-center gap-2">
                                    <svg class="size-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="text-center py-4">
                                <div
                                    class="size-12 bg-orange-50 dark:bg-orange-900/20 rounded-full flex items-center justify-center mx-auto mb-3 border border-dashed border-orange-200 dark:border-orange-800 text-orange-500">
                                    <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <p class="text-xs font-medium text-gray-500 dark:text-neutral-400 mb-4">Laporkan kemajuan
                                    pengerjaan Anda sekarang.</p>
                                <button type="button" data-hs-overlay="#update-progress-modal"
                                    class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-xs font-bold rounded-xl border border-transparent bg-orange-600 text-white hover:bg-orange-700 shadow-md shadow-orange-500/20 transition-all active:scale-95 cursor-pointer w-full">
                                    Update Status & Bukti
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div
                    class="bg-white shadow-sm border border-gray-100 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 overflow-hidden flex flex-col">
                    <div
                        class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700 bg-gray-50/50 dark:bg-neutral-900/10">
                        <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Profil Pelapor</h2>
                    </div>
                    <div class="p-8">
                        @if ($data->student_name)
                            <div class="flex flex-col items-center">
                                <div
                                    class="size-20 flex items-center justify-center rounded-[2rem] bg-orange-600 text-white text-3xl font-black shadow-xl shadow-orange-500/20 mb-4 transition-transform hover:scale-105 duration-300">
                                    {{ strtoupper(substr($data->student_name, 0, 1)) }}
                                </div>
                                <h3
                                    class="text-lg font-black text-gray-800 dark:text-neutral-200 text-center leading-tight">
                                    {{ $data->student_name }}</h3>
                                @if ($data->nisn)
                                    <div class="mt-2 py-1 px-3 bg-gray-100 dark:bg-neutral-700 rounded-full">
                                        <p class="text-[10px] font-bold text-gray-500 dark:text-neutral-400">NISN:
                                            {{ $data->nisn }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-8 space-y-4">
                                <div
                                    class="bg-gray-50 dark:bg-neutral-900/50 border border-gray-100 dark:border-neutral-700 rounded-2xl p-4 flex items-center gap-x-4">
                                    <div
                                        class="size-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center shadow-sm">
                                        @include('_admin._layout.icons.calendar')
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Ditugaskan
                                        </p>
                                        <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                            {{ \Carbon\Carbon::parse($data->assigned_at)->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <div
                                    class="bg-gray-50 dark:bg-neutral-900/50 border border-gray-100 dark:border-neutral-700 rounded-2xl p-4 flex items-center gap-x-4">
                                    <div
                                        class="size-10 rounded-xl bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center shadow-sm">
                                        @include('_admin._layout.icons.sidebar.task')
                                    </div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">ID Laporan
                                        </p>
                                        <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                            #{{ str_pad($data->complaint_id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <div
                                    class="size-16 bg-gray-50 dark:bg-neutral-900 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-gray-200 dark:border-neutral-700">
                                    <svg class="size-8 text-gray-300 dark:text-neutral-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-400 dark:text-neutral-500">Data siswa tidak
                                    tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-admin.modal id="update-progress-modal" title="Update Progres Laporan" formId="update-progress-form"
        action="{{ route('toolsman.aspirations.do_update', $data->id) }}" enctype="multipart/form-data">
        <div class="space-y-5">
            <div>
                <label
                    class="block text-[10px] font-black text-gray-400 dark:text-neutral-500 uppercase tracking-widest mb-3">Status
                    Pekerjaan</label>
                <div class="grid grid-cols-2 gap-3">
                    <label
                        class="relative flex items-center p-3 rounded-2xl border border-gray-100 dark:border-neutral-700 hover:bg-blue-50/50 dark:hover:bg-neutral-700/50 cursor-pointer transition-all group">
                        <input type="radio" name="status" value="2" class="hidden peer" required
                            {{ $status == \App\Constants\ProgressConst::IN_PROGRESS ? 'checked' : '' }}>
                        <div
                            class="absolute inset-0 rounded-2xl border-2 border-transparent peer-checked:border-blue-500 pointer-events-none transition-all">
                        </div>
                        <div
                            class="size-8 flex items-center justify-center rounded-xl bg-gray-50 dark:bg-neutral-900 text-gray-400 group-hover:text-blue-500 peer-checked:bg-blue-500 peer-checked:text-white transition-all shadow-sm">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-bold text-gray-800 dark:text-neutral-200">Sedang Proses</p>
                        </div>
                    </label>

                    <label
                        class="relative flex items-center p-3 rounded-2xl border border-gray-100 dark:border-neutral-700 hover:bg-emerald-50/50 dark:hover:bg-neutral-700/50 cursor-pointer transition-all group">
                        <input type="radio" name="status" value="3" class="hidden peer" required
                            {{ $status == \App\Constants\ProgressConst::DONE ? 'checked' : '' }}>
                        <div
                            class="absolute inset-0 rounded-2xl border-2 border-transparent peer-checked:border-emerald-500 pointer-events-none transition-all">
                        </div>
                        <div
                            class="size-8 flex items-center justify-center rounded-xl bg-gray-50 dark:bg-neutral-900 text-gray-400 group-hover:text-emerald-500 peer-checked:bg-emerald-500 peer-checked:text-white transition-all shadow-sm">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-bold text-gray-800 dark:text-neutral-200">Selesai (Done)</p>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label
                    class="block text-[10px] font-black text-gray-400 dark:text-neutral-500 uppercase tracking-widest mb-2">Catatan
                    Tindakan</label>
                <textarea name="feedback" rows="3"
                    class="py-3 px-4 block w-full rounded-2xl text-sm border-gray-100 bg-gray-50/50 focus:bg-white focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 transition-all font-medium leading-relaxed"
                    placeholder="Apa yang telah dilakukan?">{{ $data->feedback }}</textarea>
            </div>

            <div>
                <label
                    class="block text-[10px] font-black text-gray-400 dark:text-neutral-500 uppercase tracking-widest mb-2">Foto
                    Bukti Kerja</label>
                <div id="drop-zone"
                    class="relative border-2 border-dashed border-gray-200 dark:border-neutral-700 rounded-2xl p-6 text-center hover:border-orange-500 transition-colors cursor-pointer bg-gray-50/30">
                    <div id="drop-zone-content">
                        <svg class="mx-auto size-10 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-2 text-xs text-gray-600 dark:text-neutral-400 font-bold">Klik atau seret foto
                        </p>
                        <p class="mt-1 text-[10px] text-gray-400">PNG, JPG up to 5MB</p>
                    </div>
                    <div id="preview-container" class="hidden w-full h-full p-0 border-0 overflow-hidden rounded-xl">
                        <div class="relative w-full h-full flex justify-center items-center bg-black/5">
                            <img id="image-preview" class="w-full max-h-48 object-contain shadow-sm" alt="Preview">
                            <button type="button" id="btn-remove"
                                class="absolute top-2 right-2 bg-red-500/90 backdrop-blur-sm text-white rounded-full p-1.5 hover:bg-red-600 shadow-lg z-10 transition-all">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <input type="file" id="image-upload" name="image" accept="image/*" class="hidden">
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <button type="button"
                class="py-2.5 px-4 text-xs font-bold text-gray-500 dark:text-neutral-400 hover:text-gray-700 dark:hover:text-neutral-200 transition-all"
                data-hs-overlay="#update-progress-modal">
                Batal
            </button>
            <button type="submit" form="update-progress-form"
                class="py-2.5 px-6 text-xs font-black rounded-xl bg-orange-600 text-white hover:bg-orange-700 focus:outline-none transition-all active:scale-95 shadow-lg shadow-orange-500/30 uppercase tracking-widest">
                Simpan Perubahan
            </button>
        </x-slot>
    </x-admin.modal>

    <script>
        (function() {
            // Image Upload Logic
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('image-upload');
            const dropZoneContent = document.getElementById('drop-zone-content');
            const previewContainer = document.getElementById('preview-container');
            const previewImg = document.getElementById('image-preview');
            const btnRemove = document.getElementById('btn-remove');

            if (dropZone && fileInput) {
                dropZone.addEventListener('click', () => fileInput.click());

                dropZone.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    dropZone.classList.add('border-orange-500');
                });

                dropZone.addEventListener('dragleave', () => {
                    dropZone.classList.remove('border-orange-500');
                });

                dropZone.addEventListener('drop', (e) => {
                    e.preventDefault();
                    dropZone.classList.remove('border-orange-500');
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        fileInput.files = files;
                        const event = new Event('change');
                        fileInput.dispatchEvent(event);
                    }
                });

                fileInput.addEventListener('change', (e) => {
                    if (e.target.files.length > 0) {
                        const url = URL.createObjectURL(e.target.files[0]);
                        previewImg.src = url;
                        previewContainer.classList.remove('hidden');
                        dropZoneContent.classList.add('hidden');
                        dropZone.classList.remove('p-6', 'border-2', 'border-dashed');
                        dropZone.classList.add('p-0', 'border-0');
                    }
                });

                btnRemove.addEventListener('click', (e) => {
                    e.stopPropagation();
                    fileInput.value = '';
                    previewContainer.classList.add('hidden');
                    dropZoneContent.classList.remove('hidden');
                    dropZone.classList.add('p-6', 'border-2', 'border-dashed');
                    dropZone.classList.remove('p-0', 'border-0');
                    previewImg.src = '';
                });
            }
        })();
    </script>

    <script>
        function zoomImage(event) {
            const img = event.currentTarget.querySelector('img');
            if (!img) return;

            let scale = 1;
            let translateX = 0;
            let translateY = 0;
            let isDragging = false;
            let startX = 0;
            let startY = 0;

            const modal = document.createElement('div');
            modal.className =
                'fixed inset-0 z-[100] bg-black/95 flex items-center justify-center overflow-hidden backdrop-blur-md transition-all duration-300 animate-in fade-in';
            modal.tabIndex = 0;

            const imgContainer = document.createElement('div');
            imgContainer.className = 'relative w-full h-full flex items-center justify-center p-4 sm:p-8';

            const zoomedImg = document.createElement('img');
            zoomedImg.src = img.src;
            zoomedImg.className =
                'max-w-full max-h-full object-contain cursor-grab select-none shadow-2xl transition-transform duration-75 ease-out rounded-lg';
            zoomedImg.style.transform = 'translate(0px, 0px) scale(1)';

            const closeBtn = document.createElement('button');
            closeBtn.className =
                'absolute top-4 right-4 z-[110] size-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95 focus:outline-none border border-white/10';
            closeBtn.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>`;
            closeBtn.onclick = () => modal.remove();

            const infoText = document.createElement('div');
            infoText.className =
                'absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-xs font-medium bg-black/40 px-3 py-1.5 rounded-full backdrop-blur-sm pointer-events-none';
            infoText.innerText = 'Gunakan scroll untuk zoom • Drag untuk geser';

            modal.addEventListener('click', (e) => {
                if (e.target === modal || e.target === imgContainer) modal.remove();
            });

            document.addEventListener('keydown', function esc(e) {
                if (e.key === 'Escape') {
                    modal.remove();
                    document.removeEventListener('keydown', esc);
                }
            });

            modal.addEventListener('wheel', (e) => {
                e.preventDefault();
                const delta = e.deltaY < 0 ? 0.15 : -0.15;
                const newScale = Math.min(Math.max(0.7, scale + delta), 8);

                scale = newScale;
                updateTransform();
            }, {
                passive: false
            });

            const startDrag = (x, y) => {
                isDragging = true;
                startX = x - translateX;
                startY = y - translateY;
                zoomedImg.classList.add('cursor-grabbing');
                zoomedImg.classList.remove('transition-transform');
            };

            const moveDrag = (x, y) => {
                if (!isDragging) return;
                translateX = x - startX;
                translateY = y - startY;
                updateTransform();
            };

            const endDrag = () => {
                isDragging = false;
                zoomedImg.classList.remove('cursor-grabbing');
            };

            zoomedImg.addEventListener('mousedown', (e) => startDrag(e.clientX, e.clientY));
            window.addEventListener('mousemove', (e) => moveDrag(e.clientX, e.clientY));
            window.addEventListener('mouseup', endDrag);
            zoomedImg.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    startDrag(e.touches[0].clientX, e.touches[0].clientY);
                }
            }, {
                passive: true
            });

            window.addEventListener('touchmove', (e) => {
                if (isDragging && e.touches.length === 1) {
                    moveDrag(e.touches[0].clientX, e.touches[0].clientY);
                }
            }, {
                passive: false
            });

            window.addEventListener('touchend', endDrag);

            function updateTransform() {
                zoomedImg.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
            }

            imgContainer.appendChild(zoomedImg);
            modal.appendChild(imgContainer);
            modal.appendChild(closeBtn);
            modal.appendChild(infoText);
            document.body.appendChild(modal);
            modal.focus();
        }
    </script>
@endsection
