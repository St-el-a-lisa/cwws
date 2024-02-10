<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $paymentNumber = null;

    #[ORM\Column]
    private ?float $paymentAmount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $paymentDate = null;

    #[ORM\Column(length: 255)]
    private ?string $paymentStatus = null;

    #[ORM\Column(length: 255)]
    private ?string $paymentMethod = null;

    #[ORM\Column(nullable: true)]
    private ?bool $paymentDefault = null;

    #[ORM\ManyToMany(targetEntity: Order::class, inversedBy: 'payments')]
    private Collection $linkedOrder;

    public function __construct()
    {
        $this->linkedOrder = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentNumber(): ?int
    {
        return $this->paymentNumber;
    }

    public function setPaymentNumber(int $paymentNumber): static
    {
        $this->paymentNumber = $paymentNumber;

        return $this;
    }

    public function getPaymentAmount(): ?float
    {
        return $this->paymentAmount;
    }

    public function setPaymentAmount(float $paymentAmount): static
    {
        $this->paymentAmount = $paymentAmount;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(\DateTimeInterface $paymentDate): static
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): static
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function isPaymentDefault(): ?bool
    {
        return $this->paymentDefault;
    }

    public function setPaymentDefault(?bool $paymentDefault): static
    {
        $this->paymentDefault = $paymentDefault;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getLinkedOrder(): Collection
    {
        return $this->linkedOrder;
    }

    public function addLinkedOrder(Order $linkedOrder): static
    {
        if (!$this->linkedOrder->contains($linkedOrder)) {
            $this->linkedOrder->add($linkedOrder);
        }

        return $this;
    }

    public function removeLinkedOrder(Order $linkedOrder): static
    {
        $this->linkedOrder->removeElement($linkedOrder);

        return $this;
    }
}
