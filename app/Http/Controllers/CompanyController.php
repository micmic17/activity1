<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCompanyRequest;

use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $storeImage = $this->storeImage($request);
 
        $company = Company::create($storeImage);

        return redirect()->to('company/' . $company->id)->with(['company']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
  
        return view('company.index', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
  
        return view('company.index', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        if ($request->image != null && $company->logo != $request->file('image')->getClientOriginalName())
            $storeImage = $this->storeImage($request);
        else
            $storeImage = $request->except(['image']);
        
        $company->update($storeImage);

        return view('company.index', compact('company'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id)->delete();

        return redirect('/home');
    }

    // Store image to storage:link
    protected function storeImage($request)
    {
        $file = $request->file('image');

        if ($file) {
            $path = $file->store('images');
            $request->request->add(['image_path' => str_replace('images/', '', $path)]);
            $request->request->add(['logo' => $file->getClientOriginalName()]);
        } else {
            $request->request->add(['image_path' => '']);
            $request->request->add(['logo' => '']);
        }

        return $request->except(['image']);
    }
}