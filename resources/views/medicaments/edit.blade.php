<!-- Modal Edit Forme -->
<dialog id="edit-medicament-{{ $medicament->id_medicament }}"
    class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-xl w-full max-w-md">

    <!-- Header -->
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
        Modifier le medicament
    </h3>

    <!-- Formulaire Edit -->
    <form action="{{ route('medicaments.update', $medicament->id_medicament) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Nom
            </label>
            <input type="text" name="nom" value="{{ $medicament->nom }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-slate-600 py-2 px-3 focus:ring-2 focus:ring-blue-400 dark:bg-slate-700 dark:text-white">
        </div>

         <div class="sm:col-span-2">
            <label class="block text-sm font-medium text-slate-200">Description</label>
                <textarea name="description" rows="3"
            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3
             focus:ring-2 focus:ring-emerald-400">{{ $medicament->description }}</textarea>
        </div>

        <div> 
            <label class="block text-sm 
            font-medium text-slate-200">Forme <span class="text-rose-500">*</span></label>
                <select name="id_forme" required
                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                        @foreach($formes as $forme)
                            <option value="{{ $forme->id_forme }}"
                                @if($medicament->id_forme == $forme->id_forme) selected @endif>
                        {{ $forme->nom }}
                            </option> 
                                                
                                                @endforeach
                </select>
        </div>


         <div>
            <label class="block text-sm font-medium text-slate-200">Dose <span
                 class="text-rose-500">*</span></label>
                     <select name="id_dose" required
                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                                            @foreach($doses as $dose)
                                                <option value="{{ $dose->id_dose }}"  @if($medicament->id_dose == $dose->id_dose) selected @endif>
                                                    {{ $dose->quantite }}
                                                    {{ $dose->unite }}
                                                </option>
                                            @endforeach
                                        </select>
            </div>
        

        <!-- Boutons -->
        <div class="flex justify-end gap-3 mt-4">
            <button type="button" onclick="document.getElementById('edit-medicament-{{ $medicament->id_medicament }}').close()"
                class="px-4 py-2 text-sm bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-300 dark:hover:bg-slate-600">
                Annuler
            </button>

            <button type="submit"
                class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-400">
                Enregistrer
            </button>
        </div>
    </form>
</dialog>