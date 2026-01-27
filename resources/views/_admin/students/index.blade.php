@extends('_admin._layout.app')

@section('title', 'Manajemen Siswa')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Manajemen Siswa
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-orange-600 text-white hover:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-orange-700 transition-all shadow-md shadow-orange-500/20 active:scale-95 cursor-pointer"
                    href="{{ route('admin.students.add') }}">
                    @include('_admin._layout.icons.add')
                    Tambah Siswa
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <div class="px-2 pt-2">
            <form action="{{ route('admin.students.index') }}" method="GET" navigate-form
                class="flex flex-wrap items-center gap-3">

                <div class="relative w-64 max-w-full">
                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                        class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 shadow-sm"
                        placeholder="Cari Nama Siswa">
                </div>

                <div class="w-48 max-w-full">
                    <select name="classroom_id" data-hs-select='{
                            "placeholder": "Semua Kelas",
                            "toggleTag": "<button type=\"button\"></button>",
                            "toggleClasses": "py-2 px-3 pe-9 w-full text-start border border-gray-200 rounded-lg text-sm bg-white dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 shadow-sm",
                            "dropdownClasses": "mt-2 z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-neutral-800 dark:border-neutral-700",
                            "optionClasses": "py-2 px-3 w-full text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-300 dark:hover:bg-neutral-700",
                            "optionSelectedClasses": "bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-400"
                        }'>
                        <option value="">Semua Kelas</option>
                        @foreach ($classrooms as $class)
                            <option value="{{ $class->id }}"
                                {{ ($classroom_id ?? request('classroom_id')) == $class->id ? 'selected' : '' }}>
                                {{ $class->display_name ?? $class->class_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="py-2 px-6 text-sm font-bold rounded-lg bg-orange-600 text-white hover:bg-orange-700 cursor-pointer flex items-center justify-center gap-x-2 transition-all active:scale-95 shadow-md shadow-orange-500/20">
                        @include('_admin._layout.icons.search')
                        Cari
                    </button>

                    @if (!empty($keywords) || !empty($classroom_id))
                        <a class="py-2 px-4 text-sm font-semibold rounded-lg border border-orange-600/20 text-orange-600 hover:bg-orange-50 dark:hover:bg-orange-900/10 cursor-pointer flex items-center justify-center gap-x-2 transition-all active:scale-95"
                            href="{{ route('admin.students.index') }}">
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
                                            No
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Nama
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Email
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
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
                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $d->name }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-neutral-200">{{ $d->email }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                    {{ $d->display_class }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">
                                                <button type="button"
                                                    class="p-2 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-yellow-100 text-yellow-800 hover:bg-yellow-200 focus:outline-none focus:bg-yellow-200 disabled:opacity-50 disabled:pointer-events-none dark:text-yellow-400 dark:bg-yellow-800/30 dark:hover:bg-yellow-800/20 dark:focus:bg-yellow-800/20 cursor-pointer"
                                                    title="Reset Password" data-hs-overlay="#reset-password-modal"
                                                    onclick="setResetPasswordData('{{ $d->id }}', '{{ $d->name }}')">
                                                    @include('_admin._layout.icons.reset')
                                                </button>
                                                <a navigate
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 dark:focus:bg-blue-800/20"
                                                    href="{{ route('admin.students.update', $d->id) }}">
                                                    @include('_admin._layout.icons.pencil')
                                                </a>
                                                <button type="button"
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 dark:focus:bg-red-800/20 cursor-pointer"
                                                    title="Delete" data-hs-overlay="#delete-modal"
                                                    onclick="setDeleteData('{{ $d->id }}', '{{ $d->name }}')">
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

    
    <x-admin.modal id="delete-modal" title="Hapus Data Siswa">
        <div class="text-center">
            <span
                class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                @include('_admin._layout.icons.warning_modal')
            </span>
            <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                Hapus Data Siswa
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
    <!-- Reset Password Confirmation Modal -->
    <x-admin.modal id="reset-password-modal" title="Reset Password">
        <div class="text-center">
            <span
                class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-yellow-50 bg-yellow-100 text-yellow-500 dark:bg-yellow-700 dark:border-yellow-600 dark:text-yellow-100">
                @include('_admin._layout.icons.reset')
            </span>

            <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                Reset Password
            </h3>
            <p class="text-gray-500 dark:text-neutral-500">
                Apakah Anda yakin ingin mereset password <span id="reset-item-name"
                    class="font-semibold text-gray-800 dark:text-neutral-200"></span>?
                <br>Password akan direset menjadi default: <span class="font-bold text-blue-600">asdasd</span>
            </p>
        </div>

        <x-slot name="footer">
            <button type="button"
                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                data-hs-overlay="#reset-password-modal">
                Batal
            </button>
            <form id="reset-form" method="POST" class="inline" navigate-form>
                @csrf
                <button type="submit"
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-600 text-white hover:bg-yellow-700 focus:outline-none focus:bg-yellow-700 disabled:opacity-50 disabled:pointer-events-none">
                    Ya, Reset
                </button>
            </form>
        </x-slot>
    </x-admin.modal>

    <script>
        function setDeleteData(id, name) {
            document.getElementById('delete-item-name').textContent = name;
            document.getElementById('delete-form').action = '{{ url('admin/students/delete') }}/' + id;
        }

        function setResetPasswordData(id, name) {
            document.getElementById('reset-item-name').textContent = name;
            document.getElementById('reset-form').action = '{{ url('admin/students/reset-password') }}/' + id;
        }
    </script>
@endsection
