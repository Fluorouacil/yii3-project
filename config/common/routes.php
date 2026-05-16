<?php
declare(strict_types=1);
use App\Web\Api\EchoAction;
use App\Web\Api\PingAction;
use App\Web\HelloPage\Action as HelloPageAction;
use App\Web\HomePage\Action as HomePageAction;
use App\Web\Api\ModulesHandler;
use App\Web\ProjectPage\ProjectPageHandler;
use App\Web\Feedback\FeedbackPageHandler;
use App\Web\Feedback\FeedbackSubmitHandler;
use App\Web\ProjectModule\ProjectModuleCreateHandler;
use App\Web\ProjectModule\ProjectModuleDeleteHandler;
use App\Web\ProjectModule\ProjectModuleEditHandler;
use App\Web\ProjectModule\ProjectModuleListHandler;
use App\Web\ProjectModule\ProjectModuleUpdateHandler;
use Yiisoft\Router\Route;
return [
    Route::get('/')
        ->action(HomePageAction::class)
        ->name('home'),
    Route::get('/hello')
        ->action(HelloPageAction::class)
        ->name('hello'),
    Route::get('/api/ping')
        ->action(PingAction::class)
        ->name('api/ping'),
    Route::get('/api/echo')
        ->action(EchoAction::class)
        ->name('api/echo'),
    Route::get('/project-page')
        ->action(ProjectPageHandler::class)
        ->name('project-page'),
    Route::get('/api/modules')
        ->action(ModulesHandler::class)
        ->name('api/modules'),
    Route::get('/feedback')
        ->action(FeedbackPageHandler::class)
        ->name('feedback'),
    Route::post('/feedback')
        ->action(FeedbackSubmitHandler::class)
        ->name('feedback/submit'),
    Route::get('/project-modules')
        ->action(ProjectModuleListHandler::class)
        ->name('project-modules'),
    Route::post('/project-modules')
        ->action(ProjectModuleCreateHandler::class)
        ->name('project-modules/create'),
    Route::get('/project-modules/edit')
        ->action(ProjectModuleEditHandler::class)
        ->name('project-modules/edit'),
    Route::post('/project-modules/update')
        ->action(ProjectModuleUpdateHandler::class)
        ->name('project-modules/update'),
    Route::post('/project-modules/delete')
        ->action(ProjectModuleDeleteHandler::class)
        ->name('project-modules/delete'),
];