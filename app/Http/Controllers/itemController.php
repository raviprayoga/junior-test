<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class itemController extends Controller
{
    public function getItem(Request $request)
    {
        $paged = $request->paged;
        $items = Item::orderBy('created_at', 'desc')->filter(request('query'))->paginate($paged)->withQueryString();

        return view('content.items', compact('items', 'paged'));
    }
    public function proses_upload_items(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
        ]);

        $items = new \App\Item;
        $items->name = $request->name;
        $items->price = $request->price;
        $items->save();

        return redirect()->back()->with('success', 'Items Telah Diinputkan');
    }
    public function itemDelete($id)
    {
        Item::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data telah terhapus');
    }
    public function editItems(Request $request, $id)
    {
        if($request->isMethod('post')){
            $items = $request->all();
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required',
            ]);
            // dd($request);

            Item::where(['id'=>$id])
            ->update([
                'name'=>$items['name'], 
                'price'=>$items['price']
            ]);
            return redirect()->back()->with('success', 'Data Telah di Update');
        }
    }
}
