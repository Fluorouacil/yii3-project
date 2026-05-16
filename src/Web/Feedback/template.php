<?php
/** @var App\Web\Feedback\FeedbackData $formData */
/** @var array $errors */
/** @var bool $isSuccess */
?>
<section class="feedback-page">
    <h2>Форма обратной связи</h2>
    <p>Данная форма предназначена для отработки приёма пользовательских данных,
       передачи POST-запроса и серверной проверки введённых значений.</p>

    <?php if ($isSuccess): ?>
        <div class="alert alert-success">
            Данные успешно получены и обработаны сервером.
        </div>
    <?php endif; ?>

    <?php if ($errors !== []): ?>
        <div class="alert alert-error">
            <h3>Обнаружены ошибки ввода</h3>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars((string)$error, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/feedback" method="post" class="feedback-form" novalidate>
        <div class="form-row">
            <label for="name">Имя</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars((string)$formData->name, ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-row">
            <label for="email">Электронная почта</label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars((string)$formData->email, ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="form-row">
            <label for="message">Сообщение</label>
            <textarea id="message" name="message" rows="8"><?= htmlspecialchars((string)$formData->message, ENT_QUOTES, 'UTF-8') ?></textarea>
            <div id="message-info" class="message-info"></div>
        </div>
        <div class="form-row">
            <button type="submit">Отправить</button>
        </div>
    </form>
</section>