<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultC1e2e1f4a7e5a2bf1da5ea88d3d38e0b extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('tasks')
        ->addColumn('started_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('finished_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->dropColumn('user_id')
        ->dropIndex(['user_id'])
        ->dropForeignKey(['user_id'])
        ->update();
    }

    public function down(): void
    {
        $this->table('tasks')
        ->addForeignKey(['user_id'], 'users', ['id'], [
            'name' => 'tasks_foreign_user_id_6714d038dc04a',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->addIndex(['user_id'], ['name' => 'tasks_index_user_id_6714d038dc03b', 'unique' => false])
        ->addColumn('user_id', 'integer', [
            'nullable' => false,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->dropColumn('started_at')
        ->dropColumn('finished_at')
        ->update();
    }
}
