document.addEventListener('DOMContentLoaded', () => {
    const titleField = document.getElementById('title');
    const descriptionField = document.getElementById('description');
    if (!titleField || !descriptionField) {
        return;
    }
    titleField.addEventListener('input', () => {
        if (titleField.value.trim().length >= 2) {
            titleField.style.borderColor = '#7fb47f';
        } else {
            titleField.style.borderColor = '#bcc8df';
        }
    });
    descriptionField.addEventListener('input', () => {
        if (descriptionField.value.length > 1000) {
            descriptionField.style.borderColor = '#d06a6a';
        } else {
            descriptionField.style.borderColor = '#bcc8df';
        }
    });
});