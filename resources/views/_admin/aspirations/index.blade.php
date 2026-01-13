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
</div>

<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="min-w-full inline-block align-middle">
            <div class="overflow-hidden">

                {{-- FILTER --}}
                <div class="px-2 pt-0">
                <div class="px-2 pt-0">
                    <form method="GET" class="flex flex-col gap-3">
                        <div class="flex flex-wrap gap-3">
                            <div class="w-full sm:w-64">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        @include('_admin._layout.icons.search')
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="py-2 px-3 ps-10 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500"
                                        placeholder="Cari nama, lokasi, atau deskripsi...">
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="date" name="date_from" value="{{ request('date_from') }}"
                                    class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <span class="text-gray-500">s/d</span>
                                <input type="date" name="date_to" value="{{ request('date_to') }}"
                                    class="py-2 px-3 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                            </div>

                            <div class="w-full sm:w-48">
                                <select name="priority"
                                    data-hs-select='{
                                        "placeholder": "Semua Prioritas",
                                        "toggleTag": "<button type=\"button\"></button>",
                                        "toggleClasses": "py-2 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
                                        "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                                        "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                                        "optionSelectedClasses": "bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-400"
                                    }'>
                                    <option value="">Semua Prioritas</option>
                                    <option value="1" {{ request('priority') == 1 ? 'selected' : '' }}>Rendah</option>
                                    <option value="2" {{ request('priority') == 2 ? 'selected' : '' }}>Sedang</option>
                                    <option value="3" {{ request('priority') == 3 ? 'selected' : '' }}>Tinggi</option>
                                </select>
                            </div>

                            <div class="w-full sm:w-48">
                                <select name="status"
                                    data-hs-select='{
                                        "placeholder": "Semua Status",
                                        "toggleTag": "<button type=\"button\"></button>",
                                        "toggleClasses": "py-2 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
                                        "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                                        "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                                        "optionSelectedClasses": "bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-400"
                                    }'>
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Pending</option>
                                    <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>In Progress</option>
                                    <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>

                            <div class="flex gap-2 items-center">
                                <button type="submit"
                                    class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer">
                                    @include('_admin._layout.icons.search')
                                    Cari
                                </button>
                                @if (request()->hasAny(['priority', 'status', 'search', 'date_from', 'date_to']))
                                    <a class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 hover:bg-blue-50 disabled:opacity-50 disabled:pointer-events-none dark:border-blue-500 dark:text-blue-500 dark:hover:bg-blue-500/10 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer"
                                        href="{{ route('admin.aspirations.index') }}">
                                        @include('_admin._layout.icons.reset')
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                {{-- TABLE --}}
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
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                                Tinggi
                                            </span>
                                        @elseif($d->priority == 2)
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">
                                                Sedang
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                                                Rendah
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        @php
                                            $statusMap = [
                                                1 => ['label' => 'Pending', 'class' => 'bg-gray-100 text-gray-800 dark:bg-gray-800/30 dark:text-gray-500'],
                                                2 => ['label' => 'In Progress', 'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500'],
                                                3 => ['label' => 'Done', 'class' => 'bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500']
                                            ];
                                            $currentStatus = $statusMap[$d->status] ?? $statusMap[1];
                                        @endphp
                                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium {{ $currentStatus['class'] }}">
                                            {{ $currentStatus['label'] }}
                                        </span>
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
                                            class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-green-100 text-green-800 hover:bg-green-200 focus:outline-none focus:bg-green-200 disabled:opacity-50 disabled:pointer-events-none dark:text-green-400 dark:bg-green-800/30 dark:hover:bg-green-800/20 dark:focus:bg-green-800/20 cursor-pointer"
                                            title="Proses">
                                            @include('_admin._layout.icons.pencil')
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-500">
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

{{-- MODAL UPDATE STATUS --}}
<div id="modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto"
    role="dialog" tabindex="-1">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="relative flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="absolute top-2 end-2">
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    onclick="closeModal()">
                    <span class="sr-only">Close</span>
                    @include('_admin._layout.icons.close_modal')
                </button>
            </div>

            <div class="p-4 sm:p-10 overflow-y-auto">
                <div class="mb-4">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Update Pengaduan
                    </h3>
                </div>

                <form method="POST" id="formUpdate" navigate-form>
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium mb-2 dark:text-white">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" required
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                <option value="1">Pending</option>
                                <option value="2">In Progress</option>
                                <option value="3">Done</option>
                            </select>
                        </div>

                        <div>
                            <label for="feedback" class="block text-sm font-medium mb-2 dark:text-white">
                                Feedback
                            </label>
                            <textarea name="feedback" id="feedback" rows="4"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400"
                                placeholder="Berikan feedback untuk pengaduan ini..."></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-x-2">
                        <button type="button" onclick="closeModal()"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                            Batal
                        </button>
                        <button type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id, status, feedback) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('hs-overlay-open');
        document.getElementById('status').value = status;
        document.getElementById('feedback').value = feedback ?? '';
        document.getElementById('formUpdate').action = `/admin/aspirations/${id}`;
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('hs-overlay-open');
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
@endsection
