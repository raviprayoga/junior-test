<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Model_Companies extends Model
{
    protected $table     = 'companies';
    protected $fillable  = ['name','email','logo','created_by_id','updated_by_id','created_at'];
    
    // protected $timestamps = false;
    // protected $dateFormat = 'U';

    public function employees()
    {
        return $this->hasMany(Model_Employees::class);
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by_id', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by_id', 'id');
    }

    // accesor
    public function getCreatedAtAttribute($value)
    {
        $current = Carbon::parse($value);
        $trialExpires = $current->format('H:i');
        if($value === "2021-08-13 09:10:23"){
            $trialExpires = $current->addHours(7)->format('H:i');
        }
        return $trialExpires;
        // return "{$this->$}";
    }
}
