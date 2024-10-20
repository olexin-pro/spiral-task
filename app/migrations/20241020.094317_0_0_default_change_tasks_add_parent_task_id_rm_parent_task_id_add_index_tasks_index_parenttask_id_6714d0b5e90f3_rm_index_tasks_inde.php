<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault4d80cdd380fe3d8cbbd6f33ec7a1056b extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('tasks')
        ->addColumn('parentTask_id', 'integer', [
            'nullable' => true,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->dropColumn('parent_task_id')
        ->addIndex(['parentTask_id'], ['name' => 'tasks_index_parenttask_id_6714d0b5e90f3', 'unique' => false])
        ->dropIndex(['parent_task_id'])
        ->addForeignKey(['parentTask_id'], 'tasks', ['id'], [
            'name' => 'tasks_foreign_parenttask_id_6714d0b5e910c',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->dropForeignKey(['parent_task_id'])
        ->update();
    }

    public function down(): void
    {
        $this->table('tasks')
        ->addForeignKey(['parent_task_id'], 'tasks', ['id'], [
            'name' => 'tasks_foreign_parent_task_id_6714d038dbb3e',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->dropForeignKey(['parentTask_id'])
        ->addIndex(['parent_task_id'], ['name' => 'tasks_index_parent_task_id_6714d038dbb22', 'unique' => false])
        ->dropIndex(['parentTask_id'])
        ->addColumn('parent_task_id', 'integer', [
            'nullable' => true,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->dropColumn('parentTask_id')
        ->update();
    }
}
