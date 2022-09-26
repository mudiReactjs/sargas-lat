<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterTransaksiOperasional;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
class TransaksiOperasionalController extends Controller
{
    //
    public function index()
    {
        $getData= Http::get('http://sargas.test/api/products')['data'];
        return view('transaction.operasional._form',compact('getData'));
    }
    public function index2(){

        // return 'ini untuk percobaan';
         return view('transaction.operasional.index');
    }
    public function form(){
          $mastertransaksioperasional = Http::get('http://sargas.test/api/master-transaksi-operasional')['data'];
          // dd($mastertransaksioperasional);
         return view('transaction.operasional.list',compact('mastertransaksioperasional'));
    }
    public function destroy($id){
        Http::delete('http://sargas.test/api/master-transaksi-operasional/'.$id);

        Alert::success('Notifikasi', 'Data berhasil dihapus');
        return back();
    }
    public function update(Request $request, $id)
    {
      $data=[
         'code'=>$request->kode_masteroperasional,
         'name'=>$request->nama_operasional,
         'product_id'=>$request->product_id,
      ];
      // dd($id);
      Http::patch('http://sargas.test/api/master-transaksi-operasional/'.$id, $data);

      Alert::success('Notifikasi', 'Data berhasil diupdate');
      return back();
    }
    public function store(Request $request)
    {
         $validator=Validator::make($request->all(),[
             'code' => 'required',
             'name' => 'required',
             'product_id'=>'required',
         ]);
         // return response()->json($request->all());

        if(!$validator->passes()){
           return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $data=[
                    'code'=>$request->code,
                    'name'=>$request->name,
                    'product_id'=>$request->product_id,
                 ];
                 Http::post('http://sargas.test/api/master-transaksi-operasional', $data);
                 Alert::success('Notifikasi', 'Data berhasil disimpan');
                 // return back();

                 // return response()->json($coba);
                // Alert::success('Notifikasi', 'Data berhasil disimpan');
        }
    }
}
