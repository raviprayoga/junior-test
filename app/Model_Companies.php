<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model_Companies extends Model
{
    protected $table     = 'companies';
    protected $fillable  = ['name','email','logo'];

    public function employees()
    {
        return $this->hasMany(Model_Employees::class);
    }
}
