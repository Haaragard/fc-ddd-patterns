<?php declare(strict_types=1);

namespace App\Infrastructure\Checkout\Model\Doctrine;

use App\Domain\Checkout\Entity\OrderItem as OrderItemEntity;
use App\Domain\Shared\Entity\BaseEntity;
use App\Infrastructure\Product\Model\Doctrine\Product;
use App\Infrastructure\Shared\Model\BaseModel;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'order_items')]
class OrderItem extends BaseModel
{
    public string $entity = OrderItemEntity::class;

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;
    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'items')]
    #[ORM\JoinColumn(name: 'order_id', referencedColumnName: 'id')]
    private Order|null $order;
    #[ORM\ManyToOne(targetEntity: Product::class, cascade: ["persist"])]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product|null $product;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'integer')]
    private int $quantity;
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

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): void
    {
        $this->order = $order;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function map(OrderItemEntity|BaseEntity $entity): void
    {
        if (! is_null($entity->getId())) {
            $this->setId($entity->getId());
        }

        $product = new Product();
        $product->map($entity->getProduct());

        $this->setProduct($product);
        $this->setName($entity->getName());
        $this->setQuantity($entity->getQuantity());
        $this->setPrice($entity->getPrice());
    }

    public function mapToEntity(): OrderItemEntity|BaseEntity
    {
        return new $this->entity(
            id: $this->getId(),
            product: $this->getProduct(),
            name: $this->getName(),
            quantity: $this->getQuantity(),
            price: $this->getPrice()
        );
    }
}
