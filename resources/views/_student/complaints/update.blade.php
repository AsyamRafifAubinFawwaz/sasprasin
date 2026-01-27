@extends('_student._layout.app')

@section('title', 'Edit ' . $page['title'])

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
                        Edit {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form id="update-form" class="p-6" navigate-form action="{{ route('student.complaints.do_update', $data->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="facility_category_id" class="block text-sm font-medium mb-2 dark:text-white">
                            Kategori <span class="text-red-500">*</span>
                        </label>

                        <select name="facility_category_id" id="facility_category_id"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm
                                            focus:border-blue-500 focus:ring-blue-500
                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                                            @error('facility_category_id') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror" required>

                            <option value="">Pilih Kategori</option>

                            @foreach ($facility as $category)
                                <option value="{{ $category->id }}" {{ old('facility_category_id', $data->facility_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                    {{ $category->example_items ? '(Contoh: ' . $category->example_items . ')' : '' }}
                                </option>
                            @endforeach
                        </select>

                        @error('facility_category_id')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="location_id" class="block text-sm font-medium mb-2 dark:text-white">Lokasi <span
                                class="text-red-500">*</span></label>
                        <select name="location_id" id="location_id"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('location_id') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            required>
                            <option value="">Pilih Lokasi</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}" {{ old('location_id', $data->location_id) == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('location_id')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi <span
                                class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="4"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('description') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Jelaskan keluhan Anda"
                            required>{{ old('description', $data->description) }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-white">Gambar (Opsional)</label>

                        @if ($data->image)
                            <div id="current-image" class="mb-3">
                                <div class="relative inline-block">
                                    <img src="{{ asset($data->image) }}" alt="Gambar keluhan" class="h-32 rounded-lg">
                                    <button type="button" id="btn-remove-current"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-2 dark:text-neutral-400">Gambar saat ini</p>
                            </div>
                        @endif

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
                                class="border-2 border-dashed border-gray-300 dark:border-neutral-600 rounded-lg p-8 text-center hover:border-blue-400 dark:hover:border-blue-500 transition-colors cursor-pointer">
                                
                                <div id="drop-zone-content">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-neutral-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                        <span class="font-semibold text-blue-600 dark:text-blue-400">Klik untuk upload</span>
                                        atau drag & drop
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-neutral-500">PNG, JPG, GIF up to 2MB</p>
                                </div>

                                <div id="preview-container" class="hidden">
                                    <div class="relative inline-block">
                                        <img id="image-preview" class="rounded-lg max-h-60" alt="Preview">
                                        <button type="button" id="btn-remove"
                                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 dark:text-neutral-400">Gambar baru (akan mengganti gambar lama)</p>
                                </div>

                            </div>
                            <input type="file" id="image" name="image" accept="image/*" class="hidden">
                        </div>

                        <div id="camera-section" class="hidden">
                            <div class="relative">
                                <video id="camera-preview" autoplay playsinline class="w-full rounded-lg bg-black"
                                    style="max-height: 400px;"></video>
                                <canvas id="camera-canvas" class="hidden"></canvas>

                                <div class="flex justify-center gap-3 mt-3">
                                    <button type="button" id="btn-capture"
                                        class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
                                        <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke-width="2" />
                                            <circle cx="12" cy="12" r="3" fill="currentColor" />
                                        </svg>
                                        Ambil Foto
                                    </button>
                                    <button type="button" id="btn-switch-camera"
                                        class="py-2 px-4 bg-gray-600 text-white rounded-lg hover:bg-gray-700 font-medium">
                                        <svg class="inline-block w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <p class="text-xs text-gray-500 mt-2 dark:text-neutral-400">
                            Format: JPEG, PNG, JPG, GIF. Ukuran max: 2MB.
                            @if($data->image)
                                Kosongkan jika tidak ingin mengubah gambar.
                            @endif
                        </p>
                        @error('image')
                            <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 flex justify-start gap-x-2">
                    <a navigate href="{{ route('student.complaints.index') }}"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Update Keluhan
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
            border-color: #3b82f6;
            color: #3b82f6;
            background: #eff6ff;
        }

        .dark .tab-btn.active {
            border-color: #3b82f6;
            color: #60a5fa;
            background: #1e3a8a;
        }

        #drop-zone.drag-over {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .dark #drop-zone.drag-over {
            border-color: #3b82f6;
            background: #1e3a8a;
        }
    </style>

    <script>
        let cameraStream = null;
        let currentCamera = 'user';
        const fileInput = document.getElementById('image');
        const dropZone = document.getElementById('drop-zone');
        const dropZoneContent = document.getElementById('drop-zone-content');
        const preview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('preview-container');
        const uploadSection = document.getElementById('upload-section');
        const cameraSection = document.getElementById('camera-section');
        const cameraPreview = document.getElementById('camera-preview');
        const cameraCanvas = document.getElementById('camera-canvas');
        const currentImage = document.getElementById('current-image');

        // Remove current image
        const btnRemoveCurrent = document.getElementById('btn-remove-current');
        if (btnRemoveCurrent) {
            btnRemoveCurrent.addEventListener('click', () => {
                if (confirm('Yakin ingin menghapus gambar saat ini? Anda perlu upload gambar baru.')) {
                    currentImage.style.display = 'none';
                }
            });
        }

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
                stopCamera();
            } else {
                btnCamera.classList.add('active');
                btnUpload.classList.remove('active');
                cameraSection.classList.remove('hidden');
                uploadSection.classList.add('hidden');
                startCamera();
            }
        }

        async function startCamera() {
            try {
                if (cameraStream) {
                    stopCamera();
                }
                cameraStream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: currentCamera }
                });
                cameraPreview.srcObject = cameraStream;
            } catch (err) {
                alert('Tidak dapat mengakses kamera: ' + err.message);
            }
        }

        function stopCamera() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => track.stop());
                cameraStream = null;
            }
        }

        document.getElementById('btn-capture').addEventListener('click', () => {
            const context = cameraCanvas.getContext('2d');
            cameraCanvas.width = cameraPreview.videoWidth;
            cameraCanvas.height = cameraPreview.videoHeight;
            context.drawImage(cameraPreview, 0, 0);

            cameraCanvas.toBlob(blob => {
                const file = new File([blob], 'camera-photo.jpg', { type: 'image/jpeg' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                showPreview(URL.createObjectURL(blob));
                if (currentImage) currentImage.style.display = 'none';
                stopCamera();
                switchTab('upload');
            }, 'image/jpeg', 0.95);
        });

        document.getElementById('btn-switch-camera').addEventListener('click', () => {
            currentCamera = currentCamera === 'user' ? 'environment' : 'user';
            startCamera();
        });

        dropZone.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                showPreview(URL.createObjectURL(e.target.files[0]));
                if (currentImage) currentImage.style.display = 'none';
            }
        });

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('drag-over');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('drag-over');
            });
        });

        dropZone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                showPreview(URL.createObjectURL(files[0]));
                if (currentImage) currentImage.style.display = 'none';
            }
        });

        function showPreview(url) {
            preview.src = url;
            dropZoneContent.classList.add('hidden');
            previewContainer.classList.remove('hidden');
        }

        document.getElementById('btn-remove').addEventListener('click', (e) => {
            e.stopPropagation();
            fileInput.value = '';
            previewContainer.classList.add('hidden');
            dropZoneContent.classList.remove('hidden');
            preview.src = '';
            if (currentImage) currentImage.style.display = 'block';
        });

        window.addEventListener('beforeunload', stopCamera);
    </script>
@endsection