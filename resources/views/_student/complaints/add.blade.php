@extends('_student._layout.app')

@section('title', 'Buat ' . $page['title'])

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div
            class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center">
                <a navigate href="{{ route('student.complaints.index') }}"
                    class="py-3 px-3 inline-flex items-center gap-x-2 text-xl rounded-xl border border-gray-200 bg-white text-gray-800 shadow-md hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="90" height="90"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a>
                <div class="ms-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Buat {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form id="create-form" class="p-6" navigate-form action="{{ route('student.complaints.do_create') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    {{-- Category --}}
                    <div>
                        <label for="facility_category_id" class="block text-sm font-medium mb-2 dark:text-white">Kategori
                            <span class="text-red-500">*</span></label>

                        <div class="relative custom-select-container" id="container-category">
                            <input type="hidden" name="facility_category_id" id="facility_category_id"
                                value="{{ old('facility_category_id') }}" required>
                            <button type="button"
                                class="peer group w-full text-left px-4 py-3 border rounded-lg bg-white dark:bg-neutral-900 text-gray-700 dark:text-neutral-400 border-gray-200 dark:border-neutral-700 shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-800 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all flex justify-between items-center @error('facility_category_id') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <span
                                    class="selected-text">{{ old('facility_category_id') ? $facility->find(old('facility_category_id'))->name ?? 'Pilih Kategori' : 'Pilih Kategori' }}</span>
                                <svg class="w-5 h-5 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m19 9-7 7-7-7" />
                                </svg>
                            </button>

                            <ul
                                class="hidden absolute z-50 overflow-y-auto max-h-60 mt-1 w-full bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-lg py-1 custom-select-options">
                                <li data-value=""
                                    class="px-4 py-2 hover:bg-orange-500 hover:text-white cursor-pointer transition-colors text-sm">
                                    Pilih Kategori</li>
                                @foreach ($facility as $category)
                                    <li data-value="{{ $category->id }}"
                                        class="px-4 py-2 hover:bg-orange-500 hover:text-white cursor-pointer transition-colors text-sm">
                                        {{ $category->name }}
                                        {{ $category->example_items ? '(Contoh: ' . $category->example_items . ')' : '' }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @error('facility_category_id')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Location --}}
                    <div>
                        <label for="location_id" class="block text-sm font-medium mb-2 dark:text-white">Lokasi <span
                                class="text-red-500">*</span></label>

                        <div class="relative custom-select-container" id="container-location">
                            <input type="hidden" name="location_id" id="location_id" value="{{ old('location_id') }}"
                                required>
                            <button type="button"
                                class="peer group w-full text-left px-4 py-3 border rounded-lg bg-white dark:bg-neutral-900 text-gray-700 dark:text-neutral-400 border-gray-200 dark:border-neutral-700 shadow-sm hover:bg-gray-50 dark:hover:bg-neutral-800 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all flex justify-between items-center @error('location_id') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
                                <span
                                    class="selected-text">{{ old('location_id') ? $locations->find(old('location_id'))->name ?? 'Pilih Lokasi' : 'Pilih Lokasi' }}</span>
                                <svg class="w-5 h-5 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m19 9-7 7-7-7" />
                                </svg>
                            </button>

                            <ul
                                class="hidden absolute z-50 overflow-y-auto max-h-60 mt-1 w-full bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-lg py-1 custom-select-options">
                                <li data-value=""
                                    class="px-4 py-2 hover:bg-orange-500 hover:text-white cursor-pointer transition-colors text-sm">
                                    Pilih Lokasi</li>
                                @foreach ($locations as $location)
                                    <li data-value="{{ $location->id }}"
                                        class="px-4 py-2 hover:bg-orange-500 hover:text-white cursor-pointer transition-colors text-sm">
                                        {{ $location->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        @error('location_id')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi <span
                                class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="4"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Jelaskan keluhan Anda" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-white">Gambar</label>

                        <div class="flex gap-2 mb-3">
                            <button type="button" id="btn-upload"
                                class="tab-btn active py-2 px-4 text-sm font-medium rounded-lg border transition-all">
                                <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                Upload File
                            </button>
                            <button type="button" id="btn-camera"
                                class="tab-btn py-2 px-4 text-sm font-medium rounded-lg border transition-all">
                                <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Ambil Foto
                            </button>
                        </div>

                        <div id="upload-section" class="upload-area">
                            <div id="drop-zone"
                                class="relative border-2 border-dashed border-gray-300 dark:border-neutral-600 rounded-lg p-8 text-center hover:border-orange-400 dark:hover:border-orange-500 transition-colors cursor-pointer min-h-[200px] flex flex-col justify-center items-center">

                                <div id="drop-zone-content">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-neutral-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                        <span class="font-semibold text-orange-600 dark:text-orange-400">Klik untuk
                                            upload</span>
                                        atau drag & drop
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-neutral-500">PNG, JPG, GIF up to 2MB
                                    </p>
                                </div>

                                <div id="preview-container"
                                    class="hidden w-full h-full p-0 border-0 overflow-hidden rounded-xl">
                                    <div
                                        class="relative w-full h-full flex justify-center items-center bg-black/5 dark:bg-black/20">
                                        <img id="image-preview" class="w-full max-h-[400px] object-contain shadow-sm"
                                            alt="Preview">
                                        <button type="button" id="btn-remove"
                                            class="absolute top-3 right-3 bg-red-500/90 backdrop-blur-sm text-white rounded-full p-2 hover:bg-red-600 shadow-lg z-10 transition-all hover:scale-110 active:scale-90">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="image" name="image" accept="image/*" class="hidden">
                        </div>

                        {{-- Camera Section --}}
                        <div id="camera-section" class="hidden">
                            <div
                                class="relative w-full bg-gray-100 dark:bg-neutral-900/50 rounded-2xl overflow-hidden aspect-video shadow-inner border-2 border-dashed border-gray-200 dark:border-neutral-700 flex flex-col items-center justify-center text-center p-6">
                                <div
                                    class="size-16 bg-orange-50 dark:bg-orange-900/20 rounded-full flex items-center justify-center mb-3">
                                    <svg class="size-8 text-orange-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-gray-800 dark:text-neutral-200">Kamera Bawaan Perangkat
                                </p>
                                <p class="text-[10px] text-gray-500 mt-1 uppercase tracking-widest text-center">Gunakan
                                    kamera HP Anda secara langsung</p>
                            </div>

                            <label for="student_camera_input"
                                class="mt-3 w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-orange-600 text-white hover:bg-orange-700 transition-all active:scale-95 shadow-lg shadow-orange-500/20 cursor-pointer">
                                @include('_toolsman._layout.icons.camera')
                                Buka Kamera
                            </label>
                            <input id="student_camera_input" type="file" accept="image/*" capture="environment"
                                class="hidden" />
                        </div>

                        @error('image')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-4 flex justify-start gap-x-2">
                    <a navigate href="{{ route('student.complaints.index') }}"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Buat Keluhan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .tab-btn {
            border-color: #e5e7eb;
            color: #6b7280;
            background: white;
        }

        .dark .tab-btn {
            border-color: #404040;
            color: #a3a3a3;
            background: #262626;
        }

        .tab-btn.active {
            border-color: #f97316;
            color: #f97316;
            background: #fff7ed;
        }

        .dark .tab-btn.active {
            border-color: #f97316;
            color: #fb923c;
            background: #7c2d12;
        }

        #drop-zone.drag-over {
            border-color: #f97316;
            background: #fff7ed;
        }

        .dark #drop-zone.drag-over {
            border-color: #f97316;
            background: #7c2d12;
        }

        /* Custom Select Styles */
        .custom-select-container.active ul {
            display: block;
        }

        .custom-select-container.active button svg {
            transform: rotate(180deg);
        }
    </style>

    <script>
        (function() {
            const form = document.getElementById('create-form');
            if (!form || form.dataset.scriptLoaded) return;
            form.dataset.scriptLoaded = 'true';

            const fileInput = document.getElementById('image');
            const dropZone = document.getElementById('drop-zone');
            const dropZoneContent = document.getElementById('drop-zone-content');
            const preview = document.getElementById('image-preview');
            const previewContainer = document.getElementById('preview-container');
            const uploadSection = document.getElementById('upload-section');
            const cameraSection = document.getElementById('camera-section');
            const btnRemove = document.getElementById('btn-remove');

            // Tab switching
            document.getElementById('btn-upload').addEventListener('click', () => {
                switchTab('upload');
            });

            document.getElementById('btn-camera').addEventListener('click', () => {
                switchTab('camera');
            });

            function switchTab(tab) {
                const btnUpload = document.getElementById('btn-upload');
                const btnCamera = document.getElementById('btn-camera');

                if (tab === 'upload') {
                    btnUpload.classList.add('active');
                    btnCamera.classList.remove('active');
                    uploadSection.classList.remove('hidden');
                    cameraSection.classList.add('hidden');
                } else {
                    btnCamera.classList.add('active');
                    btnUpload.classList.remove('active');
                    cameraSection.classList.remove('hidden');
                    uploadSection.classList.add('hidden');
                }
            }

            // Wire native camera input to main file input + preview
            const cameraInput = document.getElementById('student_camera_input');
            cameraInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(e.target.files[0]);
                    fileInput.files = dataTransfer.files;
                    showPreview(URL.createObjectURL(e.target.files[0]));
                    switchTab('upload');
                }
            });

            // File upload
            dropZone.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    showPreview(URL.createObjectURL(e.target.files[0]));
                }
            });

            // Drag and drop
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.add('border-orange-500', 'bg-orange-50',
                        'dark:bg-orange-900/10');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('border-orange-500', 'bg-orange-50',
                        'dark:bg-orange-900/10');
                });
            });

            dropZone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    showPreview(URL.createObjectURL(files[0]));
                }
            });

            function showPreview(url) {
                preview.src = url;
                previewContainer.classList.remove('hidden');
                dropZoneContent.classList.add('hidden');
                dropZone.classList.remove('p-8', 'border-2', 'border-dashed');
                dropZone.classList.add('p-0', 'border-0');
            }

            btnRemove.addEventListener('click', (e) => {
                e.stopPropagation();
                fileInput.value = '';
                cameraInput.value = '';
                previewContainer.classList.add('hidden');
                dropZoneContent.classList.remove('hidden');
                dropZone.classList.add('p-8', 'border-2', 'border-dashed');
                dropZone.classList.remove('p-0', 'border-0');
                preview.src = '';
            });
        })();
    </script>
@endsection
