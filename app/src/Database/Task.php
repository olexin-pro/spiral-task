<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\TaskRepository;
use App\Support\Enums\TaskPriority;
use App\Support\Enums\TaskStatus;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation;
use Cycle\Annotated\Annotation\Table\Index;
use DateTimeInterface;

#[Entity(repository: TaskRepository::class)]
#[Index(columns: ['status', 'created_at'])]
class Task
{
    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'string')]
        public string             $title,

        #[Column(type: 'text', nullable: true)]
        public ?string            $description,

        #[Column(type: 'text', nullable: true)]
        public ?string            $final_text,

        #[Column(type: 'string', default: 'new', typecast: TaskStatus::class)]
        public TaskStatus         $status,

        #[Column(type: 'enum(low,middle,high)', default: 'low', typecast: TaskPriority::class)]
        public TaskPriority       $priority,

        #[Relation\BelongsTo(target: Task::class, nullable: true, innerKey: 'parent_task_id', outerKey: 'id')]
        public ?Task              $parentTask,

        #[Relation\BelongsTo(target: User::class, nullable: false, outerKey: 'id', innerKey: 'assigned_id')]
        public User               $assigned,

        #[Column(name: 'created_at', type: 'datetime')]
        public ?DateTimeInterface $createdAt,

        #[Column(name: 'updated_at', type: 'datetime')]
        public DateTimeInterface  $updatedAt,

        #[Column(name: 'started_at', type: 'datetime', nullable: true)]
        public ?DateTimeInterface $startedAt,

        #[Column(name: 'finished_at', type: 'datetime', nullable: true)]
        public ?DateTimeInterface $finishedAt,

        #[Column(name: 'deleted_at', type: 'datetime', nullable: true)]
        public ?DateTimeInterface $deletedAt,
    )
    {
    }
}
