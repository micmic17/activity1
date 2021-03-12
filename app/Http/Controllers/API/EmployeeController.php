<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee as EmployeeResource;
use App\Http\Controllers\API\JsonResponseController as JsonResponseController;

class EmployeeController extends JsonResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = $request->has('search_employee') ?
                        $this->search($request)->paginate(10) :
                        Employee::paginate(10);

        return $this->successResponse(EmployeeResource::collection($employees), 'Employees Retrieved');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->all());

        return $this->successResponse(new EmployeeResource($employee), 'Employees Retrieved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            return $this->successResponse(new EmployeeResource($employee), 'Employee Retrieved');
        } else  return $this->errorResponse('', ['Employee not found!'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->update($request->all());

            return $this->successResponse(new EmployeeResource($employee), 'Employees updated successfully');
        } else  return $this->errorResponse('Update Failed', ['Employee not found!'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if ($employee) {
            $employee->delete();

            return $this->successResponse(new EmployeeResource($employee), 'Employees deleted successfully');
        } else  return $this->errorResponse('Deleting Failed', ['Employee not found!'], 404);
    }
}