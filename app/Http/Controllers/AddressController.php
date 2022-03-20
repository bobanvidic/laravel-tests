<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Services\AddressService;
use Exception;

class AddressController extends Controller {

    /**
     * @var AddressService $addressService
     */
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $allAddresses = $this->addressService->fetchAll();
        $userAddresses = $this->addressService->fetchUserAddresses();
        $companyAddresses = $this->addressService->fetchCompanyAddresses();

        return response()->json([
            'allAddresses' => $allAddresses,
            'companyAddresses' => $companyAddresses,
            'userAddresses' => $userAddresses
        ],200);
    }

    /**
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Address $address)
    {
        $data = [
            'address' => $address->address,
            'type' => $address->addressable_type,
            'id' => $address->addressable_id,
        ];
        return response()->json($data,200);
    }

    /**
     * @param CreateAddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAddressRequest $request)
    {
        $this->addressService->store($request->validated());
        return response()->json('Address is successfully created!',200);
    }

    /**
     * @param Address $address
     * @param UpdateAddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Address $address, UpdateAddressRequest $request)
    {
        $data = $request->validated();
        $response = $this->addressService->update($address, $data);
        return response()->json($response,200);
    }

    /**
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Address $address)
    {
        $address->delete();
        return response()->json('Address is successfully deleted!',200);
    }
}
