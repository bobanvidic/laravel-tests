<?php

namespace App\Repositories;

use App\Models\PhoneNumber;

class PhoneNumberRepository {

    /**
     * @var PhoneNumber $model
     */
    protected PhoneNumber $model;

    /**
     * @param PhoneNumber $phone
     */
    public function __construct(PhoneNumber $phone)
    {
        $this->model = $phone;
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
        return $this->model->create($data);
    }

    /**
     * @param PhoneNumber $phone
     * @param array $data
     * @return mixed
     */
    public function update(PhoneNumber $phone, array $data)
    {
        return $phone->update($data);
    }
}
