<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailAddressRequest;
use App\Http\Requests\UpdateEmailAddressRequest;
use App\Models\EmailAddress;
use App\Services\EmailAddressService;
use Exception;

class EmailAddressController extends Controller {

    /**
     * @var EmailAddressService $emailAddressService
     */
    protected $emailAddressService;

    public function __construct(EmailAddressService $emailAddressService)
    {
        $this->emailAddressService = $emailAddressService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->emailAddressService->fetchAll();

        return response()->json($data,200);
    }

    /**
     * @param EmailAddress $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(EmailAddress $email)
    {
        $data = [
            'address' => $email->address,
            'type' => $email->emailaddressable_type,
            'id' => $email->emailaddressable_id,
        ];
        return response()->json($data,200);
    }

    /**
     * @param CreateEmailAddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEmailAddressRequest $request)
    {
        $this->emailAddressService->store($request->validated());
        return response()->json('EmailAddress is successfully created!',200);
    }

    /**
     * @param EmailAddress $email
     * @param UpdateEmailAddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmailAddress $email, UpdateEmailAddressRequest $request)
    {
        $data = $request->validated();
        $response = $this->emailAddressService->update($email, $data);
        return response()->json($response,200);
    }

    /**
     * @param EmailAddress $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(EmailAddress $email)
    {
        $email->delete();
        return response()->json('EmailAddress is successfully deleted!',200);
    }
}
