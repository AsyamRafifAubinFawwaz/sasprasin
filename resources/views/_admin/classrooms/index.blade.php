@extends('_admin._layout.app')

@section('title', 'Manajemen Kelas')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Manajemen Kelas
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <button type="button"
                    class="py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-orange-700 transition-all shadow-md shadow-orange-500/20 active:scale-95 cursor-pointer"
                    data-hs-overlay="#add-modal">
                    @include('_admin._layout.icons.add')
                    Tambah Kelas
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">

                    <div class="px-2 pt-0">
                        <form action="{{ route('admin.classrooms.index') }}" method="GET" navigate-form
                            class="flex flex-col sm:flex-row gap-3">
                            <div class="sm:w-64">
                                <label for="keywords" class="sr-only">Search</label>
                                <div class="relative">
                                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                                        class="py-1 px-3 block w-full border-gray-200 rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900
                                                    placeholder-neutral-300 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                        placeholder="Cari Nama Kelas">
                                </div>
                            </div>
                            <div>
                                <button type="submit"
                                    class="py-1 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer">
                                    @include('_admin._layout.icons.search')
                                    Cari
                                </button>
                                @if (!empty($keywords))
                                    <a class="py-1 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-orange-600 text-orange-600 hover:border-orange-500 hover:text-orange-500 hover:bg-orange-50 disabled:opacity-50 disabled:pointer-events-none dark:border-orange-500 dark:text-orange-500 dark:hover:bg-orange-500/10 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer"
                                        href="{{ route('admin.classrooms.index') }}">
                                        @include('_admin._layout.icons.reset')
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>


                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="min-w-full inline-block align-middle">
                                <div class="overflow-hidden">

                                    <div
                                        class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-lg dark:border-neutral-700">
                                        <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-start">
                                                        <span
                                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                            No
                                                        </span>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-start">
                                                        <span
                                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                            Kelas
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
                                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $d->class_name }}</span>
                                                            </div>
                                                        </td>

                                                        <td class="size-px whitespace-nowrap">
                                                            <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">

                                                                <button type="button"
                                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20 cursor-pointer"
                                                                    data-hs-overlay="#edit-modal"
                                                                    onclick="setEditData('{{ $d->id }}', '{{ $d->class_name }}')">
                                                                    @include('_admin._layout.icons.pencil')
                                                                </button>
                                                                <button type="button"
                                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20 cursor-pointer"
                                                                    title="Delete" data-hs-overlay="#delete-modal"
                                                                    onclick="setDeleteData('{{ $d->id }}', '{{ $d->class_name }}')">
                                                                    @include('_admin._layout.icons.trash')
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5"
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
                    <x-admin.modal id="add-modal" title="Tambah Kelas" formId="add-form"
                        action="{{ route('admin.classrooms.do_create') }}">
                        <div class="space-y-3">
                            <div>
                                <label for="class_name" class="block text-sm font-medium mb-2 dark:text-white">Nama
                                    Kelas</label>
                                <input type="text" name="class_name" id="class_name"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    placeholder="Masukkan nama kelas" required>
                            </div>
                        </div>
                    </x-admin.modal>

                    <!-- Edit Modal -->
                    <x-admin.modal id="edit-modal" title="Edit Kelas" formId="edit-form" method="POST">
                        <div class="space-y-3">
                            <div>
                                <label for="edit-name" class="block text-sm font-medium mb-2 dark:text-white">Nama
                                    Kelas</label>
                            <input type="text" name="class_name" id="edit-name"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Masukkan nama kelas" required>
                        </div>
                    </div>
                </x-admin.modal>
                    <x-admin.modal id="delete-modal" title="Hapus Kelas">
                        <div class="text-center">
                            <span
                                class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                                @include('_admin._layout.icons.warning_modal')
                            </span>
                            <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                                Hapus Kelas
                            </h3>
                            <p class="text-gray-500 dark:text-neutral-500">
                                Apakah Anda yakin ingin menghapus <span id="delete-item-name"
                                    class="font-semibold text-gray-800 dark:text-neutral-200"></span>?
                                <br>Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>

                        <x-slot name="footer">
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
                        </x-slot>
                    </x-admin.modal>

                    <script>
                        function setEditData(id, name) {
                            document.getElementById('edit-name').value = name;
                            document.getElementById('edit-form').action = '{{ url('admin/classrooms/update') }}/' + id;
                        }

                        function setDeleteData(id, name) {
                            document.getElementById('delete-item-name').textContent = name;
                            document.getElementById('delete-form').action = '{{ url('admin/classrooms/delete') }}/' + id;
                        }
                    </script>
@endsection