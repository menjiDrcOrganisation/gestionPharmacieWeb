<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}" />
    <title>Gestion Pharmacies</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

body {
    font-family: 'Roboto', sans-serif;
}

  </style>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" />
    <!-- Popper -->

    <head>
        <!-- Tailwind via CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Font Awesome via CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="{{ asset('assets/css/argon-dashboard-tailwind.css?v=1.0.1') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Tailwind déjà présent dans ton projet (j'imagine) -->
<!-- Lucide icons (CDN) -->
<script src="https://unpkg.com/lucide@latest/dist/lucide.min.js"></script>

</head>

<body
    class="m-0 font-roboto  text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">

    <!-- Header visible seulement sur mobile -->
<header class="flex items-center justify-between px-4 py-3 bg-white shadow md:hidden">
  <a href="{{ route('medicaments.index') }}" class="flex items-center gap-2">
    <img src="{{ asset('assets/img/logo.png') }}" class="h-8" alt="logo">
    <span class="font-semibold">Opharma</span>
  </a>
  <!-- bouton menu (hamburger) -->
  <button id="sidebarToggle" aria-expanded="false" aria-controls="sidebar"
          class="p-2  rounded-md hover:bg-gray-100">
          <!-- icône "menu" (list) - taille ~1.5rem, fond noir, icône blanche -->
<i class="bi bi-list fs-4 bg-gray-200 text-white" style="padding:0.25rem; border-radius:0.25rem;"></i>

    {{-- <i data-lucide="menu" class="w-6 h-6 bg-black"></i> --}}
  </button>
</header>

<!-- Overlay (fond noir transparent quand sidebar est ouvert) -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40 md:hidden"></div>

<div class="block md:hidden">
  <!-- Sidebar -->
  <aside id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-50 md:translate-x-0 md:static md:shadow-none">
    <div class="flex items-center justify-between p-4 border-b">
      {{-- <span class="font-bold">Menu</span> --}}
      <a href="{{ route('medicaments.index') }}" class="flex items-center gap-3">
        <img src="{{ asset('assets/img/logo.png') }}" class="h-8" alt="logo">
        <span class="text-lg font-semibold text-gray-800 dark:text-white">Opharma</span>
      </a>
      <button id="sidebarClose" class="md:hidden">
        <i data-lucide="x" class="bi bi-x fs-4 text-white bg-gray-200  p-1 rounded"></i>
      </button>
    </div>
    <!-- contenu du sidebar -->
    {{-- @include('layouts.asides') --}}

    <!-- Overlay (visible sur mobile quand sidebar ouvert) -->
    {{-- <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 dark:border-slate-800">
      <a href="{{ route('medicaments.index') }}" class="flex items-center gap-3">
        <img src="{{ asset('assets/img/logo.png') }}" class="h-8" alt="logo">
        <span class="text-lg font-semibold text-gray-800 dark:text-white">Opharma</span>
      </a>
    </div> --}}

    <!-- Liste menu -->
    <nav class="px-3 py-6 space-y-1">
      <!-- Exemple d'item : on maintient la logique request()->routeIs pour l'active state -->
      <a href="{{ route('dashboard') }}"
        class="flex items-center gap-3 px-4 py-2 rounded-lg font-roboto font-light text-sm transition-colors
                {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-green-200 to-green-200/70 p-4 rounded-lg  text-white' : 'text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-200 hover:to-green-200/70 transition-all duration-300' }}">
          <img src="{{ asset('icons/dashboard.png') }}" class="w-5 h-5 hover:text-white" alt="Dashboard">
        <span>Tableau de bord</span>
      </a>

      <a href="{{ route('pharmacies.index') }}"
        class="flex items-center gap-3 px-4 py-2 font-roboto font-light rounded-lg text-sm transition-colors
                {{ request()->routeIs('pharmacies.*') ? 'bg-gradient-to-r from-green-200 to-green-200/70 p-4 rounded-lg  text-white' : 'text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-200 hover:to-green-200/70 transition-all duration-300' }}">
          <img src="{{ asset('icons/pharmacy.png') }}" class="w-5 h-5 " alt="Pharmacie">
        <span>Pharmacies</span>
      </a>

      <a href="{{ route('medicaments.index') }}"
        class="flex items-center gap-3 px-4 py-2 font-roboto font-light rounded-lg text-sm transition-colors
                {{ request()->routeIs('medicaments.*') ? 'bg-gradient-to-r from-green-200 to-green-200/70 p-4 rounded-lg  text-white' : 'text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-200 hover:to-green-200/70 transition-all duration-300' }}">
          <img src="{{ asset('icons/drugs.png') }}" class="w-5 h-5 " alt="Medicament">
        <span>Médicaments</span>
      </a>

      <a href="{{ route('doses.index') }}"
        class="flex items-center gap-3 px-4 py-2 font-roboto font-light rounded-lg text-sm transition-colors
                {{ request()->routeIs('doses.*') ? 'bg-gradient-to-r from-green-200 to-green-200/70 p-4 rounded-lg  text-white' : 'text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-200 hover:to-green-200/70 transition-all duration-300' }}">
        <img src="{{ asset('icons/medication.png') }}" class="w-5 h-5 " alt="Doses et Formes">
        <span>Doses et Formes</span>
      </a>

      <a href="{{ route('gerants.index') }}"
        class="flex items-center gap-3 px-4 py-2 font-roboto font-light rounded-lg text-sm transition-colors
                {{ request()->routeIs('gerants.*') ? 'bg-gradient-to-r from-green-200 to-green-200/70 p-4 rounded-lg  text-white' : 'text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-200 hover:to-green-200/70 transition-all duration-300' }}">
          <img src="{{ asset('icons/user.png') }}" class="w-5 h-5 " alt="Gerant">
        <span>Gérants</span>
      </a>

      <hr class="my-3 border-t border-gray-100 dark:border-slate-800">

      <h6 class="px-4 text-xs font-bold uppercase text-gray-400 dark:text-gray-500">Account pages</h6>

      <a href="{{ route('admins.index') }}"
        class="flex items-center gap-3 px-4 font-roboto font-light py-2 rounded-lg text-sm transition-colors
                {{ request()->routeIs('admins.*') ? 'bg-gradient-to-r from-green-200 to-green-200/70 p-4 rounded-lg  text-white' : 'text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-200 hover:to-green-200/70 transition-all duration-300' }}">
                <img src="{{ asset('icons/user.png') }}" class="w-5 h-5 " alt="Admin">
        <span>Admins</span>
      </a>

      <a href="{{ route('profile.edit') }}"
        class="flex items-center gap-3 px-4 font-roboto font-light py-2 rounded-lg text-sm transition-colors
                {{ request()->routeIs('profile.*') ? 'bg-gradient-to-r from-green-200 to-green-200/70 p-4 rounded-lg  text-white' : 'text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-200 hover:to-green-200/70 transition-all duration-300' }}">
          <img src="{{ asset('icons/setting.png') }}" class="w-5 h-5 " alt="Profil">
        <span>Profil</span>
      </a>

      <!-- Bouton déconnexion (ouvre modal) -->
      <button onclick="document.getElementById('logout-dialog').showModal();"
              class="w-full text-left flex items-center  font-light gap-3 px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-gradient-to-r hover:text-white hover:from-green-200 hover:to-green-200/70 transition-all duration-300">
        <img src="{{ asset('icons/turn-off.png') }}" class="w-5 h-5 " alt="deconnexion">
        <span>Déconnexion</span>
      </button>
    </nav>

  <!-- Modal Déconnexion -->
  <dialog id="logout-dialog" class="rounded-2xl p-0 w-full max-w-md">
    <form method="POST" action="{{ route('logout') }}" class="flex flex-col bg-white dark:bg-slate-900 rounded-2xl shadow-lg overflow-hidden">
      @csrf
      <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-red-400 to-red-400 text-white">
        <h3 class="text-lg font-semibold">Confirmation</h3>
        <button type="button" onclick="document.getElementById('logout-dialog').close();" aria-label="Fermer">
          <i data-lucide="x" class="w-5 h-5"></i>
        </button>
      </div>

      <div class="p-6">
        <p class="text-sm text-gray-700 dark:text-gray-300">Voulez-vous vraiment vous déconnecter ?</p>
      </div>

      <div class="flex justify-end gap-3 px-6 py-4 bg-gray-50 dark:bg-slate-800">
        <button type="button" onclick="document.getElementById('logout-dialog').close();" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Annuler</button>
        <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-500">Confirmer</button>
      </div>
    </form>
  </dialog>
</div>
</aside>

      
    @include('layouts.aside')
    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        {{-- @include('layouts.navbar') --}}

        <!-- end Navbar -->

        <!-- cards -->
        @yield('content')
        <!-- end cards -->
    </main>

</body>


<!-- plugin for charts  -->
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>
<!-- plugin for scrollbar  -->
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
<!-- main script file  -->
<script src="{{ asset('assets/js/argon-dashboard-tailwind.js?v=1.0.1') }}" async></script>
<script>
    // initialisation Lucide
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('sidebarClose');
  
    function openSidebar() {
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
      toggle?.setAttribute('aria-expanded', 'true');
    }
    function closeSidebar() {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
      toggle?.setAttribute('aria-expanded', 'false');
    }
  
    toggle?.addEventListener('click', (e) => {
      const expanded = toggle.getAttribute('aria-expanded') === 'true';
      if (expanded) closeSidebar();
      else openSidebar();
    });
  
    closeBtn?.addEventListener('click', closeSidebar);
    overlay?.addEventListener('click', closeSidebar);
  
    // Fermer sidebar quand on resize >= md (pour remettre l'état si nécessaire)
    window.addEventListener('resize', () => {
      if (window.innerWidth >= 768) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.add('hidden');
        toggle?.setAttribute('aria-expanded', 'true');
      } else {
        // par défaut sur mobile : fermé
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        toggle?.setAttribute('aria-expanded', 'false');
      }
    });
  </script>
  

</html>
