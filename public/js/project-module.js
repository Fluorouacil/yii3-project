document.addEventListener('DOMContentLoaded', () => {
    const titleField = document.getElementById('title');
    const descriptionField = document.getElementById('description');
    if (titleField) {
        titleField.addEventListener('input', () => {
            if (titleField.value.trim().length >= 2) {
                titleField.style.borderColor = '#7fb47f';
            } else {
                titleField.style.borderColor = '#bcc8df';
            }
        });
    }
    if (descriptionField) {
        descriptionField.addEventListener('input', () => {
            if (descriptionField.value.length > 1000) {
                descriptionField.style.borderColor = '#d06a6a';
            } else {
                descriptionField.style.borderColor = '#bcc8df';
            }
        });
    }
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach((form) => {
        form.addEventListener('submit', (event) => {
            const confirmed = window.confirm('Выполнить удаление выбранной записи?');
            if (!confirmed) {
                event.preventDefault();
            }
        });
    });
});