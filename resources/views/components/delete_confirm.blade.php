@props(['articleId', 'articleTitle'])

<!-- Modal -->
<div id="deleteModal-{{ $articleId }}" class="modal-overlay">
    <div class="modal-box">
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete the article <strong>"{{ $articleTitle }}"</strong>?</p>
        <div class="modal-actions">
            <button class="cancel-btn" onclick="closeDeleteModal('{{ $articleId }}')">Cancel</button>
            <form action="{{ route('writer.article-delete', $articleId) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="confirm-btn">Yes, Delete</button>
            </form>
        </div>
    </div>
</div>
<style>
    /* Overlay */
    .modal-overlay {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    /* Box */
    .modal-box {
        background: #fff;
        padding: 1.5rem;
        border-radius: .75rem;
        max-width: 400px;
        width: 100%;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        animation: fadeIn .3s ease;
    }

    .modal-box h2 {
        margin-bottom: .5rem;
        font-size: 1.25rem;
    }

    .modal-box p {
        color: #444;
        margin-bottom: 1rem;
    }

    /* Buttons */
    .modal-actions {
        display: flex;
        justify-content: center;
        gap: .75rem;
    }

    .delete-btn {
        padding: .5rem 1rem;
        background: #e3342f;
        color: #fff;
        border: none;
        border-radius: .5rem;
        cursor: pointer;
        transition: background .2s;
    }
    .delete-btn:hover { background: #cc1f1a; }

    .cancel-btn {
        padding: .5rem 1rem;
        background: #6b7280;
        color: #fff;
        border: none;
        border-radius: .5rem;
        cursor: pointer;
    }
    .cancel-btn:hover { background: #4b5563; }

    .confirm-btn {
        padding: .5rem 1rem;
        background: #dc2626;
        color: #fff;
        border: none;
        border-radius: .5rem;
        cursor: pointer;
    }
    .confirm-btn:hover { background: #b91c1c; }

    /* Animation */
    @keyframes fadeIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

</style>
<script>
    function openDeleteModal(id) {
        document.getElementById('deleteModal-' + id).style.display = 'flex';
    }

    function closeDeleteModal(id) {
        document.getElementById('deleteModal-' + id).style.display = 'none';
    }

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) {
            e.target.style.display = 'none';
        }
    });
</script>
