<?php
/** @var string $title */
/** @var string $content */
/** @var array  $cssFiles */
/** @var array  $jsFiles */
?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
    </title>
    <?php foreach ($cssFiles as $cssFile): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($cssFile, ENT_QUOTES, 'UTF-8') ?>">
    <?php endforeach; ?>
</head>

<body>
    <header class="site-header">
        <div class="container">
            <h1 class="site-title">Учебный проект на Yii 3</h1>
            <nav class="site-nav">
                <a href="/">Главная</a>
                <a href="/hello">Hello</a>
                <a href="/project-page">Страница проекта</a>
                <a href="/api/ping" target="_blank" rel="noreferrer">API ping</a>
                <a href="/api/modules" target="_blank" rel="noreferrer">JSON-маршрут</a>
            </nav>
        </div>
    </header>
    <main class="container">
        <?= $content ?>
    </main>
    <?php foreach ($jsFiles as $jsFile): ?>
        <script src="<?= htmlspecialchars($jsFile, ENT_QUOTES, 'UTF-8') ?>"></script>
    <?php endforeach; ?>
</body>

</html>