<?php
declare(strict_types=1);
namespace App\Web\HelloPage;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
final class Action implements RequestHandlerInterface
{
 public function __construct(
 private ResponseFactoryInterface $responseFactory,
 ) {
 }
 public function handle(ServerRequestInterface $request): ResponseInterface
 {
 $html = <<<HTML
<!doctype html>
<html lang="ru">
<head>
 <meta charset="UTF-8">
 <title>Страница Hello</title>
 <link rel="stylesheet" href="/css/site.css">
</head>
<body>
 <main class="page">
 <h1>Yii 3: пользовательский маршрут</h1>
 <p>Данная страница сформирована обработчиком HelloPage Action.</p>
 <button id="ping-btn">Проверить API</button>
 <pre id="result"></pre>
 </main>
 <script src="/js/site.js"></script>
</body>
</html>
HTML;
 $response = $this->responseFactory->createResponse(200);
 $response->getBody()->write($html);
 return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
 }
}