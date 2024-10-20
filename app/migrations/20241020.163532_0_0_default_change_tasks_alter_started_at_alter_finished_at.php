<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault5bdb1fc6cf453b63a652cdaaf18b3c9d extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('tasks')
        ->alterColumn('started_at', 'datetime', ['nullable' => true, 'defaultValue' => null])
        ->alterColumn('finished_at', 'datetime', ['nullable' => true, 'defaultValue' => null])
        ->update();
    }

    public function down(): void
    {
        $this->table('tasks')
        ->alterColumn('started_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->alterColumn('finished_at', 'datetime', ['nullable' => false, 'defaultValue' => null])
        ->update();
    }
}
