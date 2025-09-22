<el-dialog>
    <dialog id="dialog" aria-labelledby="dialog-title"
        class="fixed inset-0 m-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent p-0 backdrop:bg-transparent">

        <!-- Backdrop -->
        <el-dialog-backdrop
            class="fixed inset-0 bg-gray-900/50 transition-opacity data-[closed]:opacity-0 data-[enter]:duration-300 data-[leave]:duration-200 data-[enter]:ease-out data-[leave]:ease-in">
        </el-dialog-backdrop>

        <!-- Panel -->
        <div tabindex="0"
            class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <el-dialog-panel
                class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg data-[closed]:translate-y-4 data-[closed]:opacity-0 sm:data-[closed]:translate-y-0 sm:data-[closed]:scale-95">

                <!-- Header -->
                <div class="bg-gray-800 px-6 py-4 border-b border-gray-700 flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-500/10">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            class="w-6 h-6 text-emerald-400" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 id="dialog-title" class="text-lg font-semibold text-white">
                        Ajouter une pharmacie
                    </h3>
                </div>

                <!-- Form -->
                <form action="{{ route('pharmacies.store') }}" method="POST"
                    class="bg-gray-800 px-6 py-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @csrf

                    <!-- Nom -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-200">
                            Nom <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="nom" required
                            class="mt-1 block w-full rounded-md border border-slate-600 bg-gray-700 py-2 px-3 text-white focus:ring-2 focus:ring-emerald-400">
                    </div>

                    <!-- Adresse -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-200">
                            Adresse <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="adresse" required
                            class="mt-1 block w-full rounded-md border border-slate-600 bg-gray-700 py-2 px-3 text-white focus:ring-2 focus:ring-emerald-400">
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-sm font-medium text-slate-200">
                            Téléphone <span class="text-rose-500">*</span>
                        </label>
                        <input type="tel" name="telephone" required
                            class="mt-1 block w-full rounded-md border border-slate-600 bg-gray-700 py-2 px-3 text-white focus:ring-2 focus:ring-emerald-400">
                    </div>

                    <!-- Indice -->
                    <div>
                        <label class="block text-sm font-medium text-slate-200">Indice</label>
                        <input type="text" name="indice"
                            class="mt-1 block w-full rounded-md border border-slate-600 bg-gray-700 py-2 px-3 text-white focus:ring-2 focus:ring-emerald-400">
                    </div>

                    <!-- Gérant -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-200">Gérant</label>
                        <select name="id_gerant"
                            class="mt-1 block w-full rounded-md border border-slate-600 bg-gray-700 py-2 px-3 text-white focus:ring-2 focus:ring-emerald-400">
                            @foreach ($gerants as $gerant)
                                <option value="{{ $gerant->id_gerant }}">
                                    {{ $gerant->user->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Footer -->
                    <div class="sm:col-span-2 flex justify-end gap-3 mt-4">
                        <button type="button" command="close" commandfor="dialog"
                            class="px-4 py-2 text-sm font-semibold rounded-md bg-white/10 text-white hover:bg-white/20">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold rounded-md bg-emerald-600 text-white hover:bg-emerald-500">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>
