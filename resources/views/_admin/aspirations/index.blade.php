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
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

                <div class="w-44 max-w-full">
                    <select name="priority" data-hs-select='{
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
                    <select name="status" data-hs-select='{
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

                    @if (request()->hasAny(['priority', 'status', 'search', 'date']) && array_filter(request()->only(['priority', 'status', 'search', 'date'])))
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
                                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
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
                                                @if($d->priority == 3)
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
                                                @php
                                                    $statusMap = [
                                                        1 => ['label' => 'Pending', 'class' => 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200'],
                                                        2 => ['label' => 'In Progress', 'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500'],
                                                        3 => ['label' => 'Done', 'class' => 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500'],
                                                        4 => ['label' => 'Reject', 'class' => 'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500']
                                                    ];
                                                    $currentStatus = $statusMap[$d->status] ?? $statusMap[1];
                                                @endphp
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $currentStatus['class'] }}">
                                                    {{ $currentStatus['label'] }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">
                                                <a navigate
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20"
                                                    href="{{ route('admin.aspirations.detail', $d->id) }}" title="Lihat Detail">
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

    <x-admin.modal id="modal-update" title="Update Pengaduan" formId="formUpdate">
        <div class="space-y-4">
            <div>
                <label for="status" class="block text-sm font-medium mb-2 dark:text-white">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" id="modal_status" required
                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                    <option value="1">Pending</option>
                    <option value="2">In Progress</option>
                    <option value="3">Done</option>
                    <option value="4">Reject</option>
                </select>
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

    <x-admin.modal id="modal-export-pdf" title="Export Laporan PDF" formId="formExportPdf" method="GET" :navigate="false">
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

        document.getElementById('export_all').addEventListener('change', function () {
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

            document.getElementById('formUpdate').action = `/admin/aspirations/update/${id}`;
        }
    </script>

@endsection