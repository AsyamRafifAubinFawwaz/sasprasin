@extends('_admin._layout.app')

@section('title', 'Pengaduan Sarana')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data Pengaduan Sarana
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Manajemen Pengaduan Sarana dan Prasarana
            </p>
        </div>

        <div>
            <button type="button" data-hs-overlay="#modal-export-pdf"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 focus:outline-hidden focus:bg-orange-700 transition-all shadow-md shadow-orange-500/20 active:scale-95 cursor-pointer">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10 9 9 9 8 9" />
                </svg>
                Export PDF
            </button>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <div class="px-2 pt-2">
            <form method="GET" action="{{ route('admin.aspirations.index') }}" class="flex flex-wrap items-center gap-3"
                navigate-form>

                <div class="relative w-64 max-w-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 shadow-sm"
                        placeholder="Cari data...">
                </div>

                <div class="w-40 max-w-full">
                    <input type="date" name="date" value="{{ request('date') }}"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 shadow-sm">
                </div>

                {{-- <div class="w-44 max-w-full">
                    <select name="location"
                        data-hs-select='{
                                "placeholder": "Lokasi",
                                "toggleTag": "<button type=\"button\"></button>",
                                "toggleClasses": "py-2 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 shadow-sm",
                                "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                                "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                                "optionSelectedClasses": "bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-400"
                            }'>
                        <option value="">Semua Lokasi</option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}"
                                {{ request('location') == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="w-44 max-w-full">
                    <select name="facility_category_id"
                        data-hs-select='{
                                "placeholder": "Kategori Fasilitas",
                                "toggleTag": "<button type=\"button\"></button>",
                                "toggleClasses": "py-2 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 shadow-sm",
                                "dropdownClasses": "mt-2 z-50 w-full max-h-60 overflow-y-auto bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                                "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                                "optionSelectedClasses": "bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-400"
                            }'>
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('facility_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-44 max-w-full">
                    <select name="priority"
                        data-hs-select='{
                                "placeholder": "Prioritas",
                                "toggleTag": "<button type=\"button\"></button>",
                                "toggleClasses": "py-2 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 shadow-sm",
                                "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                                "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                                "optionSelectedClasses": "bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-400"
                            }'>
                        <option value="">Semua Prioritas</option>
                        <option value="1" {{ request('priority') == 1 ? 'selected' : '' }}>Rendah</option>
                        <option value="2" {{ request('priority') == 2 ? 'selected' : '' }}>Sedang</option>
                        <option value="3" {{ request('priority') == 3 ? 'selected' : '' }}>Tinggi</option>
                    </select>
                </div>

                <div class="w-44 max-w-full">
                    <select name="status"
                        data-hs-select='{
                                    "placeholder": "Status",
                                    "toggleTag": "<button type=\"button\"></button>",
                                    "toggleClasses": "py-2 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 shadow-sm",
                                    "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                                    "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                                    "optionSelectedClasses": "bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-400"
                                }'>
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Pending</option>
                        <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="py-2 px-6 text-sm font-bold rounded-lg bg-orange-600 text-white hover:bg-orange-700 cursor-pointer flex items-center justify-center gap-x-2 transition-all active:scale-95 shadow-md shadow-orange-500/20">
                        @include('_admin._layout.icons.search')
                        Cari
                    </button>

                    @if (request()->hasAny(['priority', 'status', 'search', 'date', 'location', 'facility_category_id']) &&
                            array_filter(request()->only(['priority', 'status', 'search', 'date', 'location', 'facility_category_id'])))
                        <a href="{{ route('admin.aspirations.index') }}"
                            class="py-2 px-4 text-sm font-semibold rounded-lg border border-orange-600/20 text-orange-600 hover:bg-orange-50 dark:hover:bg-orange-900/10 cursor-pointer flex items-center justify-center gap-x-2 transition-all active:scale-95">
                            @include('_admin._layout.icons.reset')
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <div class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-lg dark:border-neutral-700">
                        <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Tanggal
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Kategori
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Lokasi
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Nama Siswa
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Prioritas
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
                                @forelse($data as $d)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                    {{ $d->category_name }}
                                                </span>
                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                    {{ $d->example_items }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $d->location }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $d->student_name ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                @if ($d->priority == 3)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                                        Tinggi
                                                    </span>
                                                @elseif($d->priority == 2)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">
                                                        Sedang
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                                                        Rendah
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                @if ($d->status == \App\Constants\ProgressConst::PENDING)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">
                                                        <span class="size-1.5 rounded-full bg-amber-500"></span>
                                                        Pending
                                                    </span>
                                                @elseif ($d->status == \App\Constants\ProgressConst::IN_PROGRESS)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                        <span class="size-1.5 rounded-full bg-blue-500"></span>
                                                        In Progress
                                                    </span>
                                                @elseif ($d->status == \App\Constants\ProgressConst::DONE)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-500">
                                                        <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                        Done
                                                    </span>
                                                @elseif ($d->status == \App\Constants\ProgressConst::REJECT)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                                        <span class="size-1.5 rounded-full bg-red-500"></span>
                                                        Reject
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white">
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">
                                                <a navigate
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20"
                                                    href="{{ route('admin.aspirations.detail', $d->id) }}"
                                                    title="Lihat Detail">
                                                    @include('_admin._layout.icons.view_detail')
                                                </a>
                                                <button type="button"
                                                    onclick="openModal({{ $d->id }}, '{{ $d->status }}', '{{ addslashes($d->feedback ?? '') }}')"
                                                    data-hs-overlay="#modal-update"
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-green-100 text-green-800 hover:bg-green-200 focus:outline-none focus:bg-green-200 disabled:opacity-50 disabled:pointer-events-none dark:text-green-400 dark:bg-green-800/30 dark:hover:bg-green-800/20 dark:focus:bg-green-800/20 cursor-pointer"
                                                    title="Proses">
                                                    @include('_admin._layout.icons.pencil')
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-500">
                                            <x-admin.empty-state />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (count($data) > 0 && $data->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-700">
                            <div class="flex justify-end">
                                {{ $data->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-admin.modal id="modal-update" title="Update Pengaduan" formId="formUpdate" enctype="multipart/form-data">
        <div class="space-y-4">
            <div>
                <label for="status" class="block text-sm font-medium mb-2 dark:text-white">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" id="modal_status" required onchange="handleStatusChange(this.value)"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <option value="1">Pending</option>
                    <option value="2">In Progress</option>
                    <option value="3">Done</option>
                    <option value="4">Reject</option>
                </select>
            </div>

            <div id="section-upload" class="hidden space-y-4">
                <label for="image" class="block text-sm font-medium mb-2 dark:text-white">
                    Bukti Pendukung (Gambar) <span class="text-xs font-normal text-gray-500">(Hanya jika selesai)</span>
                </label>

                <!-- Tab Pilihan Source -->
                <div class="flex p-1 bg-gray-100 dark:bg-neutral-700 rounded-lg mb-3">
                    <button type="button" onclick="switchUploadMode('file')" id="btn-mode-file"
                        class="flex-1 py-1 text-sm font-medium rounded-md bg-white text-gray-800 shadow-sm dark:bg-neutral-600 dark:text-white transition-all">
                        Upload File
                    </button>
                    <button type="button" onclick="switchUploadMode('camera')" id="btn-mode-camera"
                        class="flex-1 py-1 text-sm font-medium rounded-md text-gray-500 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 transition-all">
                        Ambil Foto
                    </button>
                </div>

                <!-- Mode File Upload -->
                <div id="mode-file" class="flex items-center justify-center w-full">
                    <label for="modal_image"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-600 dark:hover:border-neutral-500 dark:hover:bg-neutral-700 transition-all">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-500 dark:text-neutral-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-neutral-400"><span class="font-semibold">Klik
                                    untuk upload</span></p>
                            <p class="text-xs text-gray-500 dark:text-neutral-400">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                        </div>
                        <input id="modal_image" name="image" type="file" class="hidden" accept="image/*"
                            onchange="previewImage(this)" />
                    </label>
                </div>

                <!-- Mode Kamera -->
                <div id="mode-camera" class="hidden flex-col items-center justify-center w-full gap-3">
                    <div class="relative w-full bg-black rounded-lg overflow-hidden aspect-video">
                        <video id="camera-stream" class="w-full h-full object-cover" autoplay playsinline></video>
                        <canvas id="camera-canvas" class="hidden"></canvas>
                        <div id="camera-placeholder"
                            class="absolute inset-0 flex items-center justify-center text-white/50 bg-neutral-800">
                            <p class="text-sm">Kamera tidak aktif</p>
                        </div>
                    </div>

                    <div class="flex w-full gap-2">
                        <button type="button" onclick="startCamera()" id="btn-start-camera"
                            class="flex-1 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                <circle cx="12" cy="13" r="4" />
                            </svg>
                            Mulai Kamera
                        </button>
                        <button type="button" onclick="takePhoto()" id="btn-take-photo"
                            class="hidden flex-1 py-2 px-3 justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="16" />
                                <line x1="8" y1="12" x2="16" y2="12" />
                            </svg>
                            Ambil Foto
                        </button>
                        <button type="button" onclick="switchCamera()" id="btn-switch-camera"
                            class="hidden py-2 px-3 justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-gray-600 text-white hover:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none transition-all"
                            title="Ganti Kamera">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Preview Area -->
                <div id="image-preview-container" class="hidden mt-4 relative group w-full">
                    <p class="text-xs font-semibold text-gray-500 mb-2 dark:text-neutral-400">Preview:</p>
                    <img id="image-preview" src="#" alt="Preview"
                        class="max-h-64 rounded-lg mx-auto shadow-md object-contain border border-gray-200 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800">
                    <button type="button" onclick="removeImage()"
                        class="absolute top-8 right-2 bg-red-500/80 hover:bg-red-600 text-white rounded-full p-1.5 backdrop-blur-sm transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <div>
                <label for="feedback" class="block text-sm font-medium mb-2 dark:text-white">
                    Feedback
                </label>
                <textarea name="feedback" id="modal_feedback" rows="4"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                    placeholder="Berikan feedback untuk pengaduan ini..."></textarea>
            </div>
        </div>
    </x-admin.modal>

    <x-admin.modal id="modal-export-pdf" title="Export Laporan PDF" formId="formExportPdf" method="GET"
        :navigate="false">
        <div class="space-y-4">
            <div
                class="flex items-center gap-x-2 mb-4 bg-orange-50 dark:bg-orange-800/10 p-3 rounded-lg border border-orange-100 dark:border-orange-800/20">
                <input type="checkbox" id="export_all" name="export_all" value="1"
                    class="shrink-0 border-gray-300 rounded-sm text-orange-600 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-orange-500 dark:checked:border-orange-500">
                <label for="export_all"
                    class="text-sm font-semibold text-orange-800 dark:text-orange-400 cursor-pointer">Export Keseluruhan
                    Data</label>
            </div>

            <div id="filter_options" class="space-y-4 transition-all duration-300">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-white">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-white">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2 dark:text-white">Status</label>
                    <select name="status" id="export_status"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        <option value="">Semua Status</option>
                        <option value="1">Pending</option>
                        <option value="2">In Progress</option>
                        <option value="3">Done</option>
                    </select>
                </div>
            </div>

            <x-slot:footer>
                <button type="button" data-hs-overlay="#modal-export-pdf"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                    Batal
                </button>
                <button type="button" onclick="handleExportPdf()"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none active:scale-95 transition-all">
                    Export PDF
                </button>
            </x-slot:footer>
        </div>
    </x-admin.modal>

    <script>
        function handleExportPdf() {
            const form = document.getElementById('formExportPdf');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            // Trigger download
            window.location.href = `{{ route('admin.aspirations.export_pdf') }}?${params}`;

            if (window.Toastify && window.getToastNode) {
                Toastify({
                    node: window.getToastNode("Laporan PDF sedang diproses dan akan segera diunduh."),
                    duration: 3000,
                    className: "p-0",
                    style: {
                        background: "transparent",
                        boxShadow: "none"
                    },
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                }).showToast();
            }

            // Close modal after export
            setTimeout(() => {
                HSOverlay.close('#modal-export-pdf');
                form.reset();
                const options = document.getElementById('filter_options');
                options.classList.remove('opacity-50', 'pointer-events-none');
                options.querySelectorAll('input, select').forEach(i => i.disabled = false);
            }, 100);
        }

        document.getElementById('export_all').addEventListener('change', function() {
            const options = document.getElementById('filter_options');
            const inputs = options.querySelectorAll('input, select');
            if (this.checked) {
                options.classList.add('opacity-50', 'pointer-events-none');
                inputs.forEach(i => i.disabled = true);
            } else {
                options.classList.remove('opacity-50', 'pointer-events-none');
                inputs.forEach(i => i.disabled = false);
            }
        });

        function openModal(id, status, feedback) {
            document.getElementById('modal_status').value = status;
            document.getElementById('modal_feedback').value = feedback || '';

            // Handle visibility section upload
            handleStatusChange(status);

            // Reset image input dan preview
            removeImage();

            // Reset ke mode file default
            switchUploadMode('file');

            document.getElementById('formUpdate').action = `/admin/aspirations/update/${id}`;
        }

        function handleStatusChange(status) {
            const sectionUpload = document.getElementById('section-upload');
            if (parseInt(status) === 3) { // 3 is DONE
                sectionUpload.classList.remove('hidden');
            } else {
                sectionUpload.classList.add('hidden');
                stopCamera();
                removeImage();
            }
        }

        // Camera Variables
        let stream = null;
        let currentCamera = 'environment';

        function switchUploadMode(mode) {
            const btnFile = document.getElementById('btn-mode-file');
            const btnCamera = document.getElementById('btn-mode-camera');
            const modeFile = document.getElementById('mode-file');
            const modeCamera = document.getElementById('mode-camera');

            if (mode === 'file') {
                btnFile.classList.add('bg-white', 'text-gray-800', 'shadow-sm', 'dark:bg-neutral-600', 'dark:text-white');
                btnFile.classList.remove('text-gray-500', 'hover:text-gray-800', 'dark:text-neutral-400',
                    'dark:hover:text-neutral-200');

                btnCamera.classList.remove('bg-white', 'text-gray-800', 'shadow-sm', 'dark:bg-neutral-600',
                    'dark:text-white');
                btnCamera.classList.add('text-gray-500', 'hover:text-gray-800', 'dark:text-neutral-400',
                    'dark:hover:text-neutral-200');

                modeFile.classList.remove('hidden');
                modeFile.classList.add('flex');
                modeCamera.classList.add('hidden');
                modeCamera.classList.remove('flex');

                stopCamera();
            } else {
                btnCamera.classList.add('bg-white', 'text-gray-800', 'shadow-sm', 'dark:bg-neutral-600', 'dark:text-white');
                btnCamera.classList.remove('text-gray-500', 'hover:text-gray-800', 'dark:text-neutral-400',
                    'dark:hover:text-neutral-200');

                btnFile.classList.remove('bg-white', 'text-gray-800', 'shadow-sm', 'dark:bg-neutral-600',
                    'dark:text-white');
                btnFile.classList.add('text-gray-500', 'hover:text-gray-800', 'dark:text-neutral-400',
                    'dark:hover:text-neutral-200');

                modeCamera.classList.remove('hidden');
                modeCamera.classList.add('flex');
                modeFile.classList.add('hidden');
                modeFile.classList.remove('flex');
            }
        }

        async function startCamera() {
            const video = document.getElementById('camera-stream');
            const placeholder = document.getElementById('camera-placeholder');
            const btnStart = document.getElementById('btn-start-camera');
            const btnTake = document.getElementById('btn-take-photo');
            const btnSwitch = document.getElementById('btn-switch-camera');

            try {
                if (stream) {
                    stopCamera();
                }

                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: currentCamera,
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
                        }
                    }
                });

                video.srcObject = stream;

                video.onloadedmetadata = () => {
                    placeholder.classList.add('hidden');
                    btnStart.classList.add('hidden');
                    btnTake.classList.remove('hidden');
                    btnSwitch.classList.remove('hidden');
                };
            } catch (err) {
                console.error("Gagal mengakses kamera:", err);
                let msg = "Tidak dapat mengakses kamera. Pastikan izin kamera diberikan.";
                if (location.protocol !== 'https:' && location.hostname !== 'localhost') {
                    msg += " (Fitur kamera butuh HTTPS)";
                }

                if (window.Toastify) {
                    Toastify({
                        text: msg,
                        duration: 4000,
                        style: {
                            background: "#EF4444"
                        }, // Red color
                        gravity: "top",
                        position: "right",
                    }).showToast();
                } else {
                    alert(msg);
                }
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }

            const video = document.getElementById('camera-stream');
            if (video) video.srcObject = null;

            document.getElementById('camera-placeholder').classList.remove('hidden');
            document.getElementById('btn-start-camera').classList.remove('hidden');
            document.getElementById('btn-take-photo').classList.add('hidden');
            document.getElementById('btn-switch-camera').classList.add('hidden');
        }

        function switchCamera() {
            currentCamera = currentCamera === 'user' ? 'environment' : 'user';
            startCamera();
        }

        function takePhoto() {
            const video = document.getElementById('camera-stream');
            const canvas = document.getElementById('camera-canvas');

            if (!stream) return;

            // Set ukuran canvas sama dengan video asli
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Konversi ke file Blob
            canvas.toBlob((blob) => {
                const file = new File([blob], "camera_capture_" + Date.now() + ".jpg", {
                    type: "image/jpeg"
                });

                // Masukkan ke input file element
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                const fileInput = document.getElementById('modal_image');
                fileInput.files = dataTransfer.files;

                // Trigger preview
                previewImage(fileInput);

                // Matikan kamera dan kembali ke preview
                stopCamera();
                // switchUploadMode('file'); // Optional: kembali ke mode file atau tetap

                if (window.Toastify && window.getToastNode) {
                    Toastify({
                        node: window.getToastNode("Foto berhasil diambil!"),
                        duration: 3000,
                        className: "p-0",
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                    }).showToast();
                }
            }, 'image/jpeg', 0.85); // Quality 0.85
        }

        function previewImage(input) {
            const container = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                container.classList.add('hidden');
            }
        }

        function removeImage() {
            const input = document.getElementById('modal_image');
            const container = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');

            input.value = '';
            preview.src = '#';
            container.classList.add('hidden');

            // Jika sedang mode kamera tapi sudah ada foto, saat dihapus biarkan kamera mati dulu (harus start lagi)
            // Atau biarkan user menekan start lagi

            // Optional: reset ke mode file jika preferensi UX begitu
            // switchUploadMode('file');
        }

        // Clean up kamera saat modal ditutup
        const modalElement = document.getElementById('modal-update');
        if (modalElement) {
            modalElement.addEventListener('close.hs.overlay', function() {
                stopCamera();
                removeImage();
            });
        }
    </script>

@endsection
