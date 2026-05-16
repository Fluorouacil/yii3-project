<?php
/** @var array $modules */
/** @var App\Domain\ProjectModule\ProjectModuleData $formData */
/** @var array $errors */
/** @var bool $isSuccess */
/** @var bool|null $deleteSuccess */
$deleteSuccess = $deleteSuccess ?? false;
?>
<section class="module-page">
    <h2>Модули проекта</h2>
    <p>
        На данной странице объединены операции добавления, просмотра и удаления
        записей таблицы <code>project_module</code>.
    </p>
    <?php if ($isSuccess): ?>
        <div class="alert alert-success">
            Запись успешно добавлена в базу данных.
        </div>
    <?php endif; ?>
    <?php if ($deleteSuccess): ?>
        <div class="alert alert-success">
            Запись успешно удалена.
        </div>
    <?php endif; ?>
    <?php if ($errors !== []): ?>
        <div class="alert alert-error">
            <h3>Обнаружены ошибки ввода</h3>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <section class="module-form-section">
        <h3>Добавление модуля</h3>
        <form action="/project-modules" method="post" class="module-form" novalidate>
            <div class="form-row">
                <label for="title">Название</label>
                <input type="text" id="title" name="title"
                    value="<?= htmlspecialchars((string) $formData->title, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="form-row">
                <label for="description">Описание</label>
                <textarea id="description" name="description" rows="5"><?= htmlspecialchars((string) $formData->description, ENT_QUOTES, 'UTF-8')
                    ?></textarea>
            </div>
            <div class="form-row">
                <label for="status">Статус</label>
                <select id="status" name="status">
                    <option value="new" <?= $formData->status === 'new' ? 'selected' : '' ?>>new</option>
                    <option value="active" <?= $formData->status === 'active' ? 'selected' : ''
                        ?>>active</option>
                    <option value="done" <?= $formData->status === 'done' ? 'selected' : '' ?>>done</option>
                </select>
            </div>
            <div class="form-row">
                <label for="sort">Порядок</label>
                <input type="number" id="sort" name="sort"
                    value="<?= htmlspecialchars((string) $formData->sort, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="form-row">
                <button type="submit">Добавить запись</button>
            </div>
        </form>
    </section>
    <section class="module-list-section">
        <h3>Список модулей</h3>
        <?php if ($modules === []): ?>
            <p class="empty-state">В таблице project_module пока отсутствуют записи.</p>
        <?php else: ?>
            <table class="module-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Порядок</th>
                        <th>Создано</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars((string) $module['id'], ENT_QUOTES, 'UTF-8') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars((string) $module['title'], ENT_QUOTES, 'UTF-8') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars((string) $module['description'], ENT_QUOTES, 'UTF-8')
                                    ?>
                            </td>
                            <td>
                                <?= htmlspecialchars((string) $module['status'], ENT_QUOTES, 'UTF-8') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars((string) $module['sort'], ENT_QUOTES, 'UTF-8') ?>
                            </td>
                            <td>
                                <?= htmlspecialchars((string) $module['created_at'], ENT_QUOTES, 'UTF-8')
                                    ?>
                            </td>
                            <td class="actions-cell">
                                <a class="edit-link" href="/project-modules/edit?id=<?=
                                    urlencode((string) $module['id']) ?>">
                                    Редактировать
                                </a>
                                <form action="/project-modules/delete" method="post" class="delete-form">
                                    <input type="hidden" name="id" value="<?=
                                        htmlspecialchars((string) $module['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" class="delete-button">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</section>