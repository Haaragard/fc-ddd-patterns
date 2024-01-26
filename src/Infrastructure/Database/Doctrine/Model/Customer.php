<?php declare(strict_types=1);

namespace App\Infrastructure\Database\Doctrine\Model;

use App\Domain\Entity\Address;
use App\Domain\Entity\BaseEntity;
use App\Domain\Entity\Customer as CustomerEntity;
use App\Infrastructure\Database\BaseModel;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
#[ORM\Table(name: 'customers')]
class Customer extends BaseModel
{
    public string $entity = CustomerEntity::class;

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface|string $id;
    #[ORM\Column(type: 'string')]
    private string $name;
    #[ORM\Column(type: 'string')]
    private string $street;
    #[ORM\Column(type: 'integer')]
    private int $number;
    #[ORM\Column(type: 'string')]
    private string $zip;
    #[ORM\Column(type: 'string')]
    private string $city;
    #[ORM\Column(type: 'boolean')]
    private bool $active;
    #[ORM\Column(type: 'integer')]
    private int $rewardPoints = 0;

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

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getRewardPoints(): int
    {
        return $this->rewardPoints;
    }

    public function setRewardPoints(int $rewardPoints): void
    {
        $this->rewardPoints = $rewardPoints;
    }

    public function map(CustomerEntity|BaseEntity $entity): void
    {
        if (! is_null($entity->getId())) {
            $this->setId($entity->getId());
        }

        $this->setName($entity->getName());
        $this->setActive($entity->isActive());
        $this->setRewardPoints($entity->getRewardPoints());

        $address = $entity->getAddress();
        $this->setStreet($address->getStreet());
        $this->setNumber($address->getNumber());
        $this->setZip($address->getZip());
        $this->setCity($address->getCity());
    }

    public function mapToEntity(): CustomerEntity|BaseEntity
    {
        /**
         * @var CustomerEntity
         */
        $customer = new $this->entity(
            id: $this->getId(),
            name: $this->getName(),
            active: $this->getActive()
        );
        $customer->setRewardPoints($this->getRewardPoints());

        $address = new Address(
            $this->street,
            $this->number,
            $this->zip,
            $this->city
        );
        $customer->setAddress($address);

        return $customer;
    }
}
