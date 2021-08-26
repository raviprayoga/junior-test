<?php

    use Illuminate\Support\Facades\DB;

    $langs = DB::table('multi_langs')->select('key', 'indonesia')->get();
    $output = array();
    foreach ($langs as $lang){
        $output[$lang->key] =$lang->indonesia;
    }
    return $output;
    
?>