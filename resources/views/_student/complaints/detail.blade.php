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

       
@endsection
