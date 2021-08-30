<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = ['name', 'price'];

    public function scopeFilter($query)
    {
        return $query
        ->where('name', 'LIKE', '%'.request('query').'%')
        ->orWhere('price', 'LIKE', '%'.request('query').'%')
        ->orWhere('created_at', 'LIKE', '%'.request('query').'%')
        ->orWhere('updated_at', 'LIKE', '%'.request('query').'%');
    }
}
