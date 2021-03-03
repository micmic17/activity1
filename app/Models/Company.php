<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'image_path',
        'website'
    ];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }

    public function scopeSearch($query, $request)
    {
        return $query->orWhere('name', 'LIKE', '%' . $request['search_company'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $request['search_company'] . '%')
                    ->orWhere('website', 'LIKE', '%' . $request['search_company'] . '%');
    }
}