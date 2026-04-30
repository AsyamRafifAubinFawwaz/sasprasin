@extends('_admin._layout.app')

@section('title', 'Update ' . $page['title'])

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
        <div
            class="lg:col-span-2 bg-white shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center">
                <a navigate href="{{ route('admin.toolsmans.index') }}"
                    class="py-3 px-3 inline-flex items-center gap-x-2 text-xl rounded-xl border border-gray-200 bg-white text-gray-800 shadow-md hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="90" height="90"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a>
                <div class="ms-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Edit {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form id="update-form" class="p-6" navigate-form action="{{ route('admin.toolsmans.do_update', $data->id) }}"
                method="POST">
                @csrf

                <div class="space-y-4">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Petugas <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $data->name) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Contoh: Budi Santoso" required>
                        @error('name')
                            <p class="text-xs text-red-600 mt-2" id="name-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium mb-2 dark:text-white">Email <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="email" id="email" name="email" value="{{ old('email', $data->email) }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="Masukkan email petugas" required>
                        </div>
                        @error('email')
                            <p class="text-xs text-red-600 mt-2" id="email-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium mb-2 dark:text-white">No. HP / WA <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $data->phone) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('phone') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Contoh: 08123456789" required>
                        @error('phone')
                            <p class="text-xs text-red-600 mt-2" id="phone-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="skill" class="block text-sm font-medium mb-2 dark:text-white">Keahlian <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="skill" name="skill" value="{{ old('skill', $data->skill) }}"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('skill') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Contoh: Listrik, Air, Bangunan" required>
                        @error('skill')
                            <p class="text-xs text-red-600 mt-2" id="skill-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-8 flex justify-start gap-x-2">
                    <a navigate href="{{ route('admin.toolsmans.index') }}"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-orange-700 dark:text-orange-300 dark:hover:bg-orange-800">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-bold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer shadow-md shadow-orange-500/20 active:scale-95 transition-all">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Task History Panel --}}
  
    </div>
@endsection
