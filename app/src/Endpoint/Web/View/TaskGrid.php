<?php

namespace App\Endpoint\Web\View;

use App\Database\Task;
use App\Support\Enums\TaskPriority;
use App\Support\Enums\TaskStatus;
use Spiral\DataGrid\GridSchema;
use Spiral\DataGrid\Specification\Filter;
use Spiral\DataGrid\Specification\Pagination\PagePaginator;
use Spiral\DataGrid\Specification\Sorter\Sorter;
use Spiral\DataGrid\Specification\Value;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'taskGrid')]
class TaskGrid extends GridSchema
{
    public function __construct(private readonly TaskView $view) {
        $this->addFilter('assigned', new Filter\Equals('assigned.id', new Value\IntValue()));
        $this->addFilter(
            'priority',
            new Filter\Equals('priority', new Value\EnumValue(
                new Value\StringValue(),
                ...array_column(TaskPriority::cases(), 'value')
            ))
        );
        $this->addFilter(
            'status',
            new Filter\Equals(
                'status',
                new Value\EnumValue(
                    new Value\StringValue(),
                    ...array_column(TaskStatus::cases(), 'value')
                )
            )
        );
//        $this->addFilter('created_at', new Filter\Between('created_at',['from', 'to']));
//        $this->addFilter('updated_at', new Filter\Between('updated_at',['from', 'to']));

        $this->addSorter('id', new Sorter('id'));
        $this->addSorter('created_at', new Sorter('created_at'));
        $this->addSorter('updated_at', new Sorter('updated_at'));
        $this->addSorter('assigned', new Sorter('assigned.id'));

        // default limit, available limits
        $this->setPaginator(new PagePaginator(10, [10, 20, 50]));
    }

    public function __invoke(Task $task): array
    {
        return $this->view->map($task);
    }
}
