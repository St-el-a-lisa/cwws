<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $messageSubject = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $messageContent = null;

    #[ORM\Column(length: 255)]
    private ?string $messageStatus = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $messageDate = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Messaging $messaging = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageSubject(): ?string
    {
        return $this->messageSubject;
    }

    public function setMessageSubject(string $messageSubject): static
    {
        $this->messageSubject = $messageSubject;

        return $this;
    }

    public function getMessageContent(): ?string
    {
        return $this->messageContent;
    }

    public function setMessageContent(string $messageContent): static
    {
        $this->messageContent = $messageContent;

        return $this;
    }

    public function getMessageStatus(): ?string
    {
        return $this->messageStatus;
    }

    public function setMessageStatus(string $messageStatus): static
    {
        $this->messageStatus = $messageStatus;

        return $this;
    }

    public function getMessageDate(): ?\DateTimeInterface
    {
        return $this->messageDate;
    }

    public function setMessageDate(\DateTimeInterface $messageDate): static
    {
        $this->messageDate = $messageDate;

        return $this;
    }

    public function getMessaging(): ?Messaging
    {
        return $this->messaging;
    }

    public function setMessaging(?Messaging $messaging): static
    {
        $this->messaging = $messaging;

        return $this;
    }
}
