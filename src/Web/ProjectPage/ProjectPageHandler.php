<?php
declare(strict_types=1);
namespace App\Web\ProjectPage;

use App\Web\Shared\Layout\PageRenderer;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ProjectPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $renderer = new PageRenderer();
        $html = $renderer->renderPage(
            __DIR__ . '/template.php',
            [
                'pageTitle' => 'Структура интерфейса проекта',
                'pageDescription' => 'Страница построена с использованием общего layout,
                    отдельного шаблона и подключаемых клиентских ресурсов.',
            ],
            'Страница проекта',
            ['/css/site.css', '/css/project-page.css'],
            ['/js/project-page.js'],
        );

        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
    }
}
