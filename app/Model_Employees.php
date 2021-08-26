<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model_Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = ['first_name','last_name','company_id','email','phone','password','created_by_id','updated_by_id'];

    public function companies()
    {
        return $this->belongsTo('App\Model_Companies','company_id');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by_id', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by_id', 'id');
    }

    public function scopeFilter($query)
    {
        return $query
        ->where('first_name', 'LIKE', '%'.request('query').'%')
        ->orWhere('last_name', 'LIKE', '%'.request('query').'%')
        ->orWhere('company_id', 'LIKE', '%'.request('query').'%')
        ->orWhere('email', 'LIKE', '%'.request('query').'%')
        ->orWhere('phone', 'LIKE', '%'.request('query').'%')
        ->orWhere('created_at', 'LIKE', '%'.request('query').'%')
        ->orWhere('updated_at', 'LIKE', '%'.request('query').'%');
    }

    
}
