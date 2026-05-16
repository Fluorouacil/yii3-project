<?php
declare(strict_types=1);
namespace App\Web\Api;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ModulesHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $payload = json_encode([
            'status' => 'success',
            'items' => [
                [
                    'title' => 'Frontend',
                    'description' => 'Пользовательский интерфейс, шаблоны и стили.'
                ],
                [
                    'title' => 'Backend',
                    'description' => 'Маршрутизация, обработка запросов и API.'
                ],
                [
                    'title' => 'Database',
                    'description' => 'Хранение данных и взаимодействие с MySQL.'
                ],
                [
                    'title' => 'Visualization',
                    'description' => 'Отображение данных и клиентские сценарии.'
                ],
            ],
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}
