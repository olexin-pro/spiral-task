<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Database\Task;
use App\Endpoint\Web\View\TaskGrid;
use Cycle\ORM\Select;
use Psr\Http\Message\ResponseInterface;
use Spiral\DataGrid\Annotation\DataGrid;
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
    #[DataGrid(grid: TaskGrid::class)]
    public function list(): Select
    {
        return $this->tasks->findAllWithAuthor();
    }
}
