<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Model_Companies extends Model
{
    protected $table     = 'companies';
    protected $fillable  = ['name','email','logo','website','created_by_id','updated_by_id','created_at'];
    // protected $dates = ['created_at'];

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

    public function scopeFilter($query)
    {
        return $query
        ->where('name', 'LIKE', '%'.request('query').'%')
        ->orWhere('email', 'LIKE', '%'.request('query').'%')
        ->orWhere('logo', 'LIKE', '%'.request('query').'%')
        ->orWhere('created_at', 'LIKE', '%'.request('query').'%')
        ->orWhere('updated_at', 'LIKE', '%'.request('query').'%');  
    }

    // accesor
    // public function getCreatedAtAttribute($value)
    // {
    //     $current = Carbon::parse($value);
    //     $time = $current->addHours(7)->format('Y-m-d H:i');
        
    //     return $time;
    // }

    public function getAsiaAttribute($value)
    {
        $time = $this->created_at;
        $current = Carbon::parse($time);
        $times = $current->addHours(7)->format('Y-m-d H:i');
        return $times;
    }
    public function getAmerikaAttribute($value)
    {
        $time = $this->created_at;
        $current = Carbon::parse($time);
        $times = $current->addHours(-4)->format('Y-m-d H:i');
        return $times;
    }
    public function getArabAttribute($value)
    {
        $time = $this->created_at;
        $current = Carbon::parse($time);
        $times = $current->addHours(3)->format('Y-m-d H:i');
        return $times;
    }
}
