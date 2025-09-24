<el-dialog>
    <dialog id="dialog_forme" aria-labelledby="dialog-title-forme"
        class="fixed inset-0 z-50 m-0 w-full max-h-full overflow-y-auto bg-transparent p-0 backdrop:bg-black/50 transition-opacity">

        <div tabindex="0"
            class="flex min-h-full items-center justify-center p-4 text-center focus:outline-none sm:p-6">
            <el-dialog-panel
            class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg data-[closed]:translate-y-4 data-[closed]:opacity-0 sm:data-[closed]:sm:translate-y-0 sm:data-[closed]:scale-95">

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
                        Ajouter une forme
                    </h3>
                </div>

                <!-- Body -->
                <div class="px-6 py-5">
                    <form action="{{ route('formes.store') }}" method="POST"
                        class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @csrf

                        <!-- Nom -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-200">
                                Nom <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="nom" required
                                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-slate-900 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-emerald-400 focus:outline-none">
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-200">
                                Description
                            </label>
                            <textarea name="description" rows="3"
                                class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-slate-900 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-emerald-400 focus:outline-none"></textarea>
                        </div>

                        <!-- Actions -->
                        <div class="sm:col-span-2 flex justify-end gap-3 mt-6">
                            <button type="button" command="close" commandfor="dialog_forme"
                            class="px-4 py-2 text-sm font-semibold rounded-md bg-white/10 text-white hover:bg-white/20">
                                Annuler
                            </button>
                            <button type="submit"
                            class="px-4 py-2 text-sm font-semibold rounded-md bg-emerald-600 text-white hover:bg-emerald-500">
                             Ajouter
                            </button>
                        </div>
                    </form>
                </div>

            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>
