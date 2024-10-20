<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault2af2ae408258e2934350cf6d986bc9a9 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('tasks')
        ->addColumn('parent_task_id', 'integer', [
            'nullable' => true,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->dropColumn('parentTask_id')
        ->addIndex(['parent_task_id'], ['name' => 'tasks_index_parent_task_id_6714d0d1767fa', 'unique' => false])
        ->dropIndex(['parentTask_id'])
        ->addForeignKey(['parent_task_id'], 'tasks', ['id'], [
            'name' => 'tasks_foreign_parent_task_id_6714d0d176813',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->dropForeignKey(['parentTask_id'])
        ->update();
    }

    public function down(): void
    {
        $this->table('tasks')
        ->addForeignKey(['parentTask_id'], 'tasks', ['id'], [
            'name' => 'tasks_foreign_parenttask_id_6714d0b5e910c',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->dropForeignKey(['parent_task_id'])
        ->addIndex(['parentTask_id'], ['name' => 'tasks_index_parenttask_id_6714d0b5e90f3', 'unique' => false])
        ->dropIndex(['parent_task_id'])
        ->addColumn('parentTask_id', 'integer', [
            'nullable' => true,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->dropColumn('parent_task_id')
        ->update();
    }
}
