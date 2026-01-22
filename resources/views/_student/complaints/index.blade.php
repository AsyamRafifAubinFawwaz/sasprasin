@extends('_student._layout.app')

@section('title', $page['title'])

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Daftar keluhan Anda
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-orange-700 transition-all shadow-md shadow-orange-500/20 active:scale-95 cursor-pointer"
                    href="{{ route('student.complaints.add') }}">
                    @include('_admin._layout.icons.add')
                    Buat Keluhan
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">

                    <div class="px-2 pt-0">
                        <form action="{{ route('student.complaints.index') }}" method="GET" navigate-form
                            class="flex flex-col sm:flex-row gap-3">
                            <div class="sm:w-64">
                                <label for="keywords" class="sr-only">Search</label>
                                <div class="relative">
                                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                                        class="py-1 px-3 block w-full border-gray-200 rounded-lg text-sm focus:z-10 focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900
                                        placeholder-neutral-300 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Cari Lokasi/Deskripsi">
                                </div>
                            </div>
                            <div class="sm:w-48">
                                <select name="category_id"
                                    data-hs-select='{
            "placeholder": "Semua Kategori",
            "toggleTag": "<button type=\"button\"></button>",
            "toggleClasses": "py-1 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
            "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
            "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
            "optionSelectedClasses": "bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-400"
        }'>
                                    <option value="">Semua Kategori</option>

                                    @foreach ($facility as $category)
                                        <option value="{{ $category->id }}"
                                            {{ ($category_id ?? request('category_id')) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        <div class="w-full sm:w-48">
                                        <select name="status" data-hs-select='{
                                        "placeholder": "Semua Status",
                                        "toggleTag": "<button type=\"button\"></button>",
                                        "toggleClasses": "py-1 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
                                        "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                                        "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                                        "optionSelectedClasses": "bg-orange-100 text-orange-800 dark:bg-orange-800/30 dark:text-orange-400"
                                    }'>
                                            <option value="">Semua Status</option>
                                            <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Pending</option>
                                            <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>In Progress
                                            </option>
                                            <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>Done</option>
                                            <option value="4" {{ request('status') == 4 ? 'selected' : '' }}>Reject</option>
                                        </select>
                                    </div>
                            <div>
                                <button type="submit"
                                    class="py-1 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer">
                                    @include('_admin._layout.icons.search')
                                    Cari
                                </button>
                             @if (request()->filled('keywords') || request()->filled('category_id') || request()->filled('status'))

                                    <a class="py-1 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-orange-600 text-orange-600 hover:border-orange-500 hover:text-orange-500 hover:bg-blue-50 disabled:opacity-50 disabled:pointer-events-none dark:border-orange-500 dark:text-orange-500 dark:hover:bg-orange-500/10 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer"
                                        href="{{ route('student.complaints.index') }}">
                                        @include('_admin._layout.icons.reset')
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-lg dark:border-neutral-700">
                        <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            No
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
                                            Deskripsi
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Tanggal
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
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-neutral-200">{{ $loop->iteration + ($data->firstItem() - 1) }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $d->category_name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-neutral-200">{{ $d->location }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-neutral-200 truncate">{{ Str::limit($d->description, 50) }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-neutral-200">{{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                @if ($d->aspiration_status == \App\Constants\ProgressConst::PENDING)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">
                                                        Pending
                                                    </span>
                                                @elseif($d->aspiration_status == \App\Constants\ProgressConst::IN_PROGRESS)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                        In Progress
                                                    </span>
                                                @elseif($d->aspiration_status == \App\Constants\ProgressConst::DONE)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">
                                                        Done
                                                    </span>
                                                @elseif ($d->aspiration_status == \App\Constants\ProgressConst::REJECT)
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium 
                                                        bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">
                                                        Reject
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white">
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">
                                                  <a navigate
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg bg-blue-100 text-blue-800 dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20"
                                                    href="{{ route('student.complaints.detail', $d->id) }}"
                                                    title="Lihat Detail">
                                                    @include('_admin._layout.icons.view_detail')
                                                </a>
                                @if ( $d->aspiration_status == \App\Constants\ProgressConst::PENDING || $d->aspiration_status == \App\Constants\ProgressConst::REJECT)
                                <a navigate
                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-green-100 text-green-800 hover:bg-green-200 focus:outline-none focus:bg-green-200 disabled:opacity-50 disabled:pointer-events-none dark:text-green-400 dark:bg-green-800/30 dark:hover:bg-green-800/20 dark:focus:bg-green-800/20 cursor-pointer"
                                    href="{{ route('student.complaints.update', $d->id) }}"
                                    title="Edit">
                                    @include('_admin._layout.icons.pencil')
                                </a>
                            @endif

                            @if ($d->aspiration_status == \App\Constants\ProgressConst::PENDING)
                                <button type="button"
                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-400 dark:bg-red-800/30 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20 cursor-pointer"
                                    title="Hapus"
                                    data-hs-overlay="#delete-modal"
                                    onclick="setDeleteData('{{ $d->id }}', '{{ $d->location }}')">
                                    @include('_admin._layout.icons.trash')
                                </button>
                            @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
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

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto"
        role="dialog" tabindex="-1" aria-labelledby="delete-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="relative flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="absolute top-2 end-2">
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#delete-modal">
                        <span class="sr-only">Close</span>
                        @include('_admin._layout.icons.close_modal')
                    </button>
                </div>

                <div class="p-4 sm:p-10 text-center overflow-y-auto">
                    <span
                        class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>

                    <h3 id="delete-modal-label" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Hapus Keluhan
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500">
                        Apakah Anda yakin ingin menghapus keluhan di <span id="delete-item-name"
                            class="font-semibold text-gray-800 dark:text-neutral-200"></span>?
                        <br>Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            data-hs-overlay="#delete-modal">
                            Batal
                        </button>
                        <form id="delete-form" method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteData(id, location) {
            document.getElementById('delete-item-name').textContent = location;
            document.getElementById('delete-form').action = '{{ url('student/complaints/delete') }}/' + id;
        }
    </script>
@endsection
