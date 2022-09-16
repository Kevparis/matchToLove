<?php

namespace App\Entity;

use App\Repository\SensitiveDataRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SensitiveDataRepository::class)
 */
class SensitiveData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $sexSearch;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $religion;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $religionPracticeLevel;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $ethnicalOrigin;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="sensitiveData", cascade={"persist","remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="smallint")
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $eyesColor;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $hairLength;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $hairSClolor;

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
    private $weigth;

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
    private $mostAttractiveInOneSelf;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $silhouette;

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
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="caracteristique")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSexSearch(): ?string
    {
        return $this->sexSearch;
    }

    public function setSexSearch(string $sexSearch): self
    {
        $this->sexSearch = $sexSearch;

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

    public function getReligionPracticeLevel(): ?string
    {
        return $this->religionPracticeLevel;
    }

    public function setReligionPracticeLevel(?string $religionPracticeLevel): self
    {
        $this->religionPracticeLevel = $religionPracticeLevel;

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

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
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

    public function getEyesColor(): ?string
    {
        return $this->eyesColor;
    }

    public function setEyesColor(?string $eyesColor): self
    {
        $this->eyesColor = $eyesColor;

        return $this;
    }

    public function getHairLength(): ?string
    {
        return $this->hairLength;
    }

    public function setHairLength(?string $hairLength): self
    {
        $this->hairLength = $hairLength;

        return $this;
    }

    public function getHairSClolor(): ?string
    {
        return $this->hairSClolor;
    }

    public function setHairSClolor(?string $hairSClolor): self
    {
        $this->hairSClolor = $hairSClolor;

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

    public function getWeigth(): ?int
    {
        return $this->weigth;
    }

    public function setWeigth(?int $weigth): self
    {
        $this->weigth = $weigth;

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

    public function getMostAttractiveInOneSelf(): ?string
    {
        return $this->mostAttractiveInOneSelf;
    }

    public function setMostAttractiveInOneSelf(?string $mostAttractiveInOneSelf): self
    {
        $this->mostAttractiveInOneSelf = $mostAttractiveInOneSelf;

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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCaracteristique($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCaracteristique() === $this) {
                $user->setCaracteristique(null);
            }
        }

        return $this;
    }
}
