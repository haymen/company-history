<?php

namespace App\Company\Domain\LogHistory;

use App\Company\Infrastructure\AddressLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressLogRepository::class)]
class AddressLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $addressId = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $streetType = null;

    #[ORM\Column(length: 255)]
    private ?string $streetName = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column]
    private ?int $postalCode = null;

    #[ORM\Column]
    private ?\DateTime $createdAt;

    #[ORM\Column]
    private ?\DateTime $updatedAt;

    #[ORM\ManyToOne(targetEntity: CompanyLog::class, inversedBy: 'addressLog')]
    #[ORM\JoinColumn(name: "company_log_id", referencedColumnName: "id")]
    private CompanyLog $companyLog;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return AddressLog
     */
    public function setId(?int $id): AddressLog
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     *
     * @return AddressLog
     */
    public function setNumber(?int $number): AddressLog
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetType(): ?string
    {
        return $this->streetType;
    }

    /**
     * @param string|null $streetType
     *
     * @return AddressLog
     */
    public function setStreetType(?string $streetType): AddressLog
    {
        $this->streetType = $streetType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    /**
     * @param string|null $streetName
     *
     * @return AddressLog
     */
    public function setStreetName(?string $streetName): AddressLog
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     *
     * @return AddressLog
     */
    public function setCity(?string $city): AddressLog
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    /**
     * @param int|null $postalCode
     *
     * @return AddressLog
     */
    public function setPostalCode(?int $postalCode): AddressLog
    {
        $this->postalCode = $postalCode;

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
     * @return AddressLog
     */
    public function setCreatedAt(?\DateTime $createdAt): AddressLog
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
     * @return AddressLog
     */
    public function setUpdatedAt(?\DateTime $updatedAt): AddressLog
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return CompanyLog
     */
    public function getCompanyLog(): CompanyLog
    {
        return $this->companyLog;
    }

    /**
     * @param CompanyLog $companyLog
     *
     * @return AddressLog
     */
    public function setCompanyLog(CompanyLog $companyLog): AddressLog
    {
        $this->companyLog = $companyLog;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAddressId(): ?int
    {
        return $this->addressId;
    }

    /**
     * @param int|null $addressId
     *
     * @return AddressLog
     */
    public function setAddressId(?int $addressId): AddressLog
    {
        $this->addressId = $addressId;

        return $this;
    }


}