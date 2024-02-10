<?php

namespace App\Entity;

use App\Repository\ShippingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShippingRepository::class)]
class Shipping
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $shippingPrice = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $shippingDate = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryStatus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trackingNumber = null;


    #[ORM\Column(length: 255)]
    private ?string $shippingMethod = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Order $associatedOrder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShippingPrice(): ?string
    {
        return $this->shippingPrice;
    }

    public function setShippingPrice(string $shippingPrice): static
    {
        $this->shippingPrice = $shippingPrice;

        return $this;
    }

    public function getShippingDate(): ?\DateTimeInterface
    {
        return $this->shippingDate;
    }

    public function setShippingDate(\DateTimeInterface $shippingDate): static
    {
        $this->shippingDate = $shippingDate;

        return $this;
    }

    public function getDeliveryStatus(): ?string
    {
        return $this->deliveryStatus;
    }

    public function setDeliveryStatus(string $deliveryStatus): static
    {
        $this->deliveryStatus = $deliveryStatus;

        return $this;
    }

    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(?string $trackingNumber): static
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }


    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(string $shippingMethod): static
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    public function getAssociatedOrder(): ?Order
    {
        return $this->associatedOrder;
    }

    public function setAssociatedOrder(?Order $associatedOrder): static
    {
        $this->associatedOrder = $associatedOrder;

        return $this;
    }
}
