<!-- Modal Médicament -->
<dialog id="dialog_medoc" class="fixed inset-0 w-full max-h-full overflow-y-auto bg-transparent p-0 backdrop:bg-black/50">
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
        <el-dialog-panel
            class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl sm:w-full sm:max-w-lg">
            <!-- Header -->
            <div class="px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-semibold text-white mb-4">Ajouter un Médicament</h3>

                <!-- Formulaire Médicament -->
                <form id="form-medoc" action="{{ route('medicaments.store') }}" method="POST"
                    class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @csrf

                    <!-- Nom -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-slate-200">Nom <span
                                class="text-rose-500">*</span></label>
                        <input list="noms_medicaments" name="nom" required
                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                        <datalist id="noms_medicaments">
                            @foreach ($medicaments as $medicament)
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
                    <div class="flex items-center gap-2 sm:col-span-2">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-slate-200">Forme <span
                                    class="text-rose-500">*</span></label>
                            <select name="id_forme" required
                                class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                                @foreach ($formes as $forme)
                                    <option value="{{ $forme->id_forme }}">{{ $forme->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" onclick="document.getElementById('dialog-create-forme').showModal()"
                            class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">+ Forme</button>
                    </div>

                    <!-- Dose -->
                    <div class="flex items-center gap-2 sm:col-span-2">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-slate-200">Dose <span
                                    class="text-rose-500">*</span></label>
                            <select name="id_dose" required
                                class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                                @foreach ($doses as $dose)
                                    <option value="{{ $dose->id_dose }}">{{ $dose->quantite }} {{ $dose->unite }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" onclick="document.getElementById('dialog-create-dose').showModal()"
                            class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">+ Dose</button>
                    </div>

                    <!-- Submit -->
                    <div class="sm:col-span-2">
                        <button type="submit"
                            class="w-full py-2 px-4 bg-emerald-600 text-white rounded-md hover:bg-emerald-500">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" onclick="document.getElementById('dialog_medoc').close()"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white hover:bg-white/20 sm:mt-0 sm:w-auto">
                    Annuler
                </button>
            </div>
        </el-dialog-panel>
    </div>
</dialog>

<!-- Modal Forme -->
<dialog id="dialog-create-forme"
    class="fixed inset-0 w-full max-h-full overflow-y-auto bg-transparent p-0 backdrop:bg-black/50">
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
        <el-dialog-panel
            class="relative transform overflow-hidden rounded-lg bg-slate-800 text-left shadow-xl sm:w-full sm:max-w-lg">
            <h3 class="text-base font-semibold text-white mb-4">Ajouter une Forme</h3>
            <form id="form-forme" action="{{ route('medicaments.formes.store') }}" method="POST"
                class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @csrf
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-200">Nom <span
                            class="text-rose-500">*</span></label>
                    <input type="text" name="nom" required
                        class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-200">Description</label>
                    <textarea name="description" rows="3"
                        class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400"></textarea>
                </div>
                <div class="sm:col-span-2 flex justify-end gap-2 mt-4">
                    <button type="submit"
                        class="rounded-md bg-blue-500 px-3 py-2 text-white hover:bg-blue-400">Ajouter</button>
                    <button type="button" onclick="document.getElementById('dialog-create-forme').close()"
                        class="rounded-md bg-white/10 px-3 py-2 text-white hover:bg-white/20">Annuler</button>
                </div>
            </form>
        </el-dialog-panel>
    </div>
</dialog>

<!-- Modal Dose -->
<dialog id="dialog-create-dose"
    class="fixed inset-0 w-full max-h-full overflow-y-auto bg-transparent p-0 backdrop:bg-black/50">
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-6">
        <el-dialog-panel
            class="relative transform overflow-hidden rounded-lg bg-slate-800 text-left shadow-xl sm:w-full sm:max-w-lg">
            <h3 class="text-base font-semibold text-white mb-4">Ajouter une Dose</h3>
            <form id="form-dose" action="{{ route('medicaments.doses.store') }}" method="POST"
                class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @csrf
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-200">Quantité <span
                            class="text-rose-500">*</span></label>
                    <input type="number" name="quantite" required
                        class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-slate-200">Unité <span
                            class="text-rose-500">*</span></label>
                    <select name="unite" required
                        class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                        <option value="">Sélectionnez une unité</option>
                        <option value="mg">mg</option>
                        <option value="g">g</option>
                        <option value="ml">ml</option>
                        <option value="unités">unités</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex justify-end gap-2 mt-4">
                    <button type="submit"
                        class="rounded-md bg-blue-500 px-3 py-2 text-white hover:bg-blue-400">Ajouter</button>
                    <button type="button" onclick="document.getElementById('dialog-create-dose').close()"
                        class="rounded-md bg-white/10 px-3 py-2 text-white hover:bg-white/20">Annuler</button>
                </div>
            </form>
        </el-dialog-panel>
    </div>
</dialog>

<!-- Scripts AJAX -->
<script>
    document.getElementById("form-forme").addEventListener("submit", async function(e) {
        e.preventDefault();
        let form = e.target;
        let data = new FormData(form);
        let response = await fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: data
        });
        if (response.ok) {
            let newForme = await response.json();
            let select = document.querySelector("select[name='id_forme']");
            let option = document.createElement("option");
            option.value = newForme.id_forme;
            option.textContent = newForme.nom;
            option.selected = true;
            select.appendChild(option);
            form.reset();
            document.getElementById('dialog-create-forme').close();
        } else alert("Erreur lors de l'ajout de la forme");
    });

    document.getElementById("form-dose").addEventListener("submit", async function(e) {
        e.preventDefault();
        let form = e.target;
        let data = new FormData(form);
        let response = await fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: data
        });
        if (response.ok) {
            let newDose = await response.json();
            let select = document.querySelector("select[name='id_dose']");
            let option = document.createElement("option");
            option.value = newDose.id_dose;
            option.textContent = `${newDose.quantite} ${newDose.unite}`;
            option.selected = true;
            select.appendChild(option);
            form.reset();
            document.getElementById('dialog-create-dose').close();
        } else alert("Erreur lors de l'ajout de la dose");
    });
</script>
