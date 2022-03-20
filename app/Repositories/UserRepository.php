<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    /**
     * @var User $model
     */
    protected User $model;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
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
     * @param User $user
     * @param array $data
     * @return mixed
     */
    public function update($user, $data)
    {
        $user->update($data);
    }
}
