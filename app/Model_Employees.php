<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model_Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = ['first_name','last_name','company_id','email','phone','created_by_id','updated_by_id'];

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
}
