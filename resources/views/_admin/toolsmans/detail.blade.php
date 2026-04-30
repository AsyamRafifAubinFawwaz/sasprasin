@extends('_admin._layout.app')

@section('title', 'Detail Petugas')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div class="flex items-center gap-x-3">
            <a navigate href="{{ route('admin.toolsmans.index') }}"
                class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 cursor-pointer">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 19-7-7 7-7" />
                    <path d="M19 12H5" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200">Detail Petugas</h1>
                <p class="text-sm text-gray-400 dark:text-neutral-400">Profil & riwayat tugas petugas lapangan</p>
            </div>
        </div>
       
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

        {{-- Profil Sidebar --}}
        <div class="lg:col-span-1 flex flex-col gap-4">

            {{-- Profile Card --}}
            <div
                class="bg-white dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700 rounded-2xl shadow-sm overflow-hidden">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 px-6 pt-8 pb-12 relative">
                    <div
                        class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 size-16 rounded-full bg-white dark:bg-neutral-800 border-4 border-white dark:border-neutral-800 shadow-md flex items-center justify-center text-orange-600 font-extrabold text-xl">
                        {{ strtoupper(substr($data->name, 0, 1)) }}
                    </div>
                </div>
                <div class="px-6 pt-10 pb-6 text-center">
                    <h2 class="text-base font-bold text-gray-800 dark:text-neutral-200">{{ $data->name }}</h2>
                    <p class="text-xs text-gray-400 dark:text-neutral-500 mt-0.5">{{ $data->email }}</p>
                    <span
                        class="mt-3 inline-flex items-center py-1 px-3 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                        {{ $data->skill ?? 'Umum' }}
                    </span>
                </div>
            </div>

            {{-- Info Card --}}
            <div
                class="bg-white dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700 rounded-2xl shadow-sm p-5 space-y-4">
                <h3 class="text-xs font-black text-gray-400 dark:text-neutral-500 uppercase tracking-widest">Info
                    Kontak</h3>
                <div class="flex items-center gap-x-3">
                    <div
                        class="size-8 rounded-lg bg-gray-50 dark:bg-neutral-900 flex items-center justify-center text-gray-400 shrink-0">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider">No. HP</p>
                        <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                            {{ $data->phone ?? '-' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-x-3">
                    <div
                        class="size-8 rounded-lg bg-gray-50 dark:bg-neutral-900 flex items-center justify-center text-gray-400 shrink-0">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider">Bergabung</p>
                        <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            @php
                $totalTasks = count($tasks);
                $doneTasks = collect($tasks)->where('status', \App\Constants\ProgressConst::DONE)->count();
                $activeTasks = collect($tasks)->where('status', \App\Constants\ProgressConst::IN_PROGRESS)->count();
                $pendingTasks = collect($tasks)->where('status', \App\Constants\ProgressConst::PENDING)->count();
            @endphp
            <div
                class="bg-white dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700 rounded-2xl shadow-sm p-5">
                <h3 class="text-xs font-black text-gray-400 dark:text-neutral-500 uppercase tracking-widest mb-4">
                    Statistik</h3>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 dark:bg-neutral-900 rounded-xl p-3 text-center">
                        <p class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200">{{ $totalTasks }}</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Total Tugas</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-3 text-center">
                        <p class="text-2xl font-extrabold text-green-700 dark:text-green-400">{{ $doneTasks }}</p>
                        <p class="text-[10px] text-green-500 mt-0.5">Selesai</p>
                    </div>
                    <div class="bg-orange-50 dark:bg-orange-900/20 rounded-xl p-3 text-center">
                        <p class="text-2xl font-extrabold text-orange-600 dark:text-orange-400">{{ $activeTasks }}</p>
                        <p class="text-[10px] text-orange-400 mt-0.5">Sedang Proses</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-neutral-900 rounded-xl p-3 text-center">
                        <p class="text-2xl font-extrabold text-gray-500 dark:text-neutral-400">{{ $pendingTasks }}</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Menunggu</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Task History --}}
        <div
            class="lg:col-span-3 bg-white dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700 rounded-2xl shadow-sm flex flex-col">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-gray-800 dark:text-neutral-200">Riwayat Tugas</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Semua keluhan yang pernah ditugaskan</p>
                </div>
                <span
                    class="inline-flex items-center py-1 px-3 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-300">
                    {{ $totalTasks }} keluhan
                </span>
            </div>

            @if ($totalTasks === 0)
                <div class="flex flex-col items-center justify-center py-20 text-center flex-1">
                    <div
                        class="size-16 bg-gray-50 dark:bg-neutral-900 rounded-full flex items-center justify-center mb-4 border border-dashed border-gray-200 dark:border-neutral-700 text-gray-300">
                        <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-500 dark:text-neutral-400">Belum Ada Tugas</p>
                    <p class="text-xs text-gray-400 mt-1">Petugas ini belum pernah mendapat penugasan</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-100 dark:divide-neutral-700">
                        <thead class="bg-gray-50 dark:bg-neutral-700/40">
                            <tr>
                                <th
                                    class="px-5 py-3 text-start text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">
                                    Keluhan</th>
                                <th
                                    class="px-5 py-3 text-start text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">
                                    Pelapor</th>
                                <th
                                    class="px-5 py-3 text-start text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">
                                    Lokasi</th>
                                <th
                                    class="px-5 py-3 text-start text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">
                                    Status</th>
                                <th
                                    class="px-5 py-3 text-start text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">
                                    Ditugaskan</th>
                                <th class="px-5 py-3 text-end"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-neutral-700">
                            @foreach ($tasks as $task)
                                @php
                                    $status = $task->status ?? 1;
                                    $statusMap = [
                                        1 => [
                                            'label' => 'Menunggu',
                                            'class' =>
                                                'bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-300',
                                        ],
                                        2 => [
                                            'label' => 'Sedang Proses',
                                            'class' =>
                                                'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
                                        ],
                                        3 => [
                                            'label' => 'Selesai',
                                            'class' =>
                                                'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                                        ],
                                        4 => [
                                            'label' => 'Ditolak',
                                            'class' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                        ],
                                    ];
                                    $s = $statusMap[$status] ?? $statusMap[1];
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/30 transition-colors">
                                    <td class="px-5 py-3.5">
                                        <p
                                            class="text-sm font-medium text-gray-800 dark:text-neutral-200 line-clamp-2 max-w-xs">
                                            {{ $task->description }}</p>
                                        <p class="text-[10px] text-gray-400 mt-0.5">{{ $task->category_name ?? '-' }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <p class="text-sm text-gray-700 dark:text-neutral-300">
                                            {{ $task->student_name ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <p class="text-sm text-gray-500 dark:text-neutral-400">
                                            {{ $task->location ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center py-1 px-2.5 rounded-full text-xs font-semibold {{ $s['class'] }}">
                                            @if ($status === \App\Constants\ProgressConst::IN_PROGRESS)
                                                <span
                                                    class="size-1.5 rounded-full bg-orange-500 animate-pulse mr-1.5"></span>
                                            @endif
                                            {{ $s['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <span
                                            class="text-xs text-gray-400 dark:text-neutral-500">{{ \Carbon\Carbon::parse($task->assigned_at)->format('d M Y, H:i') }}</span>
                                    </td>
                                    <td class="px-5 py-3.5 text-end">
                                        <a navigate href="{{ route('admin.aspirations.detail', $task->id) }}"
                                            class="py-1.5 px-3 inline-flex items-center gap-x-1.5 text-xs font-semibold rounded-lg border border-orange-200 text-orange-600 hover:bg-orange-50 dark:border-orange-800/30 dark:text-orange-400 dark:hover:bg-orange-900/20 transition-all">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
