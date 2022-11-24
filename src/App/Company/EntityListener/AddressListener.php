<?php

namespace App\Company\EntityListener;

use App\Company\Domain\Address;
use App\Company\Domain\LogHistory\AddressLog;
use App\Company\Domain\LogHistory\CompanyLog;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class AddressListener
{
    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    public function postUpdate(Address $address, LifecycleEventArgs $event): void
    {
        $addressLog = new AddressLog();

        $addressLog->setCreatedAt(new \DateTime())
            ->setPostalCode($address->getPostalCode())
            ->setCity($address->getCity())
            ->setStreetType($address->getStreetType())
            ->setStreetName($address->getStreetName())
            ->setNumber($address->getNumber())
            ->setUpdatedAt($address->getUpdatedAt())
            ->setAddressId($address->getId());

        $this->entityManager->persist($addressLog);
        $this->entityManager->flush();

//        $company = $address->getCompany();
//        $companyLog = (new CompanyLog())->setCreatedAt()

//        dump($address);
//        $this->entityManager->persist($addressLog);
//        $this->entityManager->flush();
//        if($company instanceof Company){
//
//        }
    }
}