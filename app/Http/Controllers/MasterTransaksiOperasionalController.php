<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterTransaksiOperasional;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
class MasterTransaksiOperasionalController extends Controller
{
    //
    public function index()
    {
        return view('transaction.index');
    }
    public function index2(){

        // return 'ini untuk percobaan';
         return view('transaction.operasional.index');
    }
    public function form(){
          $getData = Http::get('http://sargas.test/api/products')['data'];
          // dd($products);
          $mastertransaksioperasional = Http::get('http://sargas.test/api/master-transaksi-operasional')['data'];
          // dd($mastertransaksioperasional);
         return view('transaction.operasional.list',compact('mastertransaksioperasional','getData'));
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
    public function show(Request $request){
        $id=$request->id;
        $data=Http::get('http://sargas.test/api/master-transaksi-operasional/'.$id)['data'];  
         return response()->json($data);
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
