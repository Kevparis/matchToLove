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
     * @ORM\Column(type="string", length=30)
     */
    private $birthday;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="smallint")
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $ethnicalOrigin;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $eyesColor;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $hairSLength;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $hairSColor;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $religion;

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
     * @ORM\Column(type="string", length=25)
     */
    private $maritalStatus;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $havingKids;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $wantKids;

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
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $weight;

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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $hobbies;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mostAttractiveInOneself;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $silhouette;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $genderIdentity;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $musicalTaste;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $pets;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $outings;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $dietType;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $income;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $religionPracticeLevel;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $style;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $myLittleFlaw;

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


    public function __construct()
    {
        $this->notifications = new ArrayCollection();
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

    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): self
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

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getEthnicalOrigin(): ?string
    {
        return $this->ethnicalOrigin;
    }

    public function setEthnicalOrigin(string $ethnicalOrigin): self
    {
        $this->ethnicalOrigin = $ethnicalOrigin;

        return $this;
    }

    public function getEyesColor(): ?string
    {
        return $this->eyesColor;
    }

    public function setEyesColor(?string $eyesColor): self
    {
        $this->eyesColor = $eyesColor;

        return $this;
    }

    public function getHairSLength(): ?string
    {
        return $this->hairSLength;
    }

    public function setHairSLength(?string $hairSLength): self
    {
        $this->hairSLength = $hairSLength;

        return $this;
    }

    public function getHairSColor(): ?string
    {
        return $this->hairSColor;
    }

    public function setHairSColor(?string $hairSColor): self
    {
        $this->hairSColor = $hairSColor;

        return $this;
    }

    public function getReligion(): ?string
    {
        return $this->religion;
    }

    public function setReligion(?string $religion): self
    {
        $this->religion = $religion;

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

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(string $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getHavingKids(): ?string
    {
        return $this->havingKids;
    }

    public function setHavingKids(string $havingKids): self
    {
        $this->havingKids = $havingKids;

        return $this;
    }

    public function getWantKids(): ?string
    {
        return $this->wantKids;
    }

    public function setWantKids(?string $wantKids): self
    {
        $this->wantKids = $wantKids;

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

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

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

    public function getHobbies(): ?string
    {
        return $this->hobbies;
    }

    public function setHobbies(?string $hobbies): self
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    public function getMostAttractiveInOneself(): ?string
    {
        return $this->mostAttractiveInOneself;
    }

    public function setMostAttractiveInOneself(?string $mostAttractiveInOneself): self
    {
        $this->mostAttractiveInOneself = $mostAttractiveInOneself;

        return $this;
    }

    public function getSilhouette(): ?string
    {
        return $this->silhouette;
    }

    public function setSilhouette(string $silhouette): self
    {
        $this->silhouette = $silhouette;

        return $this;
    }

    public function getGenderIdentity(): ?string
    {
        return $this->genderIdentity;
    }

    public function setGenderIdentity(string $genderIdentity): self
    {
        $this->genderIdentity = $genderIdentity;

        return $this;
    }

    public function getMusicalTaste(): ?string
    {
        return $this->musicalTaste;
    }

    public function setMusicalTaste(?string $musicalTaste): self
    {
        $this->musicalTaste = $musicalTaste;

        return $this;
    }

    public function getPets(): ?string
    {
        return $this->pets;
    }

    public function setPets(?string $pets): self
    {
        $this->pets = $pets;

        return $this;
    }

    public function getOutings(): ?string
    {
        return $this->outings;
    }

    public function setOutings(?string $outings): self
    {
        $this->outings = $outings;

        return $this;
    }

    public function getDietType(): ?string
    {
        return $this->dietType;
    }

    public function setDietType(?string $dietType): self
    {
        $this->dietType = $dietType;

        return $this;
    }

    public function getIncome(): ?string
    {
        return $this->income;
    }

    public function setIncome(?string $income): self
    {
        $this->income = $income;

        return $this;
    }

    public function getReligionPracticeLevel(): ?string
    {
        return $this->religionPracticeLevel;
    }

    public function setReligionPracticeLevel(?string $religionPracticeLevel): self
    {
        $this->religionPracticeLevel = $religionPracticeLevel;

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

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(?string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getMyLittleFlaw(): ?string
    {
        return $this->myLittleFlaw;
    }

    public function setMyLittleFlaw(?string $myLittleFlaw): self
    {
        $this->myLittleFlaw = $myLittleFlaw;

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
     * @return Collection<int, Tchat>
     */
    public function getTchats(): Collection
    {
        return $this->tchats;
    }

    public function addTchat(Tchat $tchat): self
    {
        if (!$this->tchats->contains($tchat)) {
            $this->tchats[] = $tchat;
            $tchat->setPseudo($this);
        }

        return $this;
    }

    public function removeTchat(Tchat $tchat): self
    {
        if ($this->tchats->removeElement($tchat)) {
            // set the owning side to null (unless already changed)
            if ($tchat->getPseudo() === $this) {
                $tchat->setPseudo(null);
            }
        }

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
}
