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
            <div class="lg:col-span-2">
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                            Informasi Pengaduan
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
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
                            <label class="block text-sm font-medium mb-2 text-gray-800 dark:text-neutral-200">Nama Siswa</label>
                            <p class="text-gray-600 dark:text-neutral-400">{{ $data->student_name ?? 'N/A' }}</p>
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
                                        1 => 'bg-gray-100 text-gray-800 dark:bg-gray-800/30 dark:text-gray-500',
                                        2 => 'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500',
                                        3 => 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500',
                                    ];
                                    $statusLabels = [
                                        1 => 'Pending',
                                        2 => 'In Progress',
                                        3 => 'Done',
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

            <div class="space-y-4">
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Aksi Cepat
                        </h2>
                    </div>

                    <div class="p-6 space-y-3">
                        <button type="button"
                            onclick="window.location.href = '{{ route('admin.aspirations.index') }}'; setTimeout(() => { document.querySelector(`button[onclick*='openModal({{ $data->id }})']`)?.click(); }, 100);"
                            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Proses Pengaduan
                        </button>

                        <a navigate href="{{ route('admin.aspirations.index') }}"
                            class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Image Zoom Modal --}}
    <script>
        function zoomImage(event) {
            const img = event.currentTarget.querySelector('img');
            if (!img) return;

            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-[100] flex items-center justify-center bg-black/90 p-4 backdrop-blur-sm';
            modal.onclick = function(e) {
                if (e.target === this) this.remove();
            };

            const imgContainer = document.createElement('div');
            imgContainer.className = 'relative max-w-7xl';

            const zoomedImg = document.createElement('img');
            zoomedImg.src = img.src;
            zoomedImg.className = 'max-w-full max-h-[90vh] rounded-lg shadow-2xl';

            const closeBtn = document.createElement('button');
            closeBtn.innerHTML = '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
            closeBtn.className = 'absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors bg-gray-800/50 hover:bg-gray-800/70 rounded-lg p-2';
            closeBtn.onclick = () => modal.remove();

            imgContainer.appendChild(zoomedImg);
            imgContainer.appendChild(closeBtn);
            modal.appendChild(imgContainer);
            document.body.appendChild(modal);
        }
    </script>
@endsection
