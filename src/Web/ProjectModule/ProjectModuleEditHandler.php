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

final class ProjectModuleEditHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private ProjectModuleRepository $repository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int) ($request->getQueryParams()['id'] ?? 0);
        $record = $this->repository->getById($id);

        if ($record === null) {
            $response = $this->responseFactory->createResponse(404);
            $response->getBody()->write('Запись не найдена.');
            return $response->withHeader('Content-Type', 'text/plain; charset=utf-8');
        }

        $formData = new ProjectModuleData();
        $formData->title = (string) $record['title'];
        $formData->description = (string) $record['description'];
        $formData->status = (string) $record['status'];
        $formData->sort = (string) $record['sort'];

        $renderer = new PageRenderer();
        $html = $renderer->renderPage(
            __DIR__ . '/edit-template.php',
            ['id' => $id, 'formData' => $formData, 'errors' => [], 'isSuccess' => false],
            'Редактирование модуля проекта',
            ['/css/site.css', '/css/project-module.css'],
            ['/js/project-module.js'],
        );

        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
    }
}