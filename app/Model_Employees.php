<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model_Employees extends Model
{
    protected $table = 'employees';
    protected $fillable = ['first_name','last_name','company_id','email','phone'];

    public function companies()
    {
        return $this->belongsTo('App\Model_Companies','company_id');
    }
}
