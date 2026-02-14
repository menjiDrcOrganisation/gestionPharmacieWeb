<div class="overflow-x-auto">
    <table id="medicamentsTable" class="min-w-full border-collapse text-slate-500 dark:text-white/80">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-400 dark:text-white">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-400 dark:text-white">Description</th>
                <th class="px-6 py-3 text-left text-xs font-bold uppercase text-slate-400 dark:text-white">Quantité</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-400 dark:text-white">Prix</th>
                <th class="px-6 py-3 text-center text-xs font-bold uppercase text-slate-400 dark:text-white">Date création</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicaments as $medicament)
            <tr class="hover:bg-slate-100 dark:hover:bg-slate-700">
                <td class="p-2 border-b dark:border-white/40">
                    <h6 class="text-sm dark:text-white">{{ $medicament->nom }}</h6>
                </td>
                <td class="p-2 border-b dark:border-white/40">
                    <p class="text-xs text-slate-400 dark:text-white dark:opacity-80">{{ $medicament->description }}</p>
                </td>
                <td class="p-2 border-b dark:border-white/40">
                    <p class="text-xs dark:text-white">{{ $medicament->quantite }}</p>
                </td>
                <td class="p-2 text-center border-b dark:border-white/40">
                    <span class="text-xs dark:text-white">{{ number_format($medicament->prix, 2, ',', ' ') }} FC</span>
                </td>
                <td class="p-2 text-center border-b dark:border-white/40">
                    <span class="text-xs text-slate-400 dark:text-white dark:opacity-80">{{ $medicament->created_at->format('d/m/Y') }}</span>
                </td>
                <td class="p-2 border-b dark:border-white/40 text-center">
                    <button command="show-modal" commandfor="edit-medicament-{{ $medicament->id }}"
                        class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                        Edit
                    </button>

                    {{-- Include modal edit --}}
                    {{-- @include('medicaments.edit', ['medicament' => $medicament]) --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- JS recherche simple pour les médicaments -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchMedicInput');
    if(!searchInput) return;
    
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#medicamentsTable tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
});
</script>
