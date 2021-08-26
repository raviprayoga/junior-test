<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultiLang extends Model
{
    protected $table = 'multi_langs';
    protected $fillable = ['keys', 'english', 'indonesia']; 
}
