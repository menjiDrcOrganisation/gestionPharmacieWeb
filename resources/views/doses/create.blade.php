<!-- Modal Create -->
<div id="modal_medoc" aria-labelledby="dialog-title" class="fixed inset-0 flex items-center justify-center bg-black/40 backdrop-blur-sm hidden z-50">

    <!-- Panel -->
    <div tabindex="0"
        class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 w-full">
        <el-dialog-panel
            class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

            <!-- Header -->
            <div class="bg-white px-6 py-4 border-b border-gray-200 flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        class="w-6 h-6 text-emerald-600" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 id="dialog-title" class="text-lg font-semibold text-gray-800">
                    Ajouter une dose
                </h3>
            </div>

            <!-- Form -->
            <form action="{{ route('doses.store') }}" method="POST"
                class="bg-white px-6 py-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                @csrf

                <!-- Quantité -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-800">
                        Quantité <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" name="quantite" required
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-800 focus:ring-2 focus:ring-emerald-400">
                </div>

                @php
                    $formes = ['mg','ml','g'];
                @endphp

                <!-- Unité -->
                <div>
                    <label class="block text-sm font-medium text-gray-800">
                        Unité <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="unite" required
                        class="mt-1 block w-full rounded-lg border border-slate-300 dark:border-slate-600 py-2 px-3 text-sm focus:ring-2 focus:ring-emerald-400 focus:outline-none dark:bg-slate-700 dark:text-white">
                    {{-- <select name="unite" required
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-gray-800 focus:ring-2 focus:ring-emerald-400">
                        <option value="">Sélectionnez une unité</option>
                        @foreach($formes as $forme)
                            <option value="{{ $forme }}">{{ $forme }}</option>
                        @endforeach
                    </select> --}}
                </div>

                <!-- Footer -->
                <div class="sm:col-span-2 flex justify-end gap-3 mt-4">
                    <button type="button" 
                            onclick="document.getElementById('modal_medoc').classList.add('hidden')"  
                            class="px-4 py-2 text-sm font-semibold rounded-md bg-gray-100 text-gray-800 hover:bg-gray-200 transition">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-semibold rounded-md bg-emerald-600 text-white hover:bg-emerald-500 transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </el-dialog-panel>
    </div>
</div>
