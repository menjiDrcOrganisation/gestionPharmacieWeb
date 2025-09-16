<el-dialog>
    <dialog id="dialog_medoc" aria-labelledby="dialog-title"
        class="fixed inset-0 m-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent p-0 backdrop:bg-transparent">
        <el-dialog-backdrop
            class="fixed inset-0 bg-gray-900/50 transition-opacity data-[closed]:opacity-0 data-[enter]:duration-300 data-[leave]:duration-200 data-[enter]:ease-out data-[leave]:ease-in"></el-dialog-backdrop>

        <div tabindex="0"
            class="flex min-h-full items-end justify-center p-4 text-center focus:outline focus:outline-0 sm:items-center sm:p-0">
            <el-dialog-panel
                class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline outline-1 -outline-offset-1 outline-white/10 transition-all data-[closed]:translate-y-4 data-[closed]:opacity-0 data-[enter]:duration-300 data-[leave]:duration-200 data-[enter]:ease-out data-[leave]:ease-in sm:my-8 sm:w-full sm:max-w-lg data-[closed]:sm:translate-y-0 data-[closed]:sm:scale-95">
                <div class="bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-500/10 sm:mx-0 sm:size-10">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                data-slot="icon" aria-hidden="true" class="size-6 text-red-400">
                                <path
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 id="dialog-title" class="text-base font-semibold text-white">Deactivate
                                account</h3>
                            <div class="mt-2">
                                <form action="{{ route('medicaments.store') }}" method="POST"
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    @csrf

                                    <!-- Nom -->
                                    <div class="sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-200">Nom <span class="text-rose-500">*</span></label>
                                        <input list="noms_medicaments" name="nom" value="{{ old('nom', $medicament->nom ?? '') }}" required
                                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">

                                        <datalist id="noms_medicaments">
                                            @foreach($medicaments as $medicament)
                                                <option value="{{ $medicament->nom }}"></option>
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <!-- Description -->
                                    <div class="sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-200">Description</label>
                                        <textarea name="description" rows="3"
                                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400"></textarea>
                                    </div>

                                    <!-- Forme -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-200">Forme <span
                                                class="text-rose-500">*</span></label>
                                        <select name="id_forme" required
                                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                                            @foreach($formes as $forme)
                                                <option value="{{ $forme->id_forme }}">{{ $forme->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Dose -->
                                    <div>
                                        <label class="block text-sm font-medium text-slate-200">Dose <span
                                                class="text-rose-500">*</span></label>
                                        <select name="id_dose" required
                                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                                            @foreach($doses as $dose)
                                                <option value="{{ $dose->id_dose }}">{{ $dose->quantite }}
                                                    {{ $dose->unite }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Bouton Submit -->
                                    <div class="sm:col-span-2">
                                        <button type="submit"
                                            class="w-full py-2 px-4 bg-emerald-600 text-white rounded-md hover:bg-emerald-500">Ajouter</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <input type="submit" command="submit" commandfor="dialog_medoc" value="Enregistre"
                        class="inline-flex w-full justify-center rounded-md bg-green-400-500 px-3 py-2 text-sm font-semibold text-white hover:bg-green-400 sm:ml-3 sm:w-auto">
                    <button type="button" command="close" commandfor="dialog_medoc"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white ring-1 ring-inset ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">Cancel</button>
                </div>
                </form>

        </div>
    </dialog>
</el-dialog>