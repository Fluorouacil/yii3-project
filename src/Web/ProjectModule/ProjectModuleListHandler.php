<?php
declare(strict_types=1);

namespace App\Web\ProjectModule;

use App\Domain\ProjectModule\ProjectModuleData;
use App\Domain\ProjectModule\ProjectModuleRepository;
use App\Web\Shared\Layout\PageRenderer;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ProjectModuleListHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private ProjectModuleRepository $repository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $renderer = new PageRenderer();
        $html = $renderer->renderPage(
            __DIR__ . '/template.php',
            [
                'modules' => $this->repository->getAll(),
                'formData' => new ProjectModuleData(),
                'errors' => [],
                'isSuccess' => false,
            ],
            'Модули проекта',
            ['/css/site.css', '/css/project-module.css'],
            ['/js/project-module.js'],
        );

        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
    }
}