/*
* send request to approve article
* @param {int} articleId
* @param {string} route
*/
function updateArticleStatus(articleId, route) {
    const form = document.getElementById('update-form');
    form.action = route;
    form.submit();
}

// Open rejection modal
function openRejectionModal() {
    const modal = document.getElementById('rejectionModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    // Focus on textarea after modal opens
    setTimeout(() => {
        document.getElementById('rejectionNote').focus();
    }, 100);
}

// Close rejection modal
function closeRejectionModal() {
    const modal = document.getElementById('rejectionModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Update character count
function updateCharacterCount() {
    const textarea = document.getElementById('rejectionNote');
    const characterCount = document.getElementById('characterCount');
    const confirmButton = document.getElementById('confirmReject');
    const currentLength = textarea.value.length;
    const maxLength = 500;

    characterCount.textContent = `${currentLength}/${maxLength} characters`;

    // Enable/disable confirm button based on input
    confirmButton.disabled = currentLength === 0;

    // Change color when approaching limit
    if (currentLength > maxLength * 0.8) {
        characterCount.classList.add('limit');
    } else {
        characterCount.classList.remove('limit');
    }
}
