<!-- SIDEBAR -->
<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-64 transform -translate-x-full xl:translate-x-0 transition-transform duration-300 ease-in-out
    bg-white shadow-xl z-50 my-2 rounded-r-2xl xl:rounded-2xl overflow-y-auto"
    aria-expanded="false">

  <style>
        .nav-link.active {
            background-color: #e5e7eb;
            font-weight: bold;
        }
        .transition-transform {
            transition: transform 0.3s ease-in-out;
        }
        #backdrop {
            transition: opacity 0.3s ease-in-out;
        }
    </style>


    <!-- Bouton menu toggle -->
    <button id="menu-toggle"
        class="xl:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-white text-slate-700 shadow-md hover:bg-blue-100 focus:outline-none transition-all duration-200">
        <i class="bi bi-list text-2xl"></i>
    </button>

    <!-- Overlay -->
    <div id="backdrop" class="hidden fixed inset-0 bg-black/40 z-40 xl:hidden transition-opacity duration-300"></div>

    <!-- Header logo -->
    <div class="h-20 relative border-b border-gray-200">
        <button id="menu-close"
            class="absolute top-3 right-3 p-2 rounded-lg text-slate-500 hover:bg-gray-100 xl:hidden transition-colors duration-200">
            <i class="bi bi-x-lg text-xl"></i>
        </button>

        <a class="flex items-center px-6 py-5" href="#">
            <img src="https://via.placeholder.com/32" 
                class="h-8 w-8 logo-transition"
                alt="Logo" />
            <span class="ml-3 font-bold text-lg text-slate-800">Argon Dashboard</span>
        </a>
    </div>

    <!-- Menu items -->
    <div class="px-4 py-6">
        <ul class="space-y-1">

            <li>
                <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100">
                        <i class="bi bi-speedometer2 text-blue-600"></i>
                    </div>
                    <span class="font-medium">Tableau de bord</span>
                </a>
            </li>

            <li>
                <a href="{{ route('gerants.index') }}" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100">
                        <i class="bi bi-truck text-amber-600"></i>
                    </div>
                    <span class="font-medium">Gérant</span>
                </a>
            </li>

            <li>
                <a href="{{ route('pharmacie.index') }}" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-green-100">
                        <i class="bi bi-building text-green-600"></i>
                    </div>
                    <span class="font-medium">Pharmacies</span>
                </a>
            </li>

            <li>
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100">
                        <i class="bi bi-capsule text-purple-600"></i>
                    </div>
                    <span class="font-medium">Médicaments</span>
                </a>
            </li>

            

            <li>
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100">
                        <i class="bi bi-truck text-amber-600"></i>
                    </div>
                    <span class="font-medium">Fournisseurs</span>
                </a>
            </li>

            <li class="pt-4 mt-4 border-t border-gray-200">
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100">
                        <i class="bi bi-gear text-gray-600"></i>
                    </div>
                    <span class="font-medium">Paramètres</span>
                </a>
            </li>

            <li>
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-red-100">
                        <i class="bi bi-box-arrow-right text-red-600"></i>
                    </div>
                    <span class="font-medium">Déconnexion</span>
                </a>
            </li>

        </ul>
    </div>
</aside>

<!-- Script -->
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('menu-toggle');
            const closeBtn = document.getElementById('menu-close');
            const backdrop = document.getElementById('backdrop');

            const open = () => {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                sidebar.setAttribute('aria-expanded', 'true');
            };
            
            const close = () => {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                sidebar.setAttribute('aria-expanded', 'false');
            };

            if (toggle) toggle.addEventListener('click', open);
            if (closeBtn) closeBtn.addEventListener('click', close);
            if (backdrop) backdrop.addEventListener('click', close);

            document.addEventListener('keydown', e => { 
                if (e.key === 'Escape' && sidebar.getAttribute('aria-expanded') === 'true') close(); 
            });

            // Gestion des liens actifs
            const currentPath = window.location.pathname.replace(/\/+$/, '');
            document.querySelectorAll('#sidebar a.nav-link').forEach(link => {
                const linkPath = new URL(link.href, window.location.origin).pathname.replace(/\/+$/, '');
                const isActive = (linkPath === currentPath) || 
                                 (linkPath !== '/' && currentPath.startsWith(linkPath));
                
                if (isActive) {
                    link.classList.add('active');
                }
            });
        });
    </script>


<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
{{-- je vais que tu corriges ce code. je vais un changement de couleur au moment du survole de champs et champs active au moment du click la couleur bleu ciel. et pour le petite ecran le menu hambuger: <!-- SIDEBAR -->
<aside id="sidebar"
    class="fixed inset-y-0 left-0 w-64 transform -translate-x-full xl:translate-x-0 transition-transform duration-300 ease-in-out
    bg-white shadow-xl z-50 my-2 rounded-r-2xl xl:rounded-2xl overflow-y-auto"
    aria-expanded="false">

    <style>
        .nav-link {
            transition: all 0.2s ease;
        }
        .nav-link.active {
            background-color: #e0f2fe; /* bleu clair */
            color: #1d4ed8; /* bleu foncé */
            font-weight: 600;
        }
        .logo-transition {
            transition: all 0.3s ease;
        }
        #sidebar {
            scrollbar-width: thin;
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
        }
        #sidebar::-webkit-scrollbar {
            width: 4px;
        }
        #sidebar::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 4px;
        }
    </style>

    <!-- Bouton menu toggle -->
    <button id="menu-toggle"
        class="xl:hidden fixed top-4 left-4 z-50 p-2 rounded-lg bg-white text-slate-700 shadow-md hover:bg-blue-100 focus:outline-none transition-all duration-200">
        <i class="bi bi-list text-2xl"></i>
    </button>

    <!-- Overlay -->
    <div id="backdrop" class="hidden fixed inset-0 bg-black/40 z-40 xl:hidden transition-opacity duration-300"></div>

    <!-- Header logo -->
    <div class="h-20 relative border-b border-gray-200">
        <button id="menu-close"
            class="absolute top-3 right-3 p-2 rounded-lg text-slate-500 hover:bg-gray-100 xl:hidden transition-colors duration-200">
            <i class="bi bi-x-lg text-xl"></i>
        </button>

        <a class="flex items-center px-6 py-5" href="#">
            <img src="https://via.placeholder.com/32" 
                class="h-8 w-8 logo-transition"
                alt="Logo" />
            <span class="ml-3 font-bold text-lg text-slate-800">Argon Dashboard</span>
        </a>
    </div>

    <!-- Menu items -->
    <div class="px-4 py-6">
        <ul class="space-y-1">

            <li>
                <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100">
                        <i class="bi bi-speedometer2 text-blue-600"></i>
                    </div>
                    <span class="font-medium">Tableau de bord</span>
                </a>
            </li>

            <li>
                <a href="{{ route('gestion') }}" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-green-100">
                        <i class="bi bi-building text-green-600"></i>
                    </div>
                    <span class="font-medium">Pharmacies</span>
                </a>
            </li>

            <li>
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-purple-100">
                        <i class="bi bi-capsule text-purple-600"></i>
                    </div>
                    <span class="font-medium">Médicaments</span>
                </a>
            </li>

            <li>
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100">
                        <i class="bi bi-truck text-amber-600"></i>
                    </div>
                    <span class="font-medium">Fournisseurs</span>
                </a>
            </li>

            <li class="pt-4 mt-4 border-t border-gray-200">
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-gray-100">
                        <i class="bi bi-gear text-gray-600"></i>
                    </div>
                    <span class="font-medium">Paramètres</span>
                </a>
            </li>

            <li>
                <a href="#" class="nav-link flex items-center px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600">
                    <div class="mr-3 flex h-8 w-8 items-center justify-center rounded-lg bg-red-100">
                        <i class="bi bi-box-arrow-right text-red-600"></i>
                    </div>
                    <span class="font-medium">Déconnexion</span>
                </a>
            </li>

        </ul>
    </div>
</aside>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar  = document.getElementById('sidebar');
    const toggle   = document.getElementById('menu-toggle');
    const closeBtn = document.getElementById('menu-close');
    const backdrop = document.getElementById('backdrop');

    const open = () => {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        sidebar.setAttribute('aria-expanded', 'true');
    };
    
    const close = () => {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        sidebar.setAttribute('aria-expanded', 'false');
    };

    if (toggle)   toggle.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    if (backdrop) backdrop.addEventListener('click', close);

    document.addEventListener('keydown', e => { 
        if (e.key === 'Escape') close(); 
    });

    // Gestion des liens actifs
    const currentPath = window.location.pathname.replace(/\/+$/, '');
    document.querySelectorAll('#sidebar a.nav-link').forEach(link => {
        const linkPath = new URL(link.href, window.location.origin).pathname.replace(/\/+$/, '');
        const isActive = (linkPath === currentPath) || (linkPath !== '/' && currentPath.startsWith(linkPath));
        
        if (isActive) {
            link.classList.add('active');
        }
    });
});
</script>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
 --}}