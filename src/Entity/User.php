<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;



    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $paymentOption;

    /**
     * @ORM\Column(type="smallint")
     */
    private $optionPrice;


    /**
     * @ORM\OneToMany(targetEntity=Notification::class, mappedBy="sender")
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity=TchatMessages::class, mappedBy="sender")
     */
    private $tchatMessages;


    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="datetime", length=30)
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $erea;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mainPicture;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture7;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture8;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $profileDescription;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\ManyToOne(targetEntity=SensitiveData::class, inversedBy="users")
     */
    private $caracteristique;


    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->tchatMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPaymentOption(): ?string
    {
        return $this->paymentOption;
    }

    public function setPaymentOption(string $paymentOption): self
    {
        $this->paymentOption = $paymentOption;

        return $this;
    }

    public function getOptionPrice(): ?int
    {
        return $this->optionPrice;
    }

    public function setOptionPrice(int $optionPrice): self
    {
        $this->optionPrice = $optionPrice;

        return $this;
    }



    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setSender($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getSender() === $this) {
                $notification->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TchatMessages>
     */
    public function getTchatMessages(): Collection
    {
        return $this->tchatMessages;
    }

    public function addTchatMessage(TchatMessages $tchatMessage): self
    {
        if (!$this->tchatMessages->contains($tchatMessage)) {
            $this->tchatMessages[] = $tchatMessage;
            $tchatMessage->setSender($this);
        }

        return $this;
    }

    public function removeTchatMessage(TchatMessages $tchatMessage): self
    {
        if ($this->tchatMessages->removeElement($tchatMessage)) {
            // set the owning side to null (unless already changed)
            if ($tchatMessage->getSender() === $this) {
                $tchatMessage->setSender(null);
            }
        }

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getErea(): ?string
    {
        return $this->erea;
    }

    public function setErea(string $erea): self
    {
        $this->erea = $erea;

        return $this;
    }

    public function getMainPicture(): ?string
    {
        return $this->mainPicture;
    }

    public function setMainPicture(?string $mainPicture): self
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }


    public function getPicture2(): ?string
    {
        return $this->picture2;
    }

    public function setPicture2(?string $picture2): self
    {
        $this->picture2 = $picture2;

        return $this;
    }

    public function getPicture3(): ?string
    {
        return $this->picture3;
    }

    public function setPicture3(?string $picture3): self
    {
        $this->picture3 = $picture3;

        return $this;
    }

    public function getPicture4(): ?string
    {
        return $this->picture4;
    }

    public function setPicture4(?string $picture4): self
    {
        $this->picture4 = $picture4;

        return $this;
    }

    public function getPicture5(): ?string
    {
        return $this->picture5;
    }

    public function setPicture5(?string $picture5): self
    {
        $this->picture5 = $picture5;

        return $this;
    }

    public function getPicture6(): ?string
    {
        return $this->picture6;
    }

    public function setPicture6(?string $picture6): self
    {
        $this->picture6 = $picture6;

        return $this;
    }

    public function getPicture7(): ?string
    {
        return $this->picture7;
    }

    public function setPicture7(?string $picture7): self
    {
        $this->picture7 = $picture7;

        return $this;
    }

    public function getPicture8(): ?string
    {
        return $this->picture8;
    }

    public function setPicture8(?string $picture8): self
    {
        $this->picture8 = $picture8;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getProfileDescription(): ?string
    {
        return $this->profileDescription;
    }

    public function setProfileDescription(?string $profileDescription): self
    {
        $this->profileDescription = $profileDescription;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCaracteristique(): ?SensitiveData
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(?SensitiveData $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }
}
