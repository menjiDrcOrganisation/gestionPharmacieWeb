<aside
    class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-blue-500 dark:bg-slate-800 border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
            href="{{ route('medicaments.index') }}" target="_blank">
            <img src="{{ asset('assets/img/logo.png') }}"s
                class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8"
                alt="main_logo" />
            <img src="./assets/img/logo.png"
                class="hidden h-full max-w-full transition-all duration-200 dark:inline ease-nav-brand max-h-8"
                alt="main_logo" />
            <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Opharma</span>
        </a>
    </div>

    <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

    <ul class="flex flex-col pl-0 mb-0">
        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('dashboard') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 transition-colors"
                href="{{ route('dashboard') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Tableau de bord</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('pharmacies.*') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('pharmacies.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Pharmacies</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('medicaments.*') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('medicaments.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-credit-card"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Medicaments</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('doses.*') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('doses.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-cyan-500 ni ni-app"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Doses et Formes</span>
            </a>
        </li>

        {{-- <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('autres.*') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('autres.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-red-600 ni ni-world-2"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Autres</span>
            </a>
        </li> --}}
 <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('gerants.*') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('gerants.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Gerants</span>
            </a>
        </li>

        <li class="w-full mt-4">
            <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Account
                pages</h6>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('admins.*') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('admins.index') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Admins</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('profile.*') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('profile.edit') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-single-copy-04"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profils</span>
            </a>
        </li>

        <li class="mt-0.5 w-full">
            <a class="py-2.7 {{ request()->routeIs('logout') ? 'bg-blue-500/13 font-semibold' : '' }} dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                href="{{ route('logout') }}">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-cyan-500 ni ni-collection"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Déconnexion</span>
            </a>
        </li>
    </ul>
</aside>
