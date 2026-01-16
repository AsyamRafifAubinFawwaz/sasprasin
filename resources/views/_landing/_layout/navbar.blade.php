<header class="fixed top-0 z-99 w-full transition-all duration-300 bg-transparent backdrop-blur shadow-none">
    <div class="max-w-7xl mx-auto px-6 md:px-10 xl:px-16 h-20 flex justify-between items-center">

        <!-- LOGO -->
        <div>
            <a href="/">
                <img src="{{ asset('/image/logo-terang.svg') }}" class="w-36 min-[380px]:w-40 min-[470px]:w-44 2xl:w-52"
                    alt="Logo" />
            </a>
        </div>

        <!-- NAV DESKTOP -->
        <ul class="hidden xl:flex gap-x-8 2xl:gap-x-12 text-[15px] 2xl:text-[16px] items-center">
            <li
                class="relative overflow-hidden hover:after:translate-x-0 hover:after:scale-100 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-5 after:h-[2.5px] after:bg-[#ff7d26] after:rounded-full after:scale-0 after:transition-transform">
                <a href="#beranda" class="nav-link">Beranda</a>
            </li>
            <li
                class="relative overflow-hidden hover:after:translate-x-0 hover:after:scale-100 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-5 after:h-[2.5px] after:bg-[#ff7d26] after:rounded-full after:scale-0 after:transition-transform">
                <a href="#keunggulan" class="nav-link">Keunggulan</a>
            </li>
            <li
                class="relative overflow-hidden hover:after:translate-x-0 hover:after:scale-100 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-5 after:h-[2.5px] after:bg-[#ff7d26] after:rounded-full after:scale-0 after:transition-transform">
                <a href="#cara-kerja" class="nav-link">Cara Kerja Aplikasi</a>
            </li>
            <li
                class="relative overflow-hidden hover:after:translate-x-0 hover:after:scale-100 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-5 after:h-[2.5px] after:bg-[#ff7d26] after:rounded-full after:scale-0 after:transition-transform">
                <a href="#role" class="nav-link">Fitur</a>
            </li>

        </ul>

        <!-- BUTTON DESKTOP -->
        <a href="/login" class="hidden xl:flex items-center gap-x-3 text-[14px] 2xl:text-[16px]
            px-5 py-2 rounded-full font-semibold text-gray-100 bg-[#ff7d26]">
            Masuk
        </a>

        <!-- HAMBURGER -->
        <div id="hamburger" class="xl:hidden cursor-pointer relative w-7 h-6 flex items-center justify-center flex-col">
            <span
                class="w-7 h-[3px] bg-black block rounded-full absolute transition duration-300 top-0 origin-top-left"></span>
            <span
                class="w-7 h-[3px] bg-black block rounded-full absolute transition duration-300 top-1/2 -translate-y-1/2"></span>
            <span
                class="w-7 h-[3px] bg-black block rounded-full absolute transition duration-300 bottom-0 origin-bottom-left"></span>
        </div>

    </div>
</header>


<!-- NAV MOBILE -->
<div id="nav-mobile" class="fixed bg-white/70 backdrop-blur-sm shadow-md z-99 w-full
    flex flex-col mt-20 xl:hidden transition duration-500 translate-x-[2000px]">

    <li class="list-none text-center py-3"><a href="#beranda" class="nav-link">Beranda</a></li>
    <li class="list-none text-center py-3"><a href="#keunggulan" class="nav-link">Keunggulan</a></li>
    <li class="list-none text-center py-3"><a href="#cara-kerja" class="nav-link">Cara Kerja Aplikasi</a></li>
    <li class="list-none text-center py-3"><a href="#role" class="nav-link">Fitur</a></li>


    <li class="flex justify-center py-3">
        <a href="/login" class="flex items-center gap-x-3 px-5 py-2 rounded-full text-sm min-[768px]:text-[15px]
            font-semibold text-gray-100 bg-[#ff7d26]">
            @include('_landing._layout.icons.log-in') Masuk
        </a>
    </li>
</div>
<script>
    const hamburger = document.getElementById("hamburger");
    const navMobile = document.getElementById("nav-mobile");

    hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        navMobile.classList.toggle("translate-x-[2000px]");
        navMobile.classList.toggle("translate-x-0");
    });

    // Smooth scrolling for all nav links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                // Close mobile menu if open
                if (!navMobile.classList.contains('translate-x-[2000px]')) {
                    hamburger.classList.remove('active');
                    navMobile.classList.add('translate-x-[2000px]');
                    navMobile.classList.remove('translate-x-0');
                }

                // Smooth scroll to section
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Scroll spy - detect active section and highlight nav link
    function setActiveNavLink() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        let currentSection = '';
        // Better offset: navbar height (80px) + small buffer
        const scrollPosition = window.scrollY + 120;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });

        // If no section detected and we're at the top, default to first section
        if (!currentSection && window.scrollY < 200) {
            currentSection = 'beranda';
        }

        console.log('Current section:', currentSection, 'Scroll Y:', window.scrollY);

        navLinks.forEach(link => {
            const parent = link.parentElement;
            const href = link.getAttribute('href').substring(1); // Remove #

            if (href === currentSection) {
                // Add active state
                parent.classList.add('active-nav');
            } else {
                // Remove active state
                parent.classList.remove('active-nav');
            }
        });
    }

    // Run on scroll
    window.addEventListener('scroll', setActiveNavLink);
    // Run on page load
    window.addEventListener('load', setActiveNavLink);
</script>

<style>
    #hamburger.active span:nth-child(1) {
        transform: rotate(52deg);
    }

    #hamburger.active span:nth-child(2) {
        transform: scale(0);
    }

    #hamburger.active span:nth-child(3) {
        transform: rotate(-52deg);
    }

    /* Active nav link state - shows orange underline when in section */
    li.active-nav::after {
        opacity: 1 !important;
        transform: translateX(0) scale(1) !important;
        visibility: visible !important;
        display: block !important;
    }
</style>