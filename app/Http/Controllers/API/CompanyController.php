<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\Company as CompanyResource;
use App\Http\Controllers\API\JsonResponseController as JsonResponseController;
use Illuminate\Http\Request;

class CompanyController extends JsonResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = $request->has('search_company') ?
                        $this->search($request)->paginate(10) :
                        Company::paginate(10);
    
        return $this->successResponse(CompanyResource::collection($companies), 'Companies Retrieved');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCompanyRequest $request)
    {
        $storeImage = $request->has('logo') ?
                        storeImage($request->all()) :
                        $request->all();
 
        $company = Company::create($storeImage);

        return $this->successResponse(new CompanyResource($company), 'Company Successfully Stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return $this->successResponse(new CompanyResource($company), 'Companies Retrieved');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        return $this->successResponse(new CompanyResource($company), 'Companies Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return $this->successResponse([], 'Companies Retrieved');
    }
}