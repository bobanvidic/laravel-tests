<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhoneNumberRequest;
use App\Http\Requests\UpdatePhoneNumberRequest;
use App\Models\PhoneNumber;
use App\Services\PhoneNumberService;
use Exception;

class PhoneNumberController extends Controller {

    /**
     * @var PhoneNumberService $phoneService
     */
    protected $phoneService;

    public function __construct(PhoneNumberService $phoneService)
    {
        $this->phoneService = $phoneService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->phoneService->fetchAll();

        return response()->json($data,200);
    }

    /**
     * @param PhoneNumber $phone
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(PhoneNumber $phone)
    {
        $data = [
            'phone' => $phone->phone,
            'type' => $phone->phonenumberable_type,
            'id' => $phone->phonenumberable_id,
        ];
        return response()->json($data,200);
    }

    /**
     * @param CreatePhoneNumberRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreatePhoneNumberRequest $request)
    {
        $this->phoneService->store($request->validated());
        return response()->json('PhoneNumber is successfully created!',200);
    }

    /**
     * @param PhoneNumber $phone
     * @param UpdatePhoneNumberRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PhoneNumber $phone, UpdatePhoneNumberRequest $request)
    {
        $data = $request->validated();
        $response = $this->phoneService->update($phone, $data);
        return response()->json($response,200);
    }

    /**
     * @param PhoneNumber $phone
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(PhoneNumber $phone)
    {
        $phone->delete();
        return response()->json('PhoneNumber is successfully deleted!',200);
    }
}
