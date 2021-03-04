<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

use App\Models\Company;
use App\Models\Employee;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
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
    
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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

        return redirect()->to('company/' . $company->id)->with(['company']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Company $company)
    {
        $employees = $this->searchEmployees($request, $company);

        return view('company.show', compact('company', 'employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.show', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $storeImage = $request->all();
  
        if ($request->has('logo') && $company->logo != $request->file('logo')->getClientOriginalName())
            $storeImage = storeImage($request->all());
        else
            $storeImage['logo'] = $company->logo;
        
        $company->update($storeImage);

        return redirect()->to('company/' . $company->id)->with(['company']);
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

        return redirect('/home');
    }

    public function search(Request $request)
    {
        return Company::search($request->all());
    }

    protected function searchEmployees($request, $company)
    {
        $employee = $company->employees()->paginate(10);
 
        if ($request->has('search_employee')) {
            $employee = Employee::search($request)->paginate(10);
            $employee->appends(['search_employee' => $request->search_employee]);
        }

        return $employee;
    }
}