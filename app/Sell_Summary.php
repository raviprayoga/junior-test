<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell_Summary extends Model
{
    protected $table = 'sell__summaries';
    protected $fillable = ['price_total', 'discount_total', 'total'];

    public function employe()
    {
        return $this->belongsTo('\App\Model_Employees', 'employe_id', 'id');
    }
    public function scopeFilter($query)
    {
        return $query
        ->where('created_at', 'LIKE', '%'.request('query').'%')
        ->orWhere('employe_id', 'LIKE', '%'.request('query').'%')
        ->orWhere('price_total', 'LIKE', '%'.request('query').'%')
        ->orWhere('discount_total', 'LIKE', '%'.request('query').'%')
        ->orWhere('total', 'LIKE', '%'.request('query').'%');
    }
}
