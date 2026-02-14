<el-dialog>
    <dialog id="dialog_forme" aria-labelledby="dialog-title-forme"
        class="fixed inset-0 m-0 w-full max-h-full overflow-y-auto bg-transparent p-0 backdrop:bg-black/50">

        <div tabindex="0" class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:p-6">
            <el-dialog-panel
                class="relative transform overflow-hidden rounded-lg bg-slate-800 text-left shadow-xl outline outline-1 outline-white/10 transition-all sm:w-full sm:max-w-lg">

                <!-- Header -->
                <div class="px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-500/20 sm:mx-0">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                class="h-6 w-6 text-blue-400">
                                <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 id="dialog-title-forme" class="text-base font-semibold text-white">Ajouter une Forme
                            </h3>
                            <div class="mt-2">
                                <form action="{{ route('formes.store') }}" method="POST"
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    @csrf

                                    <!-- Nom -->
                                    <div class="sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-200">Nom <span
                                                class="text-rose-500">*</span></label>
                                        <input type="text" name="nom" required
                                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400">
                                    </div>

                                    <!-- Description -->
                                    <div class="sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-200">Description</label>
                                        <textarea name="description" rows="3"
                                            class="mt-1 block w-full rounded-md border border-slate-600 py-2 px-3 focus:ring-2 focus:ring-emerald-400"></textarea>
                                    </div>

                                    <!-- Actions -->
                                    <div class="sm:col-span-2 flex justify-end gap-2 mt-4">
                                        <button type="submit"
                                            class="rounded-md bg-blue-500 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-400">Ajouter</button>
                                        <button type="button" command="close" commandfor="dialog_forme"
                                            class="rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white hover:bg-white/20">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>
