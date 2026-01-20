@extends('_admin._layout.auth')

@section('title', 'Login')

@section('content')
    <div
        class="flex flex-col md:flex-row w-full max-w-4xl bg-white shadow-md dark:bg-neutral-900 border border-gray-100 dark:border-neutral-700 rounded-2xl overflow-hidden min-h-[500px]">
        <!-- Left Side: Login Form -->
        <div class="w-full md:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
            <div class="text-center mb-8">
                <h1 class="block text-3xl font-bold text-gray-800 dark:text-white">Login Aplikasi</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                    Jika memiliki Akun, silahkan login
                </p>
            </div>

            <form id="login-form" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="grid gap-y-4">
                    @error('login_error')
                        <div class="bg-red-50 border border-red-200 text-sm text-red-600 rounded-lg p-4 mb-4 dark:bg-red-800/10 dark:border-red-900 dark:text-red-500"
                            role="alert" tabindex="-1" aria-labelledby="hs-soft-color-danger-label">
                            <span id="hs-soft-color-danger-label" class="font-bold"></span> {{ $message }}
                        </div>
                    @enderror

                    <div>
                        <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                        <div class="relative">
                            <input type="email" id="email" name="email"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required aria-describedby="email-error">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-orange-500 focus:ring-orange-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required aria-describedby="password-error">
                        </div>
                    </div>

                    <button type="submit" id="login-btn"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-lg font-extrabold rounded-lg border border-transparent bg-orange-600 text-white hover:bg-orange-700 transition-all disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 cursor-pointer">
                        <span id="btn-text">M A S U K</span>
                        <span id="btn-spinner"
                            class="animate-spin size-4 border-[3px] border-current border-t-transparent text-white rounded-full hidden"
                            role="status" aria-label="loading">
                            <span class="sr-only">Loading...</span>
                        </span>
                        <span id="btn-loading-text" class="hidden">Loading...</span>
                    </button>
                </div>
            </form>
        </div>

        <div
            class="hidden md:flex md:w-1/2  bg-orange-400 items-center justify-center p-12 text-white relative overflow-hidden">
            <div class="absolute -top-24 -left-24 size-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 size-64 bg-orange-400/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 text-center flex flex-col items-center">
                <h1 class="text-3xl lg:text-4xl font-extrabold leading-tight mb-6 drop-shadow-md">
                    Selamat Datang di<br>
                    <span class="text-orange-200">SASPRASIN</span>
                </h1>

                <div class="relative group">
                    <div
                        class="absolute inset-0 bg-white/10 blur-2xl rounded-full scale-95 group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <img src="{{ asset('image/service.png') }}" alt="Service Image"
                        class="relative z-10 max-w-xs h-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function () {
            const btn = document.getElementById('login-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');
            const btnLoadingText = document.getElementById('btn-loading-text');

            btn.disabled = true;
            btnText.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            btnSpinner.classList.add('inline-block');
            btnLoadingText.classList.remove('hidden');
        });
    </script>
@endsection