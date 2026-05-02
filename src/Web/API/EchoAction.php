<?php
declare(strict_types=1);
namespace App\Web\Api;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
final class EchoAction implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
    ) {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $rawBody = (string) $request->getBody();
        $data = json_decode($rawBody, true);
        if (!is_array($data)) {
            $data = [
                'raw' => $rawBody,
            ];
        }
        $payload = json_encode([
            'status' => 'success',
            'received' => $data,
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    }
}