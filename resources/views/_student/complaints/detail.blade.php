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
        <div class="lg:col-span-2">
            <div
                class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Informasi Keluhan
                    </h2>
                </div>

                <div class="p-6 space-y-6">
                    @if ($data->image)
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Gambar</label>
                            <div class="cursor-pointer group" onclick="zoomImage(event)">
                                        <img src="{{ asset($data->image) }}"
                                            alt="Gambar keluhan"
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
                            <p class="text-gray-600 dark:text-neutral-400">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</p>
                        </div>

                        @if ($data->updated_at && $data->updated_at !== $data->created_at)
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Terakhir Diperbarui</label>
                                <p class="text-gray-600 dark:text-neutral-400">{{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y H:i') }}</p>
                            </div>
                        @endif

                        @if ($data->aspiration_status)
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Status Progres</label>
                                <div class="inline-block">
                                    @php
                                        $statusColors = [
                                            1 => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-200',
                                            2 => 'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-200',
                                            3 => 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-200',
                                            4 => "bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-200",
                                        ];
                                        $statusLabels = [
                                            1 => 'Pending',
                                            2 => 'In Progress',
                                            3 => 'Done',
                                            4 => 'Rejected',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$data->aspiration_status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $statusLabels[$data->aspiration_status] ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        @if ($data->aspiration_feedback)
                            <div>
                                <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Feedback</label>
                                <p class="text-gray-600 dark:text-neutral-400 whitespace-pre-wrap">{{ $data->aspiration_feedback }}</p>
                            </div>
                        @endif
                    </div>


                </div>
            </div>

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
                                                    4 => 'bg-red-500',
                                                ];
                                            @endphp
                                            <div class="relative z-10 size-7 flex justify-center items-center rounded-full {{ $iconColors[$log->new_status] ?? 'bg-gray-500' }} text-white shadow-md">
                                                @if($log->new_status == 1)
                                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                                @elseif($log->new_status == 2)
                                                    @include('_admin._layout.icons.loader')
                                                @elseif($log->new_status == 3)
                                                    @include('_student._layout.icons.check')
                                                @elseif($log->new_status == 4)
                                                    @include('_student._layout.icons.octagon-alert')
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
                                                        4 => 'Rejected',
                                                    ];
                                                @endphp
                                                Status: {{ $statusLabels[$log->new_status] ?? 'Unknown' }}
                                            </h3>

                                            @if($log->note)
                                                <div class="mt-1 p-2 bg-gray-50 dark:bg-neutral-900/50 rounded-lg border border-gray-100 dark:border-neutral-700 text-sm italic text-gray-600 dark:text-neutral-400">
                                                    "{{ $log->note }}"
                                                </div>
                                            @endif


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
