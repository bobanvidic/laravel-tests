<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;

class CompanyService {

    /**
     * @var CompanyRepository $companyRepository
     */
    protected $companyRepository;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->companyRepository->fetchAll();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $this->companyRepository->store($data);
    }

    /**
     * @param Company $company
     * @param array $data
     * @return void
     */
    public function update($company, $data)
    {
        $this->companyRepository->update($company, $data);
    }
}
