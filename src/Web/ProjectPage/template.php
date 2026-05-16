<?php
/** @var string $pageTitle */
/** @var string $pageDescription */
?>
<section class="hero">
    <h2>
        <?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>
    </h2>
    <p>
        <?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>
    </p>
</section>
<section class="modules-section">
    <h3>Модули проекта</h3>
    <p>Список модулей загружается с сервера клиентским JavaScript.</p>
    <div id="module-list" class="module-list"></div>
</section>