<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\BaseEntity;
use App\Domain\Repository\RepositoryInterface;
use App\Infrastructure\Database\BaseModel;
use Doctrine\ORM\EntityManagerInterface;

abstract class Repository implements RepositoryInterface
{
    protected string $model = BaseModel::class;

    public function __construct(protected EntityManagerInterface $entityManager)
    {}

    public function create(BaseEntity $entity): void
    {
        $model = new $this->model;
        $model->map($entity);

        $this->entityManager->persist($model);
        $this->flush();

        $entity->setId($model->getId());
    }

    public function update(BaseEntity $entity): void
    {
        $model = $this->entityManager->getRepository($this->model)
            ->find($entity->getId());
        $model->map($entity);

        $this->flush();
    }

    public function find(mixed $id): BaseEntity
    {
        $repository = $this->entityManager->getRepository($this->model);

        $model = $repository->find($id);

        return $model->mapToEntity();
    }

    public function findAll(): array
    {
        $repository = $this->entityManager->getRepository($this->model);
        $models = $repository->findAll();

        return array_map(fn (BaseModel $model) => $model->mapToEntity(), $models);
    }

    protected function flush(): void
    {
        $this->entityManager->flush();
    }
}
