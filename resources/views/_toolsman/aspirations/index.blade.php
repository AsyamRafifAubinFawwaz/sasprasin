@extends('_admin._layout.app')

@section('title', 'Data Aspirasi & Tugas')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data Aspirasi & Tugas
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Laporan sarana yang ditugaskan kepada Anda
            </p>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <div class="px-2 pt-2">
            <form method="GET" action="{{ route('toolsman.aspirations.index') }}" class="flex flex-wrap items-center gap-3"
                navigate-form>

                <div class="relative w-64 max-w-full">
                    <input type="text" name="keywords" value="{{ $keywords ?? request('keywords') }}"
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

                <div class="w-44 max-w-full">
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
                </div>

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

                    @if (request()->hasAny(['priority', 'status', 'keywords', 'search', 'date', 'location', 'facility_category_id']) &&
                            array_filter(request()->only(['priority', 'status', 'keywords', 'search', 'date', 'location', 'facility_category_id'])))
                        <a href="{{ route('toolsman.aspirations.index') }}"
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
                    <div
                        class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-lg dark:border-neutral-700 shadow-sm">
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
                                    <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors">
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm text-gray-800 dark:text-neutral-200 font-medium">
                                                    {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span class="block text-sm font-bold text-gray-800 dark:text-neutral-200">
                                                    {{ $d->category_name }}
                                                </span>
                                                @if ($d->example_items)
                                                    <span
                                                        class="block text-[11px] text-gray-500 dark:text-neutral-500 font-medium leading-tight mt-0.5">
                                                        {{ $d->example_items }}
                                                    </span>
                                                @endif
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
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-[11px] font-bold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                                        Tinggi
                                                    </span>
                                                @elseif($d->priority == 2)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-[11px] font-bold bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">
                                                        Sedang
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-[11px] font-bold bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                                                        Rendah
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                @if ($d->status == \App\Constants\ProgressConst::PENDING)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500 border border-amber-200/50">
                                                        <span class="size-1.5 rounded-full bg-amber-500"></span>
                                                        Pending
                                                    </span>
                                                @elseif ($d->status == \App\Constants\ProgressConst::IN_PROGRESS)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500 border border-blue-200/50">
                                                        <span
                                                            class="size-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                                        In Progress
                                                    </span>
                                                @elseif ($d->status == \App\Constants\ProgressConst::DONE)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-500 border border-emerald-200/50">
                                                        <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                        Done
                                                    </span>
                                                @elseif ($d->status == \App\Constants\ProgressConst::REJECT)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500 border border-red-200/50">
                                                        <span class="size-1.5 rounded-full bg-red-500"></span>
                                                        Reject
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">
                                                <button type="button"
                                                    onclick="openModal({{ $d->id }}, {{ $d->status }}, '{{ addslashes($d->feedback ?? '') }}')"
                                                    class="py-2.5 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-green-100 text-green-800 hover:bg-green-200 focus:outline-none focus:bg-green-200 disabled:opacity-50 disabled:pointer-events-none dark:text-green-400 dark:bg-green-800/30 dark:hover:bg-green-800/20 dark:focus:bg-green-800/20 cursor-pointer"
                                                    title="Proses Cepat">
                                                    @include('_admin._layout.icons.pencil')
                                                </button>
                                                <a navigate
                                                    class="py-2.5 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 transition-all active:scale-95 dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20"
                                                    href="{{ route('toolsman.aspirations.detail', $d->id) }}"
                                                    title="Lihat Detail">
                                                    @include('_admin._layout.icons.view_detail')
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="px-6 py-12 text-center text-sm text-gray-500 dark:text-neutral-500">
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

    {{-- Modal Update Progres --}}
    <x-admin.modal id="modal-update" title="Update Progres Laporan" formId="formUpdate" enctype="multipart/form-data">
        <div class="space-y-4">
            <div>
                <label for="status" class="block text-sm font-medium mb-2 dark:text-white">
                    Status Pekerjaan <span class="text-red-500">*</span>
                </label>
                <select name="status" id="modal_status" required onchange="handleStatusChange(this.value)"
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 font-bold">
                    <option value="2">Sedang Proses</option>
                    <option value="3">Selesai (Done)</option>
                </select>
            </div>

            <div id="section-upload" class="hidden space-y-4">
                <label for="image" class="block text-sm font-medium mb-2 dark:text-white">
                    Bukti Hasil Pekerjaan <span class="text-xs font-normal text-gray-400">(Wajib jika selesai)</span>
                </label>

                <div class="flex p-1 bg-gray-100 dark:bg-neutral-700/50 rounded-xl mb-3">
                    <button type="button" onclick="switchUploadMode('file')" id="btn-mode-file"
                        class="flex-1 py-1.5 text-xs font-bold rounded-lg bg-white text-gray-800 shadow-sm dark:bg-neutral-600 dark:text-white transition-all">
                        Upload File
                    </button>
                    <button type="button" onclick="switchUploadMode('camera')" id="btn-mode-camera"
                        class="flex-1 py-1.5 text-xs font-bold rounded-lg text-gray-500 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 transition-all">
                        Ambil Foto
                    </button>
                </div>

                <div id="mode-file" class="flex items-center justify-center w-full">
                    <label for="modal_image"
                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50/50 hover:bg-gray-100 dark:bg-neutral-800 dark:border-neutral-700 dark:hover:border-neutral-600 transition-all">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-xs text-gray-500"><span class="font-bold">Klik untuk browse</span></p>
                            <p class="text-[10px] text-gray-400 uppercase">PNG, JPG (MAX. 5MB)</p>
                        </div>
                        <input id="modal_image" name="image" type="file" class="hidden" accept="image/*"
                            onchange="previewImage(this)" />
                    </label>
                </div>

                <div id="mode-camera" class="hidden flex-col items-center justify-center w-full gap-3">
                    <div
                        class="relative w-full bg-gray-100 dark:bg-neutral-900/50 rounded-2xl overflow-hidden aspect-video shadow-inner border-2 border-dashed border-gray-200 dark:border-neutral-700 flex flex-col items-center justify-center text-center p-6">
                        <div
                            class="size-16 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center mb-3">
                            <svg class="size-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                    <label for="camera_input"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-all active:scale-95 shadow-lg shadow-blue-500/20 cursor-pointer">
                        @include('_toolsman._layout.icons.camera')
                        Buka Kamera
                    </label>
                    <input id="camera_input" name="image" type="file" accept="image/*" capture="environment"
                        class="hidden" onchange="previewImage(this)" />
                </div>

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
                    Catatan Tindakan
                </label>
                <textarea name="feedback" id="modal_feedback" rows="4"
                    class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 font-medium leading-relaxed"
                    placeholder="Apa yang telah Anda lakukan untuk menangani laporan ini?"></textarea>
            </div>
        </div>

        <x-slot:footer>
            <button type="button" data-hs-overlay="#modal-update"
                class="py-2.5 px-4 text-xs font-bold text-gray-500 hover:text-gray-700 transition-all">
                Batal
            </button>
            <button type="submit" form="formUpdate"
                class="py-2.5 px-8 text-xs font-black rounded-xl bg-orange-600 text-white hover:bg-orange-700 shadow-lg shadow-orange-500/20 active:scale-95 transition-all uppercase tracking-widest">
                Update Progres
            </button>
        </x-slot:footer>
    </x-admin.modal>

    <script>
        function openModal(id, status, feedback) {
            document.getElementById('modal_status').value = status;
            document.getElementById('modal_feedback').value = feedback || '';

            // Handle visibility section upload
            handleStatusChange(status);

            removeImage();
            switchUploadMode('file');

            document.getElementById('formUpdate').action = `/toolsman/aspirations/update/${id}`;
            const modal = document.getElementById('modal-update');
            if (window.HSOverlay) {
                HSOverlay.open('#modal-update');
            }
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

                modeFile.classList.replace('hidden', 'flex');
                modeCamera.classList.replace('flex', 'hidden');
            } else {
                btnCamera.classList.add('bg-white', 'text-gray-800', 'shadow-sm', 'dark:bg-neutral-600', 'dark:text-white');
                btnCamera.classList.remove('text-gray-500', 'hover:text-gray-800', 'dark:text-neutral-400',
                    'dark:hover:text-neutral-200');

                btnFile.classList.remove('bg-white', 'text-gray-800', 'shadow-sm', 'dark:bg-neutral-600',
                'dark:text-white');
                btnFile.classList.add('text-gray-500', 'hover:text-gray-800', 'dark:text-neutral-400',
                    'dark:hover:text-neutral-200');

                modeCamera.classList.replace('hidden', 'flex');
                modeFile.classList.replace('flex', 'hidden');
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
            const cameraInput = document.getElementById('camera_input');
            const container = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');

            if (fileInput) fileInput.value = '';
            if (cameraInput) cameraInput.value = '';

            preview.src = '#';
            container.classList.add('hidden');
        }

        const modalElement = document.getElementById('modal-update');
        if (modalElement) {
            modalElement.addEventListener('close.hs.overlay', function() {
                removeImage();
            });
        }
    </script>
@endsection
