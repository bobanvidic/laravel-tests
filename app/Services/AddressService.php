<?php

namespace App\Services;

use App\Models\Address;
use App\Repositories\AddressRepository;

class AddressService {

    /**
     * @var AddressRepository $addressRepository
     */
    protected $addressRepository;

    /**
     * @param AddressRepository $addressRepository
     */
    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->addressRepository->fetchAll();
    }

    /**
     * @return mixed
     */
    public function fetchCompanyAddresses()
    {
        return $this->addressRepository->fetchCompanyAddresses();
    }

    /**
     * @return mixed
     */
    public function fetchUserAddresses()
    {
        return $this->addressRepository->fetchUserAddresses();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $this->addressRepository->store($data);
    }

    /**
     * @param Address $address
     * @param array $data
     * @return void
     */
    public function update($address, $data)
    {
        $this->addressRepository->update($address, $data);
    }
}
