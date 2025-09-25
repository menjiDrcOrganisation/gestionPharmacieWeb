<!-- Modal Edit Forme -->
<dialog id="edit-forme-{{ $forme->id_forme }}"
    class="fixed inset-0 z-50 m-0 w-full max-h-full overflow-y-auto bg-transparent p-0 backdrop:bg-black/50 transition-opacity">

    <div tabindex="0"
        class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:p-6">
        <div
            class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-slate-800 text-left shadow-2xl outline outline-1 outline-slate-200 dark:outline-white/10 transition-all sm:w-full sm:max-w-lg">

            <!-- Header -->
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-200 dark:border-slate-700">
                {{-- <img src="https://cdn-icons-png.flaticon.com/512/2966/2966489.png" alt="icon" class="w-6 h-6"> --}}
                <h3 class="text-lg font-semibold text-slate-800 dark:text-white">
                    Modifier la Forme
                </h3>
            </div>

            <!-- Body -->
            <div class="px-6 py-5">
                <form action="{{ route('formes.update', $forme->id_forme) }}" method="POST"
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @csrf
                    @method('PUT')

                    <!-- Nom -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">
                            Nom <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nom" value="{{ $forme->nom }}" required
                            class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-slate-900 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-200">
                            Description
                        </label>
                        <textarea name="description" rows="3"
                            class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-slate-900 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-emerald-400 focus:outline-none">{{ $forme->description }}</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="sm:col-span-2 flex justify-end gap-3 mt-6">
                        <button type="button"
                            onclick="document.getElementById('edit-forme-{{ $forme->id_forme }}').close()"
                            class="px-4 py-2 rounded-md bg-slate-200 text-slate-800 hover:bg-slate-300 dark:bg-slate-700 dark:text-white">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 
                            rounded-lg hover:bg-emerald-500 shadow">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</dialog>
