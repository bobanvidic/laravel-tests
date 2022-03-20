<?php

namespace App\Services;

use App\Models\PhoneNumber;
use App\Repositories\PhoneNumberRepository;

class PhoneNumberService {

    /**
     * @var PhoneNumberRepository $phoneNumberRepository
     */
    protected $phoneNumberRepository;

    /**
     * @param PhoneNumberRepository $phoneNumberRepository
     */
    public function __construct(PhoneNumberRepository $phoneNumberRepository)
    {
        $this->phoneNumberRepository = $phoneNumberRepository;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->phoneNumberRepository->fetchAll();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $this->phoneNumberRepository->store($data);
    }

    /**
     * @param PhoneNumber $phone
     * @param array $data
     * @return void
     */
    public function update($phone, $data)
    {
        $this->phoneNumberRepository->update($phone, $data);
    }
}
