<?php declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\Model;

use App\Domain\Entity\BaseEntity;
use App\Domain\Entity\Product as ProductEntity;
use App\Infrastructure\Database\BaseModel;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class Product extends BaseModel
{
    public string $entity = ProductEntity::class;

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'integer')]
    private int $price;

    public function getId(): string
    {
        return (string) $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function map(ProductEntity|BaseEntity $entity): void
    {
        if (! is_null($entity->getId())) {
            $this->setId($entity->getId());
        }

        $this->setName($entity->getName());
        $this->setPrice($entity->getPrice());
    }

    public function mapToEntity(): ProductEntity|BaseEntity
    {
        return new $this->entity(
            id: $this->getId(),
            name: $this->getName(),
            price: $this->getPrice()
        );
    }
}
