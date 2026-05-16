document.addEventListener('DOMContentLoaded', () => {
    const messageField = document.getElementById('message');
    const infoField = document.getElementById('message-info');

    if (!messageField || !infoField) return;

    const renderInfo = () => {
        infoField.textContent = `Количество символов: ${messageField.value.length}`;
    };

    renderInfo();
    messageField.addEventListener('input', renderInfo);
});