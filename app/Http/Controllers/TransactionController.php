<?php

namespace App\Http\Controllers;
use App\Models\Transactionoperational;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index');
    }
    public function index2(){
        return view('transaction.operasional.index');
    }
    public function form(){
        return view('transaction.operasional.list');
    }
    public function store(Request $request)
    {
        // untuk dapat ini...
         // return response()->json($request->all());

         $validator=Validator::make($request->all(),[
             'code' => 'required',
             'name' => 'required',
         ]);
        if(!$validator->passes()){
           return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $data=[
                    'code'=>$request->code,
                    'name'=>$request->name,
                 ];
                 $ini_untukdata=json_encode($data);
                 return response()->json($data);
                 // Alert::success('Notifikasi', 'Data berhasil disimpan'.$ini_untukdata);
        }
        // $kode_operasional=$request->kd_operasional;
        // $nama_operasional=$request->nama_operasional;
        // $data=[
        //    'kd_operasional'=>$kode_operasional,
        //    'nama_operasional'=>$nama_operasional,
        // ];
        // $ini_untukdata=json_encode($data);
        // // Alert::success('Notifikasi', 'Data berhasil disimpan'.$ini_untukdata);
        // return response()->JSON('ini untuk cekku saja');
    }
}
