/*
* send request to approve article
* @param {int} articleId
* @param {string} route
*/
function updateArticleStatus(articleId, route , note = null) {
    const form = document.getElementById('update-form');
    form.action = route;
    let noteInput = document.createElement('input')
    noteInput.setAttribute('name', 'note')
    noteInput.setAttribute('value', note)
    form.appendChild(noteInput)
    console.log(note)
    form.submit();
}

// Open rejection modal
function openRejectionModal(rejectWhat, rejectTitle, articleId, route) {
    const modal = document.getElementById('rejectionModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    document.getElementById('modalTitle').textContent = `Reject ${rejectWhat}`;
    const modalMessage = document.getElementById('modalMessage');
    modalMessage.textContent = `You are about to reject a ${rejectWhat} by `;
    const strong = document.createElement('strong');
    strong.textContent = rejectTitle;
    modalMessage.appendChild(strong);
    modalMessage.append('. Please provide a reason for rejection.');
    const rejectionNote = document.getElementById('rejectionNote');
    rejectionNote.setAttribute('placeholder', `Please explain why this ${rejectWhat} is being rejected...`);
    const confirmReject = document.getElementById('confirmReject');
    confirmReject.onclick = () => updateArticleStatus(articleId, route , rejectionNote.value);
    setTimeout(() => rejectionNote.focus(), 100);
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
