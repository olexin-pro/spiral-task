<?php
namespace App\Endpoint\Web\View;

use App\Database\Task;
use Psr\Http\Message\ResponseInterface;
use Spiral\Core\Attribute\Singleton;
use Spiral\Prototype\Annotation\Prototyped;
use Spiral\Prototype\Traits\PrototypeTrait;

#[Singleton]
#[Prototyped(property: 'taskView')]
final class TaskView
{
    use PrototypeTrait;

    public function map(Task $task): array
    {
        return [
            'id'      => $task->id,

            'assigned'  => [
                'id'   => $task->assigned->id,
                'name' => $task->assigned->name
            ],

            'title'   => $task->title,
            'status'   => $task->status->value,
            'priority'   => $task->priority->value,
            'description' => $task->description,

            'created' => $task->createdAt->format(DATE_ATOM),
            'updated' => $task->updatedAt->format(DATE_ATOM),
            'started' => $task->startedAt?->format(DATE_ATOM) ?? null,
            'finished' => $task->finishedAt?->format(DATE_ATOM) ?? null,
        ];
    }

    public function json(Task $task): ResponseInterface
    {
        return $this->response->json($this->map($task), 200);
    }
}
