<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;

class CompanyController extends Controller {

    /**
     * @var CompanyService $companyService
     */
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->companyService->fetchAll();

        return response()->json($data,200);
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Company $company)
    {
        $data = [
            'address' => $company->address,
            'type' => $company->addressable_type,
            'id' => $company->addressable_id,
        ];
        return response()->json($data,200);
    }

    /**
     * @param CreateCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCompanyRequest $request)
    {
        $this->companyService->store($request->validated());
        return response()->json('Company is successfully created!',200);
    }

    /**
     * @param Company $company
     * @param UpdateCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Company $company, UpdateCompanyRequest $request)
    {
        $data = $request->validated();
        $response = $this->companyService->update($company, $data);
        return response()->json($response,200);
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Company $company)
    {
        $company->delete();
        return response()->json('Company is successfully deleted!',200);
    }
}
