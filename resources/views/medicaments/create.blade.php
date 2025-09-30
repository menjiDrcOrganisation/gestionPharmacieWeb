<el-dialog>
    <dialog id="dialog_medoc" aria-labelledby="dialog-title"
        class="fixed inset-0 m-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent p-0 backdrop:bg-transparent">
        <el-dialog-backdrop
            class="fixed inset-0 bg-gray-900/50 transition-opacity data-[closed]:opacity-0 data-[enter]:duration-300 data-[leave]:duration-200 data-[enter]:ease-out data-[leave]:ease-in"></el-dialog-backdrop>

        <div tabindex="0"
            class="flex min-h-full items-end justify-center p-4 text-center focus:outline focus:outline-0 sm:items-center sm:p-0">
            <el-dialog-panel
                class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg data-[closed]:translate-y-4 data-[closed]:opacity-0 sm:data-[closed]:sm:translate-y-0 sm:data-[closed]:scale-95">

                <!-- Header -->
                <div class="bg-white px-6 py-4 border-b border-gray-700 flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-500/10">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            class="w-6 h-6 text-emerald-400" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 id="dialog-title" class="text-lg font-semibold text-dark">
                        Ajouter un médicament
                    </h3>
                </div>

                <!-- Form -->
                <form action="{{ route('medicaments.store') }}" method="POST"
                    class="bg-white px-6 py-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @csrf

                    <!-- Nom -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-dark">
                            Nom <span class="text-dark">*</span>
                        </label>
                        <input list="noms_medicaments" name="nom" value="{{ old('nom', $medicament->nom ?? '') }}" required
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-dark focus:ring-2 focus:ring-emerald-400">

                                        <datalist id="noms_medicaments">
                                            @foreach($medicaments as $medicament)
                                                <option value="{{ $medicament->nom }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm text-dark font-medium ">Description</label>
                        <textarea name="description" rows="3"
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-dark focus:ring-2 focus:ring-emerald-400"></textarea>
                    </div>

                    <!-- Forme -->
                    <div>
                        <label class="block text-sm text-dark font-medium">
                            Forme <span class="text-dark">*</span>
                        </label>
                        <select name="id_forme" required
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-dark focus:ring-2 focus:ring-emerald-400">
                            @foreach($formes as $forme)
                                <option value="{{ $forme->id_forme }}">{{ $forme->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Dose -->
                    <div>
                        <label class="block text-sm font-medium text-dark">
                            Dose <span class="text-rose-500">*</span>
                        </label>
                        <select name="id_dose" required
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-dark focus:ring-2 focus:ring-emerald-400">
                            @foreach($doses as $dose)
                                <option value="{{ $dose->id_dose }}">
                                    {{ $dose->quantite }} {{ $dose->unite }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Footer -->
                    <div class="sm:col-span-2 flex justify-end gap-3 mt-4">
                        <button type="button" command="close" commandfor="dialog_medoc"
                            class="px-4 py-2 text-sm font-medium bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold rounded-md bg-emerald-600 text-white hover:bg-emerald-500">
                            Enregistrer
                        </button>
                    </div>
                </form>

        </div>
    </dialog>
</el-dialog>
