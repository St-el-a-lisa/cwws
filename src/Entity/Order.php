<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $orderTime = null;

    #[ORM\Column(length: 255)]
    private ?string $orderStatus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $OrderNotes = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderTime(): ?\DateTimeInterface
    {
        return $this->orderTime;
    }

    public function setOrderTime(\DateTimeInterface $orderTime): static
    {
        $this->orderTime = $orderTime;

        return $this;
    }

    public function getOrderStatus(): ?string
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(string $orderStatus): static
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    public function getOrderNotes(): ?string
    {
        return $this->OrderNotes;
    }

    public function setOrderNotes(?string $OrderNotes): static
    {
        $this->OrderNotes = $OrderNotes;

        return $this;
    }
}
