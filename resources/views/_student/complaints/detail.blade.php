@extends('_student._layout.app')

@section('title', 'Detail ' . $page['title'])

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Detail {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Informasi lengkap tentang keluhan Anda
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate href="{{ route('student.complaints.index') }}"
                    class="py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-gray-600 text-white hover:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-700 transition-all shadow-md shadow-gray-500/20 active:scale-95 cursor-pointer">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Informasi Keluhan
                    </h2>
                </div>

                <div class="p-6 space-y-6">
                    {{-- Image --}}
                    @if ($data->image)
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Gambar</label>
                            <img src="{{ asset($data->image) }}" alt="Gambar keluhan" class="w-full rounded-lg max-h-80 object-cover">
                        </div>
                    @endif

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Kategori</label>
                        <p class="text-gray-600 dark:text-neutral-400">{{ $data->category_name ?? 'N/A' }}</p>
                    </div>

                    {{-- Location --}}
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Lokasi</label>
                        <p class="text-gray-600 dark:text-neutral-400">{{ $data->location }}</p>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Deskripsi</label>
                        <p class="text-gray-600 dark:text-neutral-400 whitespace-pre-wrap">{{ $data->description }}</p>
                    </div>

                    {{-- Created At --}}
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Tanggal Dibuat</label>
                        <p class="text-gray-600 dark:text-neutral-400">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</p>
                    </div>

                    {{-- Updated At --}}
                    @if ($data->updated_at && $data->updated_at !== $data->created_at)
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Terakhir Diperbarui</label>
                            <p class="text-gray-600 dark:text-neutral-400">{{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y H:i') }}</p>
                        </div>
                    @endif

                    {{-- Progress Status from Aspirations --}}
                    @if ($data->aspiration_status)
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Status Progres</label>
                            <div class="inline-block">
                                @php
                                    $statusColors = [
                                        1 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-200',
                                        2 => 'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-200',
                                        3 => 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-200',
                                    ];
                                    $statusLabels = [
                                        1 => 'Pending',
                                        2 => 'In Progress',
                                        3 => 'Done',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$data->aspiration_status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$data->aspiration_status] ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    @endif

                    {{-- Feedback from Aspirations --}}
                    @if ($data->aspiration_feedback)
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Feedback</label>
                            <p class="text-gray-600 dark:text-neutral-400 whitespace-pre-wrap">{{ $data->aspiration_feedback }}</p>
                        </div>
                    @endif
                </div>

                {{-- Footer --}}

            </div>
        </div>

        <!-- Sidebar / Timeline -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700 h-full">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Timeline Status
                    </h2>
                </div>
                <div class="p-6">
                    @if(count($logs) > 0)
                        <div class="relative space-y-6 after:absolute after:inset-y-0 after:start-3.5 after:w-0.5 after:-translate-x-px after:bg-gray-200 dark:after:bg-neutral-700">
                            @foreach($logs as $log)
                                <div class="relative ps-8 group">
                                    <div class="absolute start-0 top-0 size-7">
                                        @php
                                            $iconColors = [
                                                1 => 'bg-yellow-500',
                                                2 => 'bg-blue-500',
                                                3 => 'bg-green-500',
                                            ];
                                        @endphp
                                        <div class="relative z-10 size-7 flex justify-center items-center rounded-full {{ $iconColors[$log->new_status] ?? 'bg-gray-500' }} text-white shadow-md">
                                            @if($log->new_status == 1)
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                            @elseif($log->new_status == 2)
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path d="m16.2 16.2 2.9 2.9"/><path d="M12 18v4"/><path d="m4.9 19.1 2.9-2.9"/><path d="M2 12h4"/><path d="m4.9 4.9 2.9 2.9"/></svg>
                                            @else
                                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="pt-0.5">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-neutral-500">
                                                {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}
                                            </span>
                                        </div>

                                        <h3 class="font-bold text-gray-800 dark:text-neutral-200">
                                            @php
                                                $statusLabels = [
                                                    1 => 'Pending',
                                                    2 => 'In Progress',
                                                    3 => 'Done',
                                                ];
                                            @endphp
                                            Status: {{ $statusLabels[$log->new_status] ?? 'Unknown' }}
                                        </h3>

                                        @if($log->note)
                                            <div class="mt-1 p-2 bg-gray-50 dark:bg-neutral-900/50 rounded-lg border border-gray-100 dark:border-neutral-700 text-sm italic text-gray-600 dark:text-neutral-400">
                                                "{{ $log->note }}"
                                            </div>
                                        @endif

                                        <p class="mt-1 text-xs text-gray-400 dark:text-neutral-500">
                                            Diperbarui oleh: <span class="font-medium text-gray-600 dark:text-neutral-300">{{ $log->changer_name }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div class="size-16 bg-gray-100 dark:bg-neutral-700 rounded-full flex items-center justify-center mb-4">
                                <svg class="size-8 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10"/></svg>
                            </div>
                            <p class="text-gray-500 dark:text-neutral-400 font-medium">Belum ada pembaruan status</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
