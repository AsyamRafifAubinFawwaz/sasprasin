<header
    class="inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-48 fixed w-full bg-white border-b border-gray-200 text-sm py-2.5 lg:py-0 xl:py-0 lg:ps-65 dark:bg-neutral-800 dark:border-neutral-700">
    <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
        <div class="me-5 lg:me-0 lg:hidden flex items-center">
            <button type="button"
                class="me-2 size-8 flex justify-center items-center gap-x-2 border border-gray-200 text-gray-800 hover:text-gray-500 rounded-lg focus:outline-hidden focus:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-application-sidebar"
                aria-label="Toggle navigation" data-hs-overlay="#hs-application-sidebar">
                <span class="sr-only">Toggle Navigation</span>
                @include('_admin._layout.icons.square-menu')
            </button>

            <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-hidden focus:opacity-80"
                href="#" aria-label="Preline">
                @include('_admin._layout.icons.sidebar.logo')
            </a>
        </div>

        <div class="w-full flex items-center justify-end ms-auto gap-x-1 md:gap-x-3">
        </div>
    </nav>
</header>