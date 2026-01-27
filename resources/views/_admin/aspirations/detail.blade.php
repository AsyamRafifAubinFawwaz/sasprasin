@extends('_admin._layout.app')

@section('title', 'Detail Pengaduan Sarana')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Detail Pengaduan Sarana
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Informasi lengkap tentang pengaduan
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate href="{{ route('admin.aspirations.index') }}"
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

    @if(!$data)
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/30 rounded-xl p-6">
            <div class="flex items-center gap-x-3">
                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-red-900 dark:text-red-100">Data Tidak Ditemukan</h3>
                    <p class="text-sm text-red-700 dark:text-red-300 mt-1">Pengaduan dengan ID tersebut tidak ditemukan atau telah dihapus.</p>
                </div>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2 order-2 lg:order-1">
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                            Informasi Pengaduan
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
                         <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Nama Siswa</label>
                            <p class="text-gray-600 dark:text-neutral-400">{{ $data->student_name ?? 'N/A' }}</p>
                        </div>
                        @if ($data->image)
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Gambar</label>
                                <div class="cursor-pointer group" onclick="zoomImage(event)">
                                    <img src="{{ asset($data->image) }}"
                                        alt="Gambar pengaduan"
                                        class="w-full rounded-lg max-h-80 object-cover border border-gray-200 dark:border-neutral-700 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-200">
                                    <p class="text-xs text-gray-500 dark:text-neutral-500 mt-2 text-center font-medium">
                                        Klik gambar untuk memperbesar
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Kategori</label>
                            <p class="text-gray-600 dark:text-neutral-400">{{ $data->category_name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Lokasi</label>
                            <p class="text-gray-600 dark:text-neutral-400">{{ $data->location }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Deskripsi</label>
                            <p class="text-gray-600 dark:text-neutral-400 whitespace-pre-wrap">{{ $data->description }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Tanggal Dibuat</label>
                            <p class="text-gray-600 dark:text-neutral-400">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y H:i') }} WIB</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Prioritas</label>
                            <div class="inline-block">
                                @if($data->priority == 3)
                                    <span class="inline-flex items-center gap-x-1.5 py-2 px-4 rounded-lg text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500 border border-red-200 dark:border-red-900/30">
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 6 6">
                                            <circle cx="3" cy="3" r="3"/>
                                        </svg>
                                        Prioritas Tinggi
                                    </span>
                                @elseif($data->priority == 2)
                                    <span class="inline-flex items-center gap-x-1.5 py-2 px-4 rounded-lg text-sm font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500 border border-yellow-200 dark:border-yellow-900/30">
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 6 6">
                                            <circle cx="3" cy="3" r="3"/>
                                        </svg>
                                        Prioritas Sedang
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-x-1.5 py-2 px-4 rounded-lg text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500 border border-green-200 dark:border-green-900/30">
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 6 6">
                                            <circle cx="3" cy="3" r="3"/>
                                        </svg>
                                        Prioritas Rendah
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Status Progres</label>
                            <div class="inline-block">
                                @php
                                    $statusColors = [
                                        1 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500',
                                        2 => 'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500',
                                        3 => 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500',
                                        4 => 'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500',
                                    ];
                                    $statusLabels = [
                                        1 => 'Pending',
                                        2 => 'In Progress',
                                        3 => 'Done',
                                        4 => 'Rejected',
                                    ];
                                @endphp
                                <span class="px-4 py-2 rounded-lg text-sm font-semibold {{ $statusColors[$data->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$data->status] ?? 'N/A' }}
                                </span>
                            </div>
                        </div>

                        @if ($data->feedback)
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Feedback</label>
                                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-900/30 rounded-lg p-4">
                                    <p class="text-gray-800 dark:text-neutral-200 whitespace-pre-wrap">{{ $data->feedback }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Profil Pelapor -->
            <div class="lg:col-span-1 order-1 lg:order-2">
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700 sticky top-4">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Profil Pelapor
                        </h2>
                    </div>

                    @if($student)
                        <div class="p-6">
                            <!-- Avatar with Initial -->
                            <div class="flex flex-col items-center mb-6">
                                <div class="size-20 flex items-center justify-center rounded-2xl bg-blue-500 text-white text-2xl font-bold shadow-lg mb-3">
                                    {{ !empty($data->student_name) ? strtoupper(substr($data->student_name, 0, 1)) : '?' }}
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-neutral-200 text-center">
                                    {{ $student->name ?? 'N/A' }}
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">
                                    Student ID: #{{ $student->nisn ?? 'N/A' }}
                                </p>
                            </div>

                            <!-- Student Info -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-700/50 rounded-lg">
                                    <div class="flex items-center gap-x-3">
                                        <div class="size-10 flex items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                            <svg class="size-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-neutral-500">NISN</p>
                                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $student->nisn ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-neutral-700/50 rounded-lg">
                                    <div class="flex items-center gap-x-3">
                                        <div class="size-10 flex items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/30">
                                            <svg class="size-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-neutral-500">Kelas</p>
                                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                {{ $student->class_name ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-6">
                            <div class="text-center text-gray-500 dark:text-neutral-500">
                                <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <p class="text-sm">Data siswa tidak tersedia</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

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
                'fixed inset-0 z-[100] bg-black/95 flex items-center justify-center overflow-hidden backdrop-blur-md transition-all duration-300';
            modal.tabIndex = 0;

            // Container for the image to handle initial scaling/fitting
            const imgContainer = document.createElement('div');
            imgContainer.className = 'relative w-full h-full flex items-center justify-center p-4 sm:p-8';

            const zoomedImg = document.createElement('img');
            zoomedImg.src = img.src;
            zoomedImg.className =
                'max-w-full max-h-full object-contain cursor-grab select-none shadow-2xl transition-transform duration-75 ease-out';
            zoomedImg.style.transform = 'translate(0px, 0px) scale(1)';

            // Tombol Close
            const closeBtn = document.createElement('button');
            closeBtn.className =
                'absolute top-4 right-4 z-[110] size-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-all active:scale-95 focus:outline-none';
            closeBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
            `;
            closeBtn.onclick = () => modal.remove();

            // Info text
            const infoText = document.createElement('div');
            infoText.className = 'absolute bottom-4 left-1/2 -translate-x-1/2 text-white/60 text-xs font-medium bg-black/40 px-3 py-1.5 rounded-full backdrop-blur-sm pointer-events-none';
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

            // Handlers for Mouse and Touch
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

            // Mouse Events
            zoomedImg.addEventListener('mousedown', (e) => startDrag(e.clientX, e.clientY));
            window.addEventListener('mousemove', (e) => moveDrag(e.clientX, e.clientY));
            window.addEventListener('mouseup', endDrag);

            // Touch Events
            zoomedImg.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    startDrag(e.touches[0].clientX, e.touches[0].clientY);
                }
            }, { passive: true });

            window.addEventListener('touchmove', (e) => {
                if (isDragging && e.touches.length === 1) {
                    moveDrag(e.touches[0].clientX, e.touches[0].clientY);
                }
            }, { passive: false });

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
