<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Database\Task;
use Psr\Http\Message\ResponseInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class TaskController
{
    use PrototypeTrait;

    /**
     * Please, don't forget to configure the Route attribute or remove it and register the route manually.
     * @param Task $task
     * @return ResponseInterface
     */
    #[Route(route: '/api/task/show/<id:\d+>', name: 'task.show', methods: 'GET')]
    public function show(Task $task): ResponseInterface
    {
        return $this->taskView->json($task);
    }

    #[Route(route: '/api/task/list', name: 'task.list', methods: 'GET')]
    public function list(): array
    {
        $tasks = $this->tasks->findAllWithAuthor();

        return [
            'tasks' => array_map([$this->taskView, 'map'], $tasks->fetchAll())
        ];
    }
}
