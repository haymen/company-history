<?php

namespace App\Company\Infrastructure\EventSubscriber;

use App\Company\Domain\Address;
use App\Company\Domain\LogHistory\AddressLog;
use App\Company\Domain\LogHistory\CompanyLog;
use App\Company\Event\CompanyUpdateEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CompanySubscriber implements EventSubscriberInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            CompanyUpdateEvent::class => 'onCompanyUpdated',
        ];
    }

    public function onCompanyUpdated(CompanyUpdateEvent $companyUpdateEvent)
    {
        $currentDateTime = new \DateTime();
        $company = $companyUpdateEvent->getCompany();
        $companyLog = (new CompanyLog())->setCreatedAt($company->getCreatedAt())
            ->setUpdatedAt($currentDateTime)
            ->setName($company->getName())
            ->setCapital($company->getCapital())
            ->setCompanyId($company->getId())
            ->setImmatCity($company->getImmatCity())
            ->setImmatDate($company->getImmatDate())
            ->setSiren($company->getSiren());
        $addresses = $company->getAddresses();
        foreach ($addresses as $address) {
            /** @var Address $address */
            $addressLog = (new AddressLog())->setCreatedAt($address->getCreatedAt())
                ->setUpdatedAt($currentDateTime)
                ->setAddressId($address->getId())
                ->setNumber($address->getNumber())
                ->setStreetName($address->getStreetName())
                ->setStreetType($address->getStreetType())
                ->setCity($address->getCity())
                ->setPostalCode($address->getPostalCode());
            $addressLog->setCompanyLog($companyLog);
            $this->entityManager->persist($addressLog);
        }
        $this->entityManager->persist($companyLog);
        $this->entityManager->flush();
    }
}