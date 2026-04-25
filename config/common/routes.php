<?php

declare(strict_types=1);

use App\Web;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use App\Web\Api\EchoAction;
use App\Web\Api\PingAction;
use App\Web\HelloPage\Action as HelloPageAction;

return [
    Group::create()
        ->routes(
            Route::get('/')
                ->action(Web\HomePage\Action::class)
                ->name('home'),
        ),
    Route::get('/hello')->action(HelloPageAction::class),
    Route::get('/api/ping')->action(PingAction::class),
    Route::post('/api/echo')->action(EchoAction::class),
];
