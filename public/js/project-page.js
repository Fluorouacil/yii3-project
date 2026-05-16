document.addEventListener('DOMContentLoaded', async () => {
    const container = document.getElementById('module-list');
    if (!container) return;

    try {
        const response = await fetch('/api/modules');
        const data = await response.json();

        if (!data.items || !Array.isArray(data.items)) {
            container.textContent = 'Данные не получены';
            return;
        }

        const fragment = document.createDocumentFragment();
        data.items.forEach((item) => {
            const card = document.createElement('article');
            card.className = 'module-card';

            const title = document.createElement('h4');
            title.textContent = item.title;

            const desc = document.createElement('p');
            desc.textContent = item.description;

            card.appendChild(title);
            card.appendChild(desc);
            fragment.appendChild(card);
        });
        container.appendChild(fragment);

    } catch (error) {
        container.textContent = 'Ошибка загрузки данных с сервера';
    }
});
