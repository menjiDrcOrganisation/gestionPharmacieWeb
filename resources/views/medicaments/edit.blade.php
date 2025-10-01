<!-- Modal Edit Medicament -->
<dialog id="edit-medicament-{{ $medicament->id_medicament }}"
    class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-lg">

    <!-- Header -->
    <div class="flex items-center gap-3 border-b pb-3 mb-4">
        {{-- <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" alt="icon" class="w-6 h-6"> --}}
        <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-100">
            Modifier le médicament
        </h3>
    </div>

    <!-- Formulaire Edit -->
    <form action="{{ route('medicaments.update', $medicament->id_medicament) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">Nom <span class="text-rose-500">*</span></label>
            <input type="text" name="nom" value="{{ $medicament->nom }}" required
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">Description</label>
            <textarea name="description" rows="3"
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">{{ $medicament->description }}</textarea>
        </div>

        <!-- Forme -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">Forme <span class="text-rose-500">*</span></label>
            <select name="id_forme" required
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                @foreach($formes as $forme)
                    <option value="{{ $forme->id_forme }}" @if($medicament->id_forme == $forme->id_forme) selected @endif>
                        {{ $forme->nom }}
                            </option>

                                                @endforeach
                </select>
        </div>

        <!-- Dose -->
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 text-left">Dose <span class="text-rose-500">*</span></label>
            <select name="id_dose" required
                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                @foreach($doses as $dose)
                    <option value="{{ $dose->id_dose }}" @if($medicament->id_dose == $dose->id_dose) selected @endif>
                        {{ $dose->quantite }} {{ $dose->unite }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-3 pt-4 border-t">
            <button type="button"
                onclick="document.getElementById('edit-medicament-{{ $medicament->id_medicament }}').close()"
                class="px-4 py-2 text-sm font-medium bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg hover:bg-slate-300 dark:hover:bg-slate-600">
                Annuler
            </button>

            <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600
                rounded-lg hover:bg-emerald-500 shadow">
                Mettre à jour
            </button>
        </div>
    </form>
</dialog>
