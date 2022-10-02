<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
class TransaksiOperasionalController extends Controller
{
    public function form()
    {
        return view('transaction.operasional.transaksi._form');
    }
    public function store(Request $request){
        // return response()->json($request->idmaster);
        // penangkapan nilai store
        // data disimpan ke dalam tabel transaksi_operasionals;
        // penggunaan rule
        $rules = [
            'bukti_bayar' => 'required|mimes:png,jpg,jpeg|max:2048',
        ];

        $this->validate($request,$rules);
        $price_total = Str::replace(['Rp.', '.'],'',$request->price_total);

        $price=[];
        foreach($request->price as $value){
            $price[]=$value;
        }

        $data=[
            'notransaksi'=>$request->master_transaksi_operasional_id,
            'master_transaksi_operasional_id'=>$request->idmaster,
            'price_total'=>$price_total,
            'description'=>$request->keterangan,
            'price'=>$request->price,
            'payment_method'=>$request->payment_method,
            'bukti_bayar'=>$request->bukti_bayar->getClientOriginalName(),
        ];
         dd($data);
        $hasil=Http::post('http://sargas.test/api/transaksi-operasional/store', $data);
        Alert::success('Notifikasi', 'Data berhasil disimpan');
         return back();

    }

    public function get_product()
    {
        $products = Http::get('http://sargas.test/api/products')['data'];
        return response()->json($products);
    }
    //untuk tampilkan data transaksi operasional
    public function show(){
        $data=Http::get('http://sargas.test/api/transaksi-operasional/index')['data'];
        return view('transaction.operasional.transaksi._list',compact('data'));
    }
    public function json(){
        $data=Http::get('http://sargas.test/api/transaksi-operasional/json')['data'];
        return $data;
    }
}
