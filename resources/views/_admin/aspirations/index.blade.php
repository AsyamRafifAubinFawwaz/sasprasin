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

        <div class="flex items-center gap-2">
            <button type="button" data-hs-overlay="#modal-export-excel"
                class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-emerald-600/20 bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-hidden focus:bg-emerald-700 transition-all shadow-md shadow-emerald-500/20 active:scale-95 cursor-pointer">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10 9 9 9 8 9" />
                </svg>
                Export Excel
            </button>
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

                <div class="w-40 max-w-full relative">
                    <input type="date" name="date" value="{{ request('date') }}" onclick="this.showPicker()"
                        class="py-2 px-3 pe-10 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 shadow-sm [&::-webkit-calendar-picker-indicator]:opacity-0 cursor-pointer">
                    <div
                        class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none text-gray-400 dark:text-neutral-500">
                        @include('_admin._layout.icons.calendar')
                    </div>
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
                    <div
                        class="relative w-full bg-gray-100 dark:bg-neutral-900/50 rounded-2xl overflow-hidden aspect-video shadow-inner border-2 border-dashed border-gray-200 dark:border-neutral-700 flex flex-col items-center justify-center text-center p-6">
                        <div
                            class="size-16 bg-orange-50 dark:bg-orange-900/20 rounded-full flex items-center justify-center mb-3">
                            <svg class="size-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">Kamera Bawaan Perangkat</p>
                        <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest text-center">Gunakan kamera HP
                            Anda secara langsung</p>
                    </div>

                    <label for="admin_camera_input"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-orange-600 text-white hover:bg-orange-700 transition-all active:scale-95 shadow-lg shadow-orange-500/20 cursor-pointer">
                        @include('_toolsman._layout.icons.camera')
                        Buka Kamera
                    </label>
                    <input id="admin_camera_input" name="image" type="file" accept="image/*" capture="environment"
                        class="hidden" onchange="previewImage(this)" />
                </div>

                <!-- Preview Area -->
                <div id="image-preview-container" class="hidden mt-2 relative group w-full">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Preview Foto:</p>
                    <div
                        class="relative rounded-2xl overflow-hidden border border-gray-100 dark:border-neutral-700 bg-black/5 shadow-inner group">
                        <img id="image-preview" src="#" alt="Preview"
                            class="w-full max-h-64 object-contain transition-all duration-300">
                        <div
                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                            <p class="text-white text-[10px] font-bold uppercase tracking-widest">Ganti Foto?</p>
                        </div>
                        <button type="button" onclick="removeImage()"
                            class="absolute top-3 right-3 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 shadow-xl transition-all active:scale-90 z-10">
                            <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <label for="feedback" class="block text-sm font-medium mb-2 dark:text-white">
                    Feedback
                </label>
                <textarea name="feedback" id="modal_feedback" rows="4"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
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

    <x-admin.modal id="modal-export-excel" title="Export Laporan Excel" formId="formExportExcel" method="GET"
        :navigate="false">
        <div class="space-y-4">
            <div
                class="flex items-center gap-x-2 mb-4 bg-emerald-50 dark:bg-emerald-800/10 p-3 rounded-lg border border-emerald-100 dark:border-emerald-800/20">
                <input type="checkbox" id="export_excel_all" name="export_all" value="1"
                    class="shrink-0 border-gray-300 rounded-sm text-emerald-600 focus:ring-emerald-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-emerald-500 dark:checked:border-emerald-500">
                <label for="export_excel_all"
                    class="text-sm font-semibold text-emerald-800 dark:text-emerald-400 cursor-pointer">Export Keseluruhan
                    Data</label>
            </div>

            <div id="excel_filter_options" class="space-y-4 transition-all duration-300">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-white">Tanggal Mulai</label>
                        <input type="date" name="start_date"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-white">Tanggal Selesai</label>
                        <input type="date" name="end_date"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2 dark:text-white">Status</label>
                    <select name="status"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        <option value="">Semua Status</option>
                        <option value="1">Pending</option>
                        <option value="2">In Progress</option>
                        <option value="3">Done</option>
                    </select>
                </div>
            </div>

            <x-slot:footer>
                <button type="button" data-hs-overlay="#modal-export-excel"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                    Batal
                </button>
                <button type="button" onclick="handleExportExcel()"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:bg-emerald-700 disabled:opacity-50 disabled:pointer-events-none active:scale-95 transition-all">
                    Export Excel
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

        function handleExportExcel() {
            const form = document.getElementById('formExportExcel');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            // Trigger download
            window.location.href = `{{ route('admin.aspirations.export_excel') }}?${params}`;

            if (window.Toastify && window.getToastNode) {
                Toastify({
                    node: window.getToastNode("Laporan Excel sedang diproses dan akan segera diunduh."),
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
                HSOverlay.close('#modal-export-excel');
                form.reset();
                const options = document.getElementById('excel_filter_options');
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

        document.getElementById('export_excel_all').addEventListener('change', function() {
            const options = document.getElementById('excel_filter_options');
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
                removeImage();
            }
        }

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
            const fileInput = document.getElementById('modal_image');
            const cameraInput = document.getElementById('admin_camera_input');
            const container = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');

            if (fileInput) fileInput.value = '';
            if (cameraInput) cameraInput.value = '';
            preview.src = '#';
            container.classList.add('hidden');
        }

        // Clean up saat modal ditutup
        const modalElement = document.getElementById('modal-update');
        if (modalElement) {
            modalElement.addEventListener('close.hs.overlay', function() {
                removeImage();
            });
        }
    </script>

@endsection
