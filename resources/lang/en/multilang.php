<?php

    use Illuminate\Support\Facades\DB;

    $langs = DB::table('multi_langs')->select('key', 'english')->get();
    $output = array();
    foreach ($langs as $lang){
        $output[$lang->key] =$lang->english;
    }
    return $output;
    
?>