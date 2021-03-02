<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public static function search($request)
    {
        return  Employee::join('companies','companies.id','employees.company_id')
                    ->where('first_name', 'LIKE', '%' . $request['search_employee'] . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $request['search_employee'] . '%')
                    ->orWhere('employees.email', 'LIKE', '%' . $request['search_employee'] . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request['search_employee'] . '%') 
                    ->orWhere('companies.name', 'LIKE', '%' . $request['search_employee'] . '%')->get();
    }
}