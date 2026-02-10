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
                    <a navigate href="{{ route('admin.aspirations.index') }}"
                        class="py-2.5 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-gray-600 text-white hover:bg-gray-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-700 transition-all shadow-md shadow-gray-500/20 active:scale-95 cursor-pointer">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 19-7-7 7-7" />
                            <path d="M19 12H5" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        @if (!$data)
            <div
                class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900/30 rounded-xl p-6 text-center">
                <svg class="size-12 text-red-600 dark:text-red-400 mx-auto mb-3" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-lg font-semibold text-red-900 dark:text-red-100">Data Tidak Ditemukan</h3>
                <p class="text-sm text-red-700 dark:text-red-300 mt-1">Laporan tidak tersedia atau telah dihapus.</p>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8 order-2 lg:order-1">
                    <div
                        class="bg-white shadow-sm border border-gray-100 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                        <div
                            class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-[#1e293b] dark:text-neutral-200">
                                Informasi Pengaduan
                            </h2>

                        </div>

                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Nama
                                        Siswa</label>
                                    <p class="text-sm font-semibold text-gray-700 dark:text-neutral-200">
                                        {{ $data->student_name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Tanggal
                                        Dibuat</label>
                                    <div
                                        class="flex items-center gap-x-2 text-sm font-semibold text-gray-700 dark:text-neutral-200">
                                        <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    <p class="text-sm font-semibold text-gray-700 dark:text-neutral-200">
                                        {{ $data->category_name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Lokasi</label>
                                    <div
                                        class="flex items-center gap-x-1.5 text-sm font-semibold text-gray-700 dark:text-neutral-200">
                                        <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                            <circle cx="12" cy="10" r="3" />
                                        </svg>
                                        {{ $data->location }}
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Deskripsi</label>
                                <div
                                    class="bg-gray-50/50 dark:bg-neutral-900/30 border border-gray-100 dark:border-neutral-700 rounded-xl p-4">
                                    <p
                                        class="text-sm text-gray-600 dark:text-neutral-400 whitespace-pre-wrap leading-relaxed">
                                        {{ $data->description }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Prioritas</label>
                                    <div>
                                        @if ($data->priority == 3)
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                                Tinggi
                                            </span>
                                        @elseif($data->priority == 2)
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
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Status
                                        Progres</label>
                                    <div>
                                        @if ($data->status == \App\Constants\ProgressConst::PENDING)
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-800/30 dark:text-amber-500">
                                                <span class="size-1.5 rounded-full bg-amber-500"></span>
                                                Pending
                                            </span>
                                        @elseif ($data->status == \App\Constants\ProgressConst::IN_PROGRESS)
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                <span class="size-1.5 rounded-full bg-blue-500"></span>
                                                In Progress
                                            </span>
                                        @elseif ($data->status == \App\Constants\ProgressConst::DONE)
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-500">
                                                <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                                Done
                                            </span>
                                        @elseif ($data->status == \App\Constants\ProgressConst::REJECT)
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
                                </div>
                            </div>

                            @if ($data->image)
                                <div class="pb-2">
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-3">Gambar
                                        Pengaduan</label>
                                    <div class="cursor-pointer group" onclick="zoomImage(event)">
                                        <div class="flex">
                                            <img src="{{ \App\Utils\UrlHelper::getImageUrl($data->image) }}"
                                                alt="Gambar pengaduan"
                                                class="w-full max-h-96 rounded-2xl object-cover border border-gray-100 dark:border-neutral-700 hover:shadow-lg transition-all duration-300">
                                        </div>
                                        <p class="text-[10px] text-gray-400 dark:text-neutral-500 mt-2 font-medium italic">
                                            Klik gambar untuk memperbesar
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if ($data->feedback)
                                <div>
                                    <label
                                        class="flex items-center gap-x-1.5 text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">
                                        <svg class="size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                        </svg>
                                        Respon Petugas (Feedback)
                                    </label>
                                    <div
                                        class="bg-blue-50/40 dark:bg-blue-900/10 border border-blue-100/50 dark:border-blue-800/20 rounded-xl p-5 text-center">
                                        <p class="text-sm font-medium text-blue-800 dark:text-blue-300 italic">
                                            "{{ $data->feedback }}"</p>
                                    </div>
                                </div>
                            @endif

                            @if ($data->aspiration_image)
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-3">Bukti
                                        Tindak Lanjut</label>
                                    <div class="cursor-pointer group" onclick="zoomImage(event)">
                                        <div class="flex w-full">
                                            <img src="{{ \App\Utils\UrlHelper::getImageUrl($data->aspiration_image) }}"
                                                alt="Bukti Tindak Lanjut"
                                                class="w-full max-h-96 rounded-2xl object-cover border border-gray-100 dark:border-neutral-700 hover:shadow-lg transition-all duration-300">
                                        </div>
                                        <p class="text-[10px] text-gray-400 dark:text-neutral-500 mt-2 font-medium italic">
                                            Klik gambar untuk memperbesar
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Profil Pelapor -->
                <div class="lg:col-span-4 order-1 lg:order-2">
                    <div
                        class="bg-white shadow-sm border border-gray-100 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700 sticky top-4 overflow-hidden flex flex-col">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700">
                            <h2 class="text-sm font-bold text-gray-800 dark:text-neutral-200">
                                Profil Pelapor
                            </h2>
                        </div>

                        <div class="p-6">
                            @if ($student)
                                <!-- Avatar Section -->
                                <div class="flex flex-col items-center mb-8">
                                    <div
                                        class="size-24 flex items-center justify-center rounded-4xl bg-blue-600 text-white text-3xl font-extrabold shadow-xl shadow-blue-500/20 mb-4 transform hover:scale-105 transition-transform duration-300">
                                        {{ !empty($data->student_name) ? strtoupper(substr($data->student_name, 0, 1)) : '?' }}
                                    </div>
                                    <h3 class="text-xl font-black text-gray-800 dark:text-neutral-200 tracking-tight">
                                        {{ $student->name ?? 'N/A' }}
                                    </h3>
                                    {{-- <p
                                        class="text-[11px] font-bold text-gray-400 dark:text-neutral-500 mt-1 uppercase tracking-widest">
                                        Student ID: #{{ $student->nisn ?? '123' }}
                                    </p> --}}
                                </div>

                                <!-- Info Cards -->
                                <div class="space-y-3">
                                    <div
                                        class="flex items-center gap-x-4 p-4 bg-gray-50/50 dark:bg-neutral-900/50 border border-gray-100 dark:border-neutral-700 rounded-2xl">
                                        <div
                                            class="size-10 flex items-center justify-center rounded-xl bg-white dark:bg-neutral-800 text-blue-500 shadow-sm">
                                            @include('_admin._layout.icons.sidebar.student')
                                        </div>
                                        <div>
                                            <p
                                                class="text-[9px] font-black text-gray-400 dark:text-neutral-500 uppercase tracking-tighter">
                                                NISN</p>
                                            <p class="text-sm font-bold text-gray-700 dark:text-neutral-200">
                                                {{ $student->nisn ?? 'N/A' }}</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-center gap-x-4 p-4 bg-gray-50/50 dark:bg-neutral-900/50 border border-gray-100 dark:border-neutral-700 rounded-2xl">
                                        <div
                                            class="size-10 flex items-center justify-center rounded-xl bg-white dark:bg-neutral-800 text-emerald-500 shadow-sm">
                                            @include('_admin._layout.icons.classroom')
                                        </div>
                                        <div>
                                            <p
                                                class="text-[9px] font-black text-gray-400 dark:text-neutral-500 uppercase tracking-tighter">
                                                Kelas</p>
                                            <p class="text-sm font-bold text-gray-700 dark:text-neutral-200">
                                                {{ $student->class_name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-12">
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
