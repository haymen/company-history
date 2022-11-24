<?php

namespace App\Company\EntityListener;

use App\Company\Domain\Company;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CompanyListener
{
    public function postUpdate(Company $company, LifecycleEventArgs $event): void
    {

    }
}