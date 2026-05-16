<?php
/** @var int $id */
/** @var App\Domain\ProjectModule\ProjectModuleData $formData */
/** @var array $errors */
/** @var bool $isSuccess */
?>
<section class="module-page">
    <h2>Редактирование модуля проекта</h2>
    <p>
        На данной странице выполняется изменение существующей записи таблицы
        <code>project_module</code>.
    </p>
    <?php if ($isSuccess): ?>
        <div class="alert alert-success">
            Изменения успешно сохранены.
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
    <form action="/project-modules/update" method="post" class="module-form" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') ?>">
        <div class="form-row">
            <label for="title">Название</label>
            <input type="text" id="title" name="title"
                value="<?= htmlspecialchars((string) $formData->title, ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-row">
            <label for="description">Описание</label>
            <textarea id="description" name="description"
                rows="5"><?= htmlspecialchars((string) $formData->description, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <div class="form-row">
            <label for="status">Статус</label>
            <select id="status" name="status">
                <option value="new" <?= $formData->status === 'new' ? 'selected' : '' ?>>new</option>
                <option value="active" <?= $formData->status === 'active' ? 'selected' : '' ?>>active</option>
                <option value="done" <?= $formData->status === 'done' ? 'selected' : '' ?>>done</option>
            </select>
        </div>
        <div class="form-row">
            <label for="sort">Порядок</label>
            <input type="number" id="sort" name="sort"
                value="<?= htmlspecialchars((string) $formData->sort, ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-row actions-row">
            <button type="submit">Сохранить изменения</button>
            <a class="back-link" href="/project-modules">Вернуться к списку</a>
        </div>
    </form>
</section>