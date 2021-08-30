<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Sell extends Model
{
    protected $table = 'sells';
    protected $fillable = ['price', 'discount'];

    public function employe()
    {
        return $this->belongsTo('App\Model_Employees','employe_id', 'id');
    }
    public function items()
    {
        return $this->belongsTo('App\Item', 'item_id', 'id');
    }
    public function scopeFilter($query)
    {
        return $query
        ->where('price', 'LIKE', '%'.request('query').'%')
        ->orWhere('discount', 'LIKE', '%'.request('query').'%')
        ->orWhere('item_id', 'LIKE', '%'.request('query').'%')
        ->orWhere('employe_id', 'LIKE', '%'.request('query').'%')
        ->orWhere('created_at', 'LIKE', '%'.request('query').'%');
    }
}
