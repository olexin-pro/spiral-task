<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\UserRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Table\Index;
use Cycle\Annotated\Annotation\Relation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[Entity(repository: UserRepository::class)]
#[Column(name: 'created_at', type: 'datetime')]
#[Column(name: 'updated_at', type: 'datetime')]
#[Column(name: 'deleted_at', type: 'datetime', nullable: true)]
#[Index(columns: ['username'], unique: true)]
class User
{
    #[Column(type: 'primary')]
    public int $id;

    /**
     * @var Collection|Task[]
     * @psalm-var Collection<int, Task>
     */
    #[Relation\HasMany(target: Task::class, innerKey: 'id', outerKey: 'assigned_id')]
    public Collection $tasks;

    public function __construct(
        #[Column(type: 'string')]
        public string $name,

        #[Column(type: 'string', nullable: true)]
        public string $last_name,

        #[Column(type: 'string', nullable: true)]
        public string $second_name,

        #[Column(type: 'string')]
        public string $username,

        #[Column(type: 'string')]
        public string $email,

        #[Column(type: 'string')]
        public string $password,
    ) {
        $this->tasks = new ArrayCollection();
    }
}
