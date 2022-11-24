<?php

namespace App\Company\Domain\LogHistory;

use App\Company\Infrastructure\Doctrine\CompanyLogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyLogRepository::class)]
class CompanyLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $companyId = null;

    #[ORM\Column(length: 255)]
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
    private ?\DateTime $createdAt;

    #[ORM\Column(type: "datetime")]
    private ?\DateTime $updatedAt;

    #[ORM\OneToMany(mappedBy: 'companyLog', targetEntity: AddressLog::class, cascade: ["persist"])]
    private Collection $addressLog;

    public function __construct()
    {
        $this->addressLog = new ArrayCollection();
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

    /**
     * @return string|null
     */
    public function getSiren(): ?string
    {
        return $this->siren;
    }

    /**
     * @param string|null $siren
     *
     * @return CompanyLog
     */
    public function setSiren(?string $siren): CompanyLog
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImmatCity(): ?string
    {
        return $this->immatCity;
    }

    /**
     * @param string|null $immatCity
     *
     * @return CompanyLog
     */
    public function setImmatCity(?string $immatCity): CompanyLog
    {
        $this->immatCity = $immatCity;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getImmatDate(): ?\DateTime
    {
        return $this->immatDate;
    }

    /**
     * @param \DateTime|null $immatDate
     *
     * @return CompanyLog
     */
    public function setImmatDate(?\DateTime $immatDate): CompanyLog
    {
        $this->immatDate = $immatDate;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getCapital(): ?float
    {
        return $this->capital;
    }

    /**
     * @param float|null $capital
     *
     * @return CompanyLog
     */
    public function setCapital(?float $capital): CompanyLog
    {
        $this->capital = $capital;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     *
     * @return CompanyLog
     */
    public function setCreatedAt(?\DateTime $createdAt): CompanyLog
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     *
     * @return CompanyLog
     */
    public function setUpdatedAt(?\DateTime $updatedAt): CompanyLog
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAddressLog(): Collection
    {
        return $this->addressLog;
    }

    /**
     * @param Collection $addressLog
     *
     * @return CompanyLog
     */
    public function setAddressLog(Collection $addressLog): CompanyLog
    {
        $this->addressLog = $addressLog;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    /**
     * @param int|null $companyId
     *
     * @return CompanyLog
     */
    public function setCompanyId(?int $companyId): CompanyLog
    {
        $this->companyId = $companyId;

        return $this;
    }


}