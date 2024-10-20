<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultFea3e25e0015c2ccd491835dd303c75c extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('users')
        ->addColumn('id', 'primary', [
            'nullable' => false,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => true,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->addColumn('name', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
        ->addColumn('last_name', 'string', ['nullable' => true, 'defaultValue' => null, 'size' => 255])
        ->addColumn('second_name', 'string', ['nullable' => true, 'defaultValue' => null, 'size' => 255])
        ->addColumn('username', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
        ->addColumn('email', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
        ->addColumn('password', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
        ->addColumn('created_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('updated_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('deleted_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addIndex(['username'], ['name' => 'users_index_username_6714d038dc40f', 'unique' => true])
        ->setPrimaryKeys(['id'])
        ->create();
        $this->table('tasks')
        ->addColumn('id', 'primary', [
            'nullable' => false,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => true,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->addColumn('title', 'string', ['nullable' => false, 'defaultValue' => null, 'size' => 255])
        ->addColumn('description', 'text', ['nullable' => true, 'defaultValue' => null])
        ->addColumn('final_text', 'text', ['nullable' => true, 'defaultValue' => null])
        ->addColumn('status', 'string', ['nullable' => false, 'defaultValue' => 'new', 'size' => 255])
        ->addColumn('priority', 'enum', ['nullable' => false, 'defaultValue' => 'low', 'values' => ['low', 'middle', 'high']])
        ->addColumn('created_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('updated_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('deleted_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->addColumn('parent_task_id', 'integer', [
            'nullable' => true,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->addColumn('assigned_id', 'integer', [
            'nullable' => false,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->addColumn('user_id', 'integer', [
            'nullable' => false,
            'defaultValue' => null,
            'size' => 11,
            'autoIncrement' => false,
            'unsigned' => false,
            'zerofill' => false,
        ])
        ->addIndex(['parent_task_id'], ['name' => 'tasks_index_parent_task_id_6714d038dbb22', 'unique' => false])
        ->addIndex(['assigned_id'], ['name' => 'tasks_index_assigned_id_6714d038dbfcf', 'unique' => false])
        ->addIndex(['user_id'], ['name' => 'tasks_index_user_id_6714d038dc03b', 'unique' => false])
        ->addIndex(['status', 'created_at'], ['name' => 'tasks_index_status_created_at_6714d038dc3e9', 'unique' => false])
        ->addForeignKey(['parent_task_id'], 'tasks', ['id'], [
            'name' => 'tasks_foreign_parent_task_id_6714d038dbb3e',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->addForeignKey(['assigned_id'], 'users', ['id'], [
            'name' => 'tasks_foreign_assigned_id_6714d038dbfec',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->addForeignKey(['user_id'], 'users', ['id'], [
            'name' => 'tasks_foreign_user_id_6714d038dc04a',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'indexCreate' => true,
        ])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('tasks')->drop();
        $this->table('users')->drop();
    }
}
