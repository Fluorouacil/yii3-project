<?php
declare(strict_types=1);
namespace App\Web\Shared\Layout;

final class PageRenderer
{
    public function render(string $templateFile, array $params = []): string
    {
        extract($params, EXTR_SKIP);
        ob_start();
        require $templateFile;
        return (string) ob_get_clean();
    }

    public function renderPage(
        string $templateFile,
        array $params = [],
        string $title = '',
        array $cssFiles = [],
        array $jsFiles = []
    ): string {
        $content = $this->render($templateFile, $params);
        return $this->render(__DIR__ . '/layout.php', [
            'title' => $title,
            'content' => $content,
            'cssFiles' => $cssFiles,
            'jsFiles' => $jsFiles,
        ]);
    }
}
