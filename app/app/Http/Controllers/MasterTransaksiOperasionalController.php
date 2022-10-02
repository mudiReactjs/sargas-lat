<?php

namespace App\Http\Controllers;
use App\Models\MasterTransaksiOperasional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class MasterTransaksiOperasionalController extends Controller
{
    public function home()
    {
        return view('transaction.operasional.home');
    }

    public function index()
    {
        // mto -> master transaksi operasional
        $mto = Http::get('http://sargas.test/api/master-transaksi-operasional')['data'];
        $products = Http::get('http://sargas.test/api/products')['data'];
        return view('transaction.operasional.master.list', compact('mto', 'products'));
    }
    public function get_mto(){
       // mto->master transaksi operasional
       // $mto = Http::get('http://sargas.test/api/master-transaksi-operasional')['data'];
       $mto=MasterTransaksiOperasional::select('code','name','product_id')->get();
       return response()->json($mto);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:master_transaksi_operasionals|max:100',
            'name' => 'required|max:100',
            'product_id' => 'required'
        ]);

        Http::post('http://sargas.test/api/master-transaksi-operasional', $request->all());
        Alert::success('Notifikasi', 'Data berhasil disimpan');
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'product_id' => 'required'
        ]);

        Http::patch('http://sargas.test/api/master-transaksi-operasional/'.$id, $request->all());

        Alert::success('Notifikasi', 'Data berhasil diupdate');
        return back();

    }

    public function destroy($id)
    {
        Http::delete('http://sargas.test/api/master-transaksi-operasional/'.$id);
        Alert::success('Notifikasi', 'Data berhasil dihapus');
        return back();
    }
}
