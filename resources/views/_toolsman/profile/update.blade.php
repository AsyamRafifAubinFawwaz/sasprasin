@extends('_student._layout.app')

@section('title', 'Ubah Profil')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div
            class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Ubah Profil
                    </h2>
                </div>
            </div>

            <form id="update-profile-form" class="p-6" navigate-form action="{{ route('student.profile.do_update') }}"
                method="POST">
                @csrf

                <div class="space-y-4">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama
                            <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan nama anda" required>
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium mb-2 dark:text-white">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Masukkan email anda" required>
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-4 flex justify-start gap-x-2">
                    <button type="submit"
                        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-bold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer transition-all active:scale-95 shadow-md shadow-orange-500/20">
                        @include('_admin._layout.icons.sidebar.change-password')
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
