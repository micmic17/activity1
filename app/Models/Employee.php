<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function scopeSearch($query, $request)
    {
        $employee = $query->join('companies','companies.id', 'employees.company_id')
                    ->orWhere('first_name', 'LIKE', '%' . $request['search_employee'] . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request['search_employee'] . '%')
                    ->orWhere('employees.email', 'LIKE', '%' . $request['search_employee'] . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request['search_employee'] . '%')
                    ->having('employees.company_id', '=', $company);

        return $employee->paginate(10);
    }
}