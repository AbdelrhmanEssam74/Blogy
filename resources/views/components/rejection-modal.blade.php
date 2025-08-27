<!-- Rejection Modal -->
<div class="modal-overlay" id="rejectionModal">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle"></h3>
            <button class="modal-close" onclick="closeRejectionModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <p class="modal-message" id="modalMessage">

            </p>

            <div class="form-group">
                <label for="rejectionNote" class="form-label">Rejection Reason</label>
                <textarea
                    id="rejectionNote"
                    class="form-textarea"
                    placeholder=""
                    maxlength="500"
                    oninput="updateCharacterCount()"
                ></textarea>
                <div class="character-count" id="characterCount">0/500 characters</div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeRejectionModal()">
                Cancel
            </button>
            <button class="btn btn-danger" id="confirmReject"  disabled>
                <i class="fas fa-times"></i>
                Confirm Rejection
            </button>
        </div>
    </div>
</div>

