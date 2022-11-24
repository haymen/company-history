<?php

namespace App\Company\Domain;

use App\Company\Infrastructure\Doctrine\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[Gedmo\Loggable]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Versioned]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $siren = null;

    #[ORM\Column(length: 255)]
    private ?string $immatCity = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $immatDate;

    #[ORM\Column]
    private ?float $capital = null;

    #[ORM\Column]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTime $createdAt;

    #[ORM\Column(type: "datetime")]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTime $updatedAt;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Address::class, cascade: ["persist"])]
    private Collection $addresses;

    #[ORM\ManyToOne(targetEntity: LegalStatus::class)]
    private LegalStatus $legalStatus;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getImmatCity(): ?string
    {
        return $this->immatCity;
    }

    public function setImmatCity(string $immatCity): self
    {
        $this->immatCity = $immatCity;

        return $this;
    }

    public function getImmatDate(): ?\DateTime
    {
        return $this->immatDate;
    }

    public function setImmatDate(\DateTime $immatDate): self
    {
        $this->immatDate = $immatDate;

        return $this;
    }

    public function getCapital(): ?float
    {
        return $this->capital;
    }

    public function setCapital(float $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }


    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }


    /**
     * @return Collection
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        // if (!$this->addresses->contains($address)) {

        $this->addresses->add($address);
        $address->setCompany($this);

        // }

        return $this;
    }

    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * @return LegalStatus
     */
    public function getLegalStatus(): LegalStatus
    {
        return $this->legalStatus;
    }

    /**
     * @param LegalStatus $legalStatus
     */
    public function setLegalStatus(LegalStatus $legalStatus): void
    {
        $this->legalStatus = $legalStatus;
    }
}
