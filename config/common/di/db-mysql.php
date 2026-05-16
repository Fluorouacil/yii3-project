<?php
declare(strict_types=1);
use Psr\SimpleCache\CacheInterface;
use Yiisoft\Cache\File\FileCache;
use Yiisoft\Db\Cache\SchemaCache;
use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Mysql\Connection;
use Yiisoft\Db\Mysql\Driver;

return [
    CacheInterface::class => static fn(): CacheInterface => new FileCache(
        __DIR__ . '/../../../runtime/cache/db-schema'
    ),
    ConnectionInterface::class => static function (CacheInterface $cache): ConnectionInterface {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s',
            getenv('DB_HOST') ?: 'db',
            getenv('DB_PORT') ?: '3306',
            getenv('DB_NAME') ?: 'yii3app',
        );
        $driver = new Driver(
            $dsn,
            getenv('DB_USER') ?: 'yii3user',
            getenv('DB_PASSWORD') ?: 'yii3pass',
        );
        $driver->charset('utf8mb4');
        return new Connection($driver, new SchemaCache($cache));
    },
];