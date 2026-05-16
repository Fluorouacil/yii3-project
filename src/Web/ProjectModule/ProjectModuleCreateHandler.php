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
use Yiisoft\Validator\Validator;

final class ProjectModuleCreateHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private ProjectModuleRepository $repository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $input = $request->getParsedBody();
        $input = is_array($input) ? $input : [];

        $formData = new ProjectModuleData();
        $formData->title = trim((string) ($input['title'] ?? ''));
        $formData->description = trim((string) ($input['description'] ?? ''));
        $formData->status = trim((string) ($input['status'] ?? 'new'));
        $formData->sort = (string) ($input['sort'] ?? '0');

        $validator = new Validator();
        $result = $validator->validate($formData);
        $renderer = new PageRenderer();

        $cssFiles = ['/css/site.css', '/css/project-module.css'];
        $jsFiles = ['/js/project-module.js'];

        if (!$result->isValid()) {
            $html = $renderer->renderPage(
                __DIR__ . '/template.php',
                [
                    'modules' => $this->repository->getAll(),
                    'formData' => $formData,
                    'errors' => $result->getErrorMessages(),
                    'isSuccess' => false,
                ],
                'Модули проекта',
                $cssFiles,
                $jsFiles,
            );
            $response = $this->responseFactory->createResponse(422);
            $response->getBody()->write($html);
            return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
        }

        $this->repository->insert($formData);

        $html = $renderer->renderPage(
            __DIR__ . '/template.php',
            [
                'modules' => $this->repository->getAll(),
                'formData' => new ProjectModuleData(),
                'errors' => [],
                'isSuccess' => true,
            ],
            'Модули проекта',
            $cssFiles,
            $jsFiles,
        );

        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
    }
}