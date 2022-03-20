<?php

namespace App\Services;

use App\Models\EmailAddress;
use App\Repositories\EmailAddressRepository;

class EmailAddressService {

    /**
     * @var EmailAddressRepository $emailAddressRepository
     */
    protected $emailAddressRepository;

    /**
     * @param EmailAddressRepository $emailAddressRepository
     */
    public function __construct(EmailAddressRepository $emailAddressRepository)
    {
        $this->emailAddressRepository = $emailAddressRepository;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->emailAddressRepository->fetchAll();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $this->emailAddressRepository->store($data);
    }

    /**
     * @param EmailAddress $email
     * @param array $data
     * @return void
     */
    public function update($email, $data)
    {
        $this->emailAddressRepository->update($email, $data);
    }
}
