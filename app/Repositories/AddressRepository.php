<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Query\Builder;

class AddressRepository
{
    /**
     * @var Address $model
     */
    protected Address $model;

    /**
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->model = $address;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->model->all();
    }

    /**
     * @return void
     */
    public function fetchCompanyAddresses()
    {
        return $this->model->where('addressable_type', Company::class)->get();
    }

    /**
     * @return void
     */
    public function fetchUserAddresses()
    {
        return $this->model->where('addressable_type', User::class)->get();
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
     * @param Address $address
     * @param array $data
     * @return mixed
     */
    public function update($address, $data)
    {
        $address->update($data);
    }
}
