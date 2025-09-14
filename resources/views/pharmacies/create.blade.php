

    <!-- Panel du modal -->
    <div class="relative w-full max-w-2xl mx-4 bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h2 class="text-lg font-medium">Ajouter une pharmacie</h2>
            <button id="closePharmacyModal" class="text-slate-500 hover:text-slate-700">✕</button>
        </div>

        <div class="px-6 py-6">
            <form action="{{ route('pharmacies.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @csrf

                <!-- Nom -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Nom <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required
                        class="mt-1 block w-full rounded-md border border-slate-200 py-2 px-3 focus:ring-2 focus:ring-emerald-300">
                </div>

                <!-- Téléphone -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">Téléphone <span class="text-rose-500">*</span></label>
                    <input type="tel" name="phone" required
                        class="mt-1 block w-full rounded-md border border-slate-200 py-2 px-3 focus:ring-2 focus:ring-emerald-300">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email"
                        class="mt-1 block w-full rounded-md border border-slate-200 py-2 px-3 focus:ring-2 focus:ring-emerald-300">
                </div>

                <!-- Adresse -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Adresse</label>
                    <input type="text" name="address"
                        class="mt-1 block w-full rounded-md border border-slate-200 py-2 px-3 focus:ring-2 focus:ring-emerald-300">
                </div>

                <!-- Ville -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">Ville</label>
                    <input type="text" name="city"
                        class="mt-1 block w-full rounded-md border border-slate-200 py-2 px-3 focus:ring-2 focus:ring-emerald-300">
                </div>

                <!-- Propriétaire -->
                <div>
                    <label class="block text-sm font-medium text-slate-700">Propriétaire</label>
                    <input type="text" name="owner"
                        class="mt-1 block w-full rounded-md border border-slate-200 py-2 px-3 focus:ring-2 focus:ring-emerald-300">
                </div>

                <!-- Logo -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-700">Logo</label>
                    <input type="file" name="logo" accept="image/*"
                        class="mt-1 block w-full text-sm border border-slate-200 rounded-md p-2">
                </div>

                <!-- Boutons -->
                <div class="sm:col-span-2 flex items-center justify-end gap-3 pt-2 border-t mt-2">
                    <button type="button" id="cancelPharmacyModal"
                        class="px-4 py-2 rounded-md bg-slate-100 text-slate-700 hover:bg-slate-200">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded-md bg-emerald-600 text-white hover:bg-emerald-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const pharmacyModal = document.getElementById('pharmacyModal');
    const openBtn = document.getElementById('openModalBtn'); // bouton principal dans ta vue
    const closeBtn = document.getElementById('closePharmacyModal');
    const cancelBtn = document.getElementById('cancelPharmacyModal');
    const backdrop = document.getElementById('modalBackdrop');

    function openModal() {
        pharmacyModal.classList.remove('hidden');
        pharmacyModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        pharmacyModal.classList.add('hidden');
        pharmacyModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    if (openBtn) openBtn.addEventListener('click', openModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
    if (backdrop) backdrop.addEventListener('click', closeModal);
</script>
