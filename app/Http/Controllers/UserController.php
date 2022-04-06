<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
//use App\Mail\Mail;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    /**
     * @var UserService $userService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->userService->fetchAll();
        return response()->json($data,200);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function edit(User $user)
    {
        return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'company' => $user->company->name,
        ],200);
    }

    /**
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $this->userService->store($request->validated());
        return response()->json('User is successfully created!',200);
    }

    /**
     * @param User $user
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $this->userService->update($user, $request->validated());
        return response()->json('User is successfully updated!',200);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function delete(User $user)
    {
        $user->delete();
        return response()->json('User is successfully deleted!',200);
    }

    /**
     * @return void
     */
    public function sendEmail()
    {
        Mail::to('test@gmail.com')->send(new WelcomeMail());
    }
}
