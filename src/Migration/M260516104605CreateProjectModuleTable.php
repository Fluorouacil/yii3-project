<?php

declare(strict_types=1);

use Yiisoft\Db\Migration\MigrationBuilder;
use Yiisoft\Db\Migration\RevertibleMigrationInterface;

final class M260516104605CreateProjectModuleTable implements RevertibleMigrationInterface
{
    public function up(MigrationBuilder $b): void
    {
        $b->execute("
            CREATE TABLE `project_module` (
                `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `title` varchar(255) NOT NULL,
                `description` text,
                `status` varchar(20) NOT NULL DEFAULT 'new',
                `sort` int NOT NULL DEFAULT 0,
                `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` datetime NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    public function down(MigrationBuilder $b): void
    {
        $b->dropTable('project_module');
    }
}
