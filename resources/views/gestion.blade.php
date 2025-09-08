@extends('layouts.main')

@section('titre', 'Gestion')

@section('content')
<section id="gestion" class="min-h-screen py-8 bg-gray-50">
  <!-- Section Title -->
  <div class="container mx-auto px-4 mb-8 text-center">
    <h2 class="text-3xl font-bold text-gray-800 mb-2">Gestion</h2>
    <p class="text-gray-600">Accédez rapidement à vos modules de gestion</p>
  </div><!-- End Section Title -->

  <div class="container mx-auto px-4">


    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Bloc Pharmacies -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden relative transition-all duration-300 hover:shadow-md hover:-translate-y-1">
        <div class="p-6">
          <div class="text-green-500 text-4xl mb-4 flex justify-center">
            <i class="bi bi-hospital"></i>
          </div>
          <a href="{{ route('pharmacie.index') }}" class="no-underline">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Pharmacies</h3>
          </a>
          
        </div>
        <a href="" class="absolute inset-0 z-10"></a>
      </div><!-- End Service Item -->

      <!-- Bloc Médicaments -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden relative transition-all duration-300 hover:shadow-md hover:-translate-y-1">
        <div class="p-6">
          <div class="text-blue-500 text-4xl mb-4 flex justify-center">
            <i class="bi bi-capsule"></i>
          </div>
          <a href="" class="no-underline">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Médicaments</h3>
          </a>
          
        </div>
        
      </div><!-- End Service Item -->

      <!-- Bloc Fournisseurs -->
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden relative transition-all duration-300 hover:shadow-md hover:-translate-y-1">
        <div class="p-6">
          <div class="text-yellow-500 text-4xl mb-4 flex justify-center">
            <i class="bi bi-truck"></i>
          </div>
          <a href="" class="no-underline">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Fournisseurs</h3>
          </a>
          
        </div>
       
      </div><!-- End Service Item -->
    </div>
  </div>
</section>
@endsection