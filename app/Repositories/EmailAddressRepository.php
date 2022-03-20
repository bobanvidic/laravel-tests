<?php

namespace App\Repositories;

use App\Models\EmailAddress;

class EmailAddressRepository {

    /**
     * @var EmailAddress $modal
     */
    protected EmailAddress $model;

    /**
     * @param EmailAddress $emailAddress
     */
    public function __construct(EmailAddress $emailAddress)
    {
        $this->model = $emailAddress;
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
     * @param EmailAddress $emailAddress
     * @param array $data
     * @return mixed
     */
    public function update(EmailAddress $emailAddress, array $data)
    {
        return $emailAddress->update($data);
    }

}
