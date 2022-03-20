<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\User;

class CompanyRepository
{

    /**
     * @var Company $model
     */
    protected Company $model;

    /**
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->model->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        $this->model->create($data);
    }

    /**
     * @param Company $company
     * @param array $data
     * @return mixed
     */
    public function update($company, $data)
    {
        $company->update($data);
    }
}
