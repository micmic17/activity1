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
    public function show($id)
    {
        $company = Company::find($id);

        if ($company) {
            return $this->successResponse(new CompanyResource($company), 'Companies Retrieved');
        } else  return $this->errorResponse('', ['Company not found!'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::find($id);

        if ($company) {
            $storeImage = $request->all();

            if ($request->has('logo') && $company->logo != $request->file('logo')->getClientOriginalName())
                $storeImage = storeImage($request->all());
            else
                $storeImage['logo'] = $company->logo;
            
            $company->update($storeImage);

            return $this->successResponse(new CompanyResource($company), 'Companies Successfully Updated');
        } else  return $this->errorResponse('Update Failed', ['Company not found!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);

        if ($company) {
            $company->delete();
    
            return $this->successResponse([], 'Companies Retrieved');
        } else  return $this->errorResponse('Deleting Failed', ['Company not found!'], 404);
    }
}