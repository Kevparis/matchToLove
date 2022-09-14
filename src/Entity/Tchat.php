<?php

namespace App\Entity;

use App\Repository\TchatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TchatRepository::class)
 */
class Tchat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sentMessage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sentStandardTypicalMessages;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tchats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $receivedMessage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $receivedStandardTypicalMessages;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $sentLike;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $receivedLike;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $sentStar;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $receivedStar;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $unlike;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $banish;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ReportOffensiveInfringingMessage;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSentMessage(): ?string
    {
        return $this->sentMessage;
    }

    public function setSentMessage(?string $sentMessage): self
    {
        $this->sentMessage = $sentMessage;

        return $this;
    }

    public function getSentStandardTypicalMessages(): ?string
    {
        return $this->sentStandardTypicalMessages;
    }

    public function setSentStandardTypicalMessages(?string $sentStandardTypicalMessages): self
    {
        $this->sentStandardTypicalMessages = $sentStandardTypicalMessages;

        return $this;
    }

    public function getPseudo(): ?User
    {
        return $this->pseudo;
    }

    public function setPseudo(?User $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getReceivedMessage(): ?string
    {
        return $this->receivedMessage;
    }

    public function setReceivedMessage(?string $receivedMessage): self
    {
        $this->receivedMessage = $receivedMessage;

        return $this;
    }

    public function getReceivedStandardTypicalMessages(): ?string
    {
        return $this->receivedStandardTypicalMessages;
    }

    public function setReceivedStandardTypicalMessages(?string $receivedStandardTypicalMessages): self
    {
        $this->receivedStandardTypicalMessages = $receivedStandardTypicalMessages;

        return $this;
    }

    public function getSentLike(): ?string
    {
        return $this->sentLike;
    }

    public function setSentLike(?string $sentLike): self
    {
        $this->sentLike = $sentLike;

        return $this;
    }

    public function getReceivedLike(): ?string
    {
        return $this->receivedLike;
    }

    public function setReceivedLike(?string $receivedLike): self
    {
        $this->receivedLike = $receivedLike;

        return $this;
    }

    public function getSentStar(): ?string
    {
        return $this->sentStar;
    }

    public function setSentStar(?string $sentStar): self
    {
        $this->sentStar = $sentStar;

        return $this;
    }

    public function getReceivedStar(): ?string
    {
        return $this->receivedStar;
    }

    public function setReceivedStar(?string $receivedStar): self
    {
        $this->receivedStar = $receivedStar;

        return $this;
    }

    public function getUnlike(): ?string
    {
        return $this->unlike;
    }

    public function setUnlike(?string $unlike): self
    {
        $this->unlike = $unlike;

        return $this;
    }

    public function getBanish(): ?string
    {
        return $this->banish;
    }

    public function setBanish(?string $banish): self
    {
        $this->banish = $banish;

        return $this;
    }

    public function getReportOffensiveInfringingMessage(): ?string
    {
        return $this->ReportOffensiveInfringingMessage;
    }

    public function setReportOffensiveInfringingMessage(?string $ReportOffensiveInfringingMessage): self
    {
        $this->ReportOffensiveInfringingMessage = $ReportOffensiveInfringingMessage;

        return $this;
    }

 
}
