<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @ORM\Column(type="string", length=50)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $sex;

    /**
     * @ORM\Column(type="datetime", length=30)
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string")
     */
    private $size;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mainPicture;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $levelOfStudies;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $languages;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $smoke;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $personalityTraits;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $sport;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $job;

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
     * @ORM\OneToMany(targetEntity=TchatMessages::class, mappedBy="user", orphanRemoval=true)
     */
    private $yes;


    public function __construct()
    {
        $this->notifications = new ArrayCollection();
        $this->tchatMessages = new ArrayCollection();
        $this->yes = new ArrayCollection();
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
        return (string) $this->password;
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

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
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

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

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

    public function getLevelOfStudies(): ?string
    {
        return $this->levelOfStudies;
    }

    public function setLevelOfStudies(?string $levelOfStudies): self
    {
        $this->levelOfStudies = $levelOfStudies;

        return $this;
    }

    public function getLanguages(): ?string
    {
        return $this->languages;
    }

    public function setLanguages(?string $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getSmoke(): ?string
    {
        return $this->smoke;
    }

    public function setSmoke(string $smoke): self
    {
        $this->smoke = $smoke;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getPersonalityTraits(): ?string
    {
        return $this->personalityTraits;
    }

    public function setPersonalityTraits(?string $personalityTraits): self
    {
        $this->personalityTraits = $personalityTraits;

        return $this;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(?string $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

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
            $this->paymentOption = "free";
        
    

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

    /**
     * @return Collection<int, TchatMessages>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(TchatMessages $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes[] = $ye;
            $ye->setUser($this);
        }

        return $this;
    }

    public function removeYe(TchatMessages $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getUser() === $this) {
                $ye->setUser(null);
            }
        }

        return $this;
    }

}
