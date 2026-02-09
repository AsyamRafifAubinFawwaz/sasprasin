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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri: Informasi Keluhan -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-neutral-700 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-[#1e293b] dark:text-neutral-200">
                        Informasi Keluhan
                    </h2>
                    <span
                        class="px-2 py-0.5 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-md border border-blue-100 dark:bg-blue-900/10 dark:border-blue-800 dark:text-blue-400">
                        ID: #{{ $data->id }}
                    </span>
                </div>

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Kategori</label>
                            <p class="text-sm font-semibold text-gray-700 dark:text-neutral-200">
                                {{ $data->category_name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Tanggal
                                Dibuat</label>
                            <div
                                class="flex items-center gap-x-2 text-sm font-semibold text-gray-700 dark:text-neutral-200">
                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y H:i') }} WIB
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-1">Lokasi</label>
                            <div
                                class="flex items-center gap-x-1.5 text-sm font-semibold text-gray-700 dark:text-neutral-200">
                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                {{ $data->location }}
                            </div>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Status
                                Progres</label>
                            <div>
                                @if ($data->aspiration_status == \App\Constants\ProgressConst::PENDING)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-[11px] font-bold bg-amber-50 text-amber-600 border border-amber-100 dark:bg-amber-500/10 dark:border-amber-500/20 dark:text-amber-400">
                                        <span class="size-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                        Pending
                                    </span>
                                @elseif ($data->aspiration_status == \App\Constants\ProgressConst::IN_PROGRESS)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-[11px] font-bold bg-blue-50 text-blue-600 border border-blue-100 dark:bg-blue-500/10 dark:border-blue-500/20 dark:text-blue-400">
                                        <span class="size-1.5 rounded-full bg-blue-600"></span>
                                        In Progress
                                    </span>
                                @elseif ($data->aspiration_status == \App\Constants\ProgressConst::DONE)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-600 border border-indigo-100 dark:bg-indigo-500/10 dark:border-indigo-500/20 dark:text-indigo-400">
                                        <span class="size-1.5 rounded-full bg-indigo-600"></span>
                                        Done
                                    </span>
                                @elseif ($data->aspiration_status == \App\Constants\ProgressConst::REJECT)
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-[11px] font-bold bg-red-50 text-red-600 border border-red-100 dark:bg-red-500/10 dark:border-red-500/20 dark:text-red-400">
                                        <span class="size-1.5 rounded-full bg-red-600"></span>
                                        Reject
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-2">Deskripsi</label>
                        <div
                            class="bg-gray-50/50 dark:bg-neutral-900/30 border border-gray-100 dark:border-neutral-700 rounded-xl p-4">
                            <p class="text-sm text-gray-600 dark:text-neutral-400 whitespace-pre-wrap leading-relaxed">
                                {{ $data->description }}</p>
                        </div>
                    </div>

                    @if ($data->image)
                        <div class="pb-2">
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-3">Gambar
                                Keluhan</label>
                            <div class="cursor-pointer group" onclick="zoomImage(event)">
                                <div class="flex">
                                    <img src="{{ \App\Utils\UrlHelper::getImageUrl($data->image) }}" alt="Gambar keluhan"
                                        class="max-h-64 w-auto rounded-2xl object-cover border border-gray-100 dark:border-neutral-700 hover:shadow-lg transition-all duration-300">
                                </div>
                                <p class="text-[10px] text-gray-400 dark:text-neutral-500 mt-2 font-medium italic">
                                    Klik gambar untuk memperbesar
                                </p>
                            </div>
                        </div>
                    @endif

                    @if ($data->aspiration_feedback)
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
                                    "{{ $data->aspiration_feedback }}"</p>
                            </div>
                        </div>
                    @endif

                    @if ($data->aspiration_image)
                        <div>
                            <label
                                class="block text-[10px] font-bold text-gray-400 dark:text-neutral-500 uppercase tracking-wider mb-3">Bukti
                                Tindak Lanjut</label>
                            <div class="cursor-pointer group" onclick="zoomImage(event)">
                                <div class="flex">
                                    <img src="{{ \App\Utils\UrlHelper::getImageUrl($data->aspiration_image) }}"
                                        alt="Bukti Tindak Lanjut"
                                        class="max-h-64 w-auto rounded-2xl object-cover border border-gray-100 dark:border-neutral-700 hover:shadow-lg transition-all duration-300">
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

        <div class="lg:col-span-1">
            <div
                class="bg-white shadow-lg rounded-2xl dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700 h-full">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Timeline Status
                    </h2>
                </div>
                <div class="p-6">
                    @if (count($logs) > 0)
                        <ol class="relative border-s border-gray-200 dark:border-neutral-700 ml-3">
                            @foreach ($logs as $log)
                                <li class="mb-10 ms-6">
                                    @php
                                        $iconColors = [
                                            1 => 'bg-amber-100 text-amber-600 ring-white dark:ring-neutral-800',
                                            2 => 'bg-blue-100 text-blue-600 ring-white dark:ring-neutral-800',
                                            3 => 'bg-emerald-100 text-emerald-600 ring-white dark:ring-neutral-800',
                                            4 => 'bg-red-100 text-red-600 ring-white dark:ring-neutral-800',
                                        ];
                                        $badgeColors = [
                                            1 => 'bg-amber-50 text-amber-700 border-amber-100 dark:bg-amber-900/20 dark:text-amber-500 dark:border-amber-800',
                                            2 => 'bg-blue-50 text-blue-700 border-blue-100 dark:bg-blue-900/20 dark:text-blue-500 dark:border-blue-800',
                                            3 => 'bg-emerald-50 text-emerald-700 border-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-500 dark:border-emerald-800',
                                            4 => 'bg-red-50 text-red-700 border-red-100 dark:bg-red-900/20 dark:text-red-500 dark:border-red-800',
                                        ];
                                    @endphp
                                    <span
                                        class="absolute flex items-center justify-center w-6 h-6 {{ $iconColors[$log->new_status] ?? 'bg-gray-100 text-gray-500' }} rounded-full -start-3 ring-8 ring-white dark:ring-neutral-800">
                                        @if ($log->new_status == 1)
                                            <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                        @elseif($log->new_status == 2)
                                            @include('_admin._layout.icons.loader', [
                                                'class' => 'size-2.5',
                                            ])
                                        @elseif($log->new_status == 3)
                                            @include('_student._layout.icons.check', [
                                                'class' => 'size-2.5',
                                            ])
                                        @elseif($log->new_status == 4)
                                            @include('_student._layout.icons.octagon-alert', [
                                                'class' => 'size-2.5',
                                            ])
                                        @endif
                                    </span>
                                    <time
                                        class="bg-gray-50 dark:bg-neutral-900 border border-gray-100 dark:border-neutral-700 text-gray-500 dark:text-neutral-400 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase tracking-wider">
                                        {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}
                                    </time>
                                    <h3
                                        class="flex items-center mb-1 text-sm font-bold text-gray-800 dark:text-neutral-200 mt-3 capitalize">
                                        {{ $log->new_status == 1 ? 'Pending' : ($log->new_status == 2 ? 'In Progress' : ($log->new_status == 3 ? 'Selesai' : 'Ditolak')) }}
                                        @if ($loop->first)
                                            <span
                                                class="ms-2 {{ $badgeColors[$log->new_status] ?? 'bg-gray-100' }} border text-[9px] font-black px-1.5 py-0.5 rounded uppercase tracking-tighter">Terbaru</span>
                                        @endif
                                    </h3>
                                    @if ($log->note)
                                        <p class="text-sm text-gray-500 dark:text-neutral-400 mb-4 leading-relaxed italic">
                                            "{{ $log->note }}"
                                        </p>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div
                                class="size-16 bg-gray-100 dark:bg-neutral-700 rounded-full flex items-center justify-center mb-4">
                                <svg class="size-8 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 8v4l3 3" />
                                    <circle cx="12" cy="12" r="10" />
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-neutral-400 font-medium">Belum ada pembaruan status</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

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
