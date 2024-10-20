<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultD0a9903225d82ece9d6dc891fbed5013 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('users')
        ->alterColumn('deleted_at', 'datetime', ['nullable' => true, 'defaultValue' => null])
        ->update();
        $this->table('tasks')
        ->alterColumn('deleted_at', 'datetime', ['nullable' => true, 'defaultValue' => null])
        ->update();
    }

    public function down(): void
    {
        $this->table('tasks')
        ->alterColumn('deleted_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->update();
        $this->table('users')
        ->alterColumn('deleted_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->update();
    }
}
