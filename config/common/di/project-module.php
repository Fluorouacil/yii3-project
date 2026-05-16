<?php
declare(strict_types=1);

use App\Domain\ProjectModule\ProjectModuleRepository;
use Yiisoft\Db\Connection\ConnectionInterface;

return [
    ProjectModuleRepository::class => static fn(ConnectionInterface $db)
        => new ProjectModuleRepository($db),
];