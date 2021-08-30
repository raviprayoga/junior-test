<?php

namespace App\Http\Controllers;

use App\Item;
use App\Model_Employees;
use App\Sell;
use App\Sell_Summary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sellController extends Controller
{
    public function getSells(Request $request)
    {
        $paged = $request->paged;
        $sells = Sell::orderBy('created_at','desc')->filter(request('query'))->paginate($paged)->withQueryString();
        $employe = Model_Employees::get();
        $items = Item::get();
        return view('content.sell', compact('sells', 'employe', 'items', 'paged'));
    }
    public function proses_upload_sells(Request $request)
    {  
        $this->validate($request,[
            'discount' => 'required',
            'employe_id' => 'required',
            'item_id' => 'required',
        ]);
        $items = Item::where('id', $request->item_id)->first();
        // dd($items);
        // $total_discount = $items->price * ($request->discount / 100);
        $total = $items->price;

        $harga = $items->price * ($request->discount / 100);
        $harga_after_discount = $items->price - $harga;
        // dd($total);

        $sells = new \App\Sell;
        $sells->price = $harga_after_discount;
        $sells->discount = $request->discount;
        $sells->employe_id = $request->employe_id;
        $sells->item_id = $request->item_id;
        // $sells->save();
        if($sells->save()){
            $summary = Sell_Summary::where('employe_id', $request->employe_id)
            ->whereDate('created_at', Carbon::today())->first();
            if($summary){
                $summary->employe_id = $request->employe_id;
                $summary->price_total += $sells->price;
                $summary->discount_total += $sells->discount;
                // $summary->total += $sells->price;
                $summary->total += $total;
                $summary->update();
            }else{
                $summary = new \App\Sell_Summary;
                $summary->employe_id = $request->employe_id;
                $summary->price_total += $sells->price;
                $summary->discount_total += $sells->discount;
                // $summary->total += $sells->price;
                $summary->total += $total;
                $summary->save();
            }
        }

        return redirect()->back()->with('success', 'Data Sells Berhasil Ditambah', compact('summary'));
    }
    public function sellsDelete($id)
    {
        Sell::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Sells Telah Dihapus');
    }
    public function editSells(Request $request,$id)
    {
        
        if($request->isMethod('post')){
            $sells = $request->all();
            $items = Item::where('id', $request->item_id)->first();
            
            $this->validate($request, [
                'discount' => 'required',
                'employe_id' => 'required',
                'item_id' => 'required',
            ]);
            // dd($items);
            
            Sell::where(['id'=>$id])
            ->update([
                'discount' =>$sells['discount'],
                'employe_id'=>$sells['employe_id'],
                'item_id' => $sells['item_id'],
                'price' => $items['price']
            ]);

            
            return redirect()->back()->with('success', 'Data Telah di Update');
        }
    }
    // sell summarys
    public function getSellSummarys(Request $request)
    {
        $paged = $request->paged;
        $summary = Sell_Summary::orderBy('created_at', 'desc')
        ->filter(request('query'))
        ->paginate($paged)
        ->withQueryString();
        return view('content.sell_summary', compact('summary', 'paged'));
    }

    // detail
    public function getDetail(Request $request,$id)
    {
        $paged = $request->paged;
        $sells = Sell::where('employe_id', $id)
        ->paginate($paged)
        ->withQueryString();
        // dd($sells);
        return view('content.detail', compact( 'sells', 'paged', 'id'));
    }
}
