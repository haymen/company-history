<?php

namespace App\Company\Event;

use App\Company\Domain\Company;
use Symfony\Contracts\EventDispatcher\Event;

class CompanyUpdateEvent extends Event
{
    public const NAME = 'company.updated';
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }


}