<?php
declare(strict_types=1);
namespace App\Web\Feedback;

use App\Web\Shared\Layout\PageRenderer;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Validator\Validator;

final class FeedbackSubmitHandler implements RequestHandlerInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $input = $request->getParsedBody();
        $input = is_array($input) ? $input : [];

        $formData = new FeedbackData();
        $formData->name = trim((string) ($input['name'] ?? ''));
        $formData->email = trim((string) ($input['email'] ?? ''));
        $formData->message = trim((string) ($input['message'] ?? ''));

        $result = (new Validator())->validate($formData);
        $renderer = new PageRenderer();

        $cssFiles = ['/css/site.css', '/css/feedback.css'];
        $jsFiles = ['/js/feedback.js'];

        if (!$result->isValid()) {
            $html = $renderer->renderPage(
                __DIR__ . '/template.php',
                [
                    'formData' => $formData,
                    'errors' => $result->getErrorMessages(),
                    'isSuccess' => false,
                ],
                'Форма обратной связи',
                $cssFiles,
                $jsFiles
            );
            $response = $this->responseFactory->createResponse(422);
            $response->getBody()->write($html);
            return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
        }

        $record = json_encode([
            'name' => $formData->name,
            'email' => $formData->email,
            'message' => $formData->message,
            'created_at' => date('Y-m-d H:i:s'),
        ], JSON_UNESCAPED_UNICODE) . PHP_EOL;

        file_put_contents(__DIR__ . '/../../../runtime/feedback.log', $record, FILE_APPEND);

        $html = $renderer->renderPage(
            __DIR__ . '/template.php',
            [
                'formData' => new FeedbackData(),
                'errors' => [],
                'isSuccess' => true,
            ],
            'Форма обратной связи',
            $cssFiles,
            $jsFiles
        );
        $response = $this->responseFactory->createResponse(200);
        $response->getBody()->write($html);
        return $response->withHeader('Content-Type', 'text/html; charset=utf-8');
    }
}