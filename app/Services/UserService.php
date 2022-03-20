<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService {

    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function fetchAll()
    {
        return $this->userRepository->fetchAll();
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $this->userRepository->store($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return void
     */
    public function update($user, $data)
    {
        $this->userRepository->update($user, $data);
    }
}
