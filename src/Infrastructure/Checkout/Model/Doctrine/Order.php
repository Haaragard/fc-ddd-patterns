<?php declare(strict_types=1);

namespace App\Infrastructure\Checkout\Model\Doctrine;

use App\Domain\Checkout\Entity\Order as OrderEntity;
use App\Domain\Checkout\Entity\OrderItem as OrderItemEntity;
use App\Domain\Customer\Entity\Customer as CustomerEntity;
use App\Domain\Customer\ValueObject\Address;
use App\Domain\Product\Entity\Product as ProductEntity;
use App\Domain\Shared\Entity\BaseEntity;
use App\Infrastructure\Customer\Model\Doctrine\Customer;
use App\Infrastructure\Shared\Model\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]
class Order extends BaseModel
{
    public string $entity = OrderEntity::class;

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;
    #[ORM\ManyToOne(targetEntity: Customer::class, cascade: ["persist"])]
    #[ORM\JoinColumn(name: 'customer_id', referencedColumnName: 'id')]
    private Customer|null $customer;
    #[ORM\OneToMany(
        mappedBy: 'order',
        targetEntity: OrderItem::class,
        cascade: ["persist"]
    )]
    private Collection $items;

    public function getId(): string
    {
        return (string) $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getItems(): array
    {
        return $this->items->toArray();
    }

    public function setItems(array $items): void
    {
        $this->items = new ArrayCollection($items);
    }

    public function map(OrderEntity|BaseEntity $entity): void
    {
        if (! is_null($entity->getId())) {
            $this->setId($entity->getId());
        }

        $customer = new Customer();
        $customer->map($entity->getCustomer());

        $this->setCustomer($customer);
        $this->setItems($this->mapItems($entity->getItems()));
    }

    public function mapToEntity(): OrderEntity|BaseEntity
    {
        $customerModel = $this->getCustomer();
        $customer = new CustomerEntity(
            $customerModel->getId(),
            $customerModel->getName(),
            $customerModel->getActive()
        );
        $customer->setRewardPoints($customerModel->getRewardPoints());

        $address = new Address(
            $customerModel->getStreet(),
            $customerModel->getNumber(),
            $customerModel->getZip(),
            $customerModel->getCity()
        );
        $customer->setAddress($address);

        return new $this->entity(
            id: $this->getId(),
            customer: $customer,
            items: $this->mapItemsToEntity()
        );
    }

    private function mapItems(array $items): array
    {
        return array_map(
            function (OrderItemEntity $orderItem) {
                $orderItemModel = new OrderItem();
                $orderItemModel->map($orderItem);
                $orderItemModel->setOrder($this);

                return $orderItemModel;
            },
            $items
        );
    }

    private function mapItemsToEntity(): array
    {
        return array_map(function (OrderItem $orderItem) {
            $product = $orderItem->getProduct();
            $productEntity = new ProductEntity(
                $product->getId(),
                $product->getName(),
                $product->getPrice()
            );

            return new OrderItemEntity(
                    $orderItem->getId(),
                    $productEntity,
                    $orderItem->getName(),
                    $orderItem->getQuantity(),
                    $orderItem->getPrice()
                );
            },
            $this->getItems()
        );
    }
}
