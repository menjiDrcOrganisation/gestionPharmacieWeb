<!-- Modal Ajout -->
<div class="modal fade" id="addPharmacieModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form onsubmit="addPharmacie(event)">
        <div class="modal-header">
          <h5 class="modal-title">➕ Nouvelle Pharmacie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Adresse</label>
                <input type="text" name="adresse" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Indice</label>
                <input type="number" name="indice" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Gérant</label>
                <select name="id_gerant" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    @foreach($gerants as $gerant)
                        <option value="{{ $gerant->id_gerant }}">{{ $gerant->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-select" required>
                    <option value="en_attente">En attente</option>
                    <option value="valide">Validée</option>
                    <option value="ferme">Fermée</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edition -->
<div class="modal fade" id="editPharmacieModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editPharmacieForm">
        <div class="modal-header">
          <h5 class="modal-title">✏️ Modifier Pharmacie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            @csrf
            <input type="hidden" id="edit_pharmacie_id">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" id="edit_nom" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gérant</label>
                <select id="edit_gerant" name="id_gerant" class="form-select" required>
                    @foreach($gerants as $gerant)
                        <option value="{{ $gerant->id_gerant }}">{{ $gerant->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select id="edit_statut" name="statut" class="form-select" required>
                    <option value="en_attente">En attente</option>
                    <option value="valide">Validée</option>
                    <option value="ferme">Fermée</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Mettre à jour</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>
