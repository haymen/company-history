<?php

namespace UI\Http\Web\Controller;

use App\Company\Domain\Company;
use App\Company\Domain\LogHistory\CompanyLog;
use App\Company\Event\CompanyUpdateEvent;
use App\Company\Form\CompanyType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/company', name: 'company_')]
class CompanyController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    #[Route('/create/{id}', name: 'create')]
    public function create(Request $request, $id = null): Response
    {
        $newCompany = new Company();
        $companyLogList = [];
        if (!empty($id)) {
            $newCompany = $this->entityManager->getRepository(Company::class)->findOneBy(['id' => $id]);
            $companyLogList = $this->entityManager->getRepository(CompanyLog::class)->findBy(['companyId' => $id]);
        }

        $addressesCollection = new ArrayCollection();
        $addresses = $newCompany->getAddresses();
        foreach ($addresses as $address) {
            $addressesCollection->add($address);
        }

        $company_form = $this->createForm(CompanyType::class, $newCompany);
        $company_form->handleRequest($request);
        if ($company_form->isSubmitted() && $company_form->isValid()) {
            foreach ($addressesCollection as $addressesCollectionItem) {
                if (!$newCompany->getAddresses()->contains($addressesCollectionItem)) {
                    $this->entityManager->remove($addressesCollectionItem);
                }
            }

            $this->entityManager->persist($newCompany);
            $this->entityManager->flush();
            $event = new CompanyUpdateEvent($newCompany);
            $this->eventDispatcher->dispatch($event);

            return $this->redirectToRoute('company_index');
        }


        return $this->renderForm('company/create.html.twig', [
            'form' => $company_form,
            'companyLogList' => $companyLogList,
            'id' => $id,
        ]);
    }

    #[Route('/index', name: 'index')]
    public function index()
    {
        $companies = $this->entityManager->getRepository(Company::class)->findAll();

        return $this->render('company/index.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/history/{id}', name: 'history')]
    public function companyHistory($id)
    {
        $history = $this->entityManager->getRepository(CompanyLog::class)->findOneBy(['id' => $id]);

        return $this->render('company/company-history.html.twig', [
            'history' => $history,
        ]);
    }
}
