<?php
declare(strict_types=1);

namespace App\Domain\ProjectModule;

use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Query\Query;

final class ProjectModuleRepository
{
    public function __construct(
        private ConnectionInterface $db,
    ) {
    }

    public function getAll(): array
    {
        return (new Query($this->db))
            ->from('project_module')
            ->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC])
            ->all();
    }

    public function insert(ProjectModuleData $data): void
    {
        $this->db->createCommand()->insert('project_module', [
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
            'sort' => (int) $data->sort,
            'updated_at' => null,
        ])->execute();
    }

    public function getById(int $id): ?array
    {
        $result = (new Query($this->db))
            ->from('project_module')
            ->where(['id' => $id])
            ->one();
        return $result === false ? null : $result;
    }

    public function update(int $id, ProjectModuleData $data): void
    {
        $this->db->createCommand()->update('project_module', [
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
            'sort' => (int) $data->sort,
            'updated_at' => date('Y-m-d H:i:s'),
        ], ['id' => $id])->execute();
    }

    public function delete(int $id): void
    {
        $this->db->createCommand()->delete('project_module', [
            'id' => $id,
        ])->execute();
    }
}