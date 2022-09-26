@extends('layout.general')
@section('css')
<style>
    .btn-warning {
    color: #fff;
    border-color: #357ebd; /*set the color you want here*/
}
  .btn-warning:hover{
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  transform: translateY(-7px);
}
  .btn-primary:hover{
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  transform: translateY(-7px);
}
  .btn-success:hover{
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  transform: translateY(-7px);
}
  .btn-danger:hover{
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4);
  color: #fff;
  transform: translateY(-7px);
}

</style>
@endsection
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4" style="float: left">Master Transaksi Operasional</h3>
            <a class="btn btn-warning" href="{{route('tr.index2')}}" style="float: right">Kembali</a>
        </div>
        <div class="col-md-12">
            <div class="tables">
                <div class="bs-example widget-shadow" data-example-id="bordered-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <tr>
                                    <th colspan="7" class="text-right">
                                        <a href="" class="btn btn-primary" id="tambah" data-toggle="modal" data-target="#tambahModal">Tambah</a>
                                    </th>
                                </tr>
                                <th>Kode Master</th>
                                <th>Nama Master</th>
                                <th>Product Id</th>
                                {{-- <th class="text-center">Kasbon</th>
                                <th class="text-center">Karung</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                           
                            @foreach ($mastertransaksioperasional['data'] as $result)
                            <tr>
                                <td>{{$result['code']}}</td>
                                <td>{{$result['name']}}</td>
                                <td>{{$result['product_id']}}</td>
                                <td>
                                    <center>
                                        <form action="{{route('masteroperasional.destroy', $result['id'])}}" method="POST">
                                            <a href="#"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-{{$result['id']}}">Edit</a>
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </center>
                                </td>
                           
                           
                            <!--untuk modal-->
                            <div class="modal fade" id="edit-{{$result['id']}}"  role="dialog" aria-labelledby="gridSystemModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="gridSystemModalLabel">Edit Master Transaksi Operasional</h4>
                                        </div>
                                        <form action="{{route('masteroperasional.update', $result['id'])}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Kode Master Operasional</label>
                                                    <input type="text" name="kode_masteroperasional" class="form-control" placeholder="Kode Master Operasional" value="{{$result['code']}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-3">Nama Operasional</label>
                                                    <input type="text" name="nama_operasional" class="form-control" placeholder="Nama Operasionals" value="{{$result['name']}}">
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group form-select-transaction__product">
                                                        <select name="product_id" class="form-control" id="">
                                                            @foreach ($getData['content'] as $product)
                                                                <option value="{{$product['id']}}">{{$product['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success" id="simpan_update">Update</button>
                                                </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                            </tr>
                            @endforeach
                            <!--  akhir untuk modal -->
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <span class="text-center">

                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahModal" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Tambah Master Transaksi Operasional</h4>
                </div>
                <form action="{{route('masteroperasional.store')}}" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="mb-3">Kode Operasional</label>
                            <input type="text" id="kd_operasional" name="kd_operasional" class="form-control" placeholder="Kode Operasional" value="">
                             
                        </div>
                        <div class="form-group">
                            <label for="" class="mb-3">Nama Operasional</label>
                            <input type="text" id="nama_operasional" name="nama_operasional" class="form-control" placeholder="Nama Operasional" value="">
                            
                        </div>
                        <div class="form-group">
                            <div class="form-group form-select-transaction__product">
                                <select name="product_id" class="form-control" id="">
                                    @foreach ($getData['content'] as $product)
                                        <option value="{{$product['id']}}">{{$product['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="tutupModal" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="simpanData">Save</button>
                        </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function(){
        // // untuk datanya
        // $('#tambah').on('click',function(){
        //     $('#kd_operasional').val('');
        //     $('#nama_operasional').val('');
        //     $('#product_id').val('');
        //     $(document).find('span.error-text').text('');
        //     $('#tambahModal').modal('show');
        // });
        //  $('#tutupModal').on('click',function(){
        //    $('#tambahModal').modal('hide');
        //  });
        //  $('#simpanData').on('click',function(e){
        //     // e.preventDefault();
        //     $.ajaxSetup({
        //           headers: {
        //               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //           }
        //       });

        //      var kode_masteroperasional=$('#kd_operasional').val();
        //      var nama_operasional=$('#nama_operasional').val();
        //      var product_id=$('#product_id').val();
        //      $.ajax({
        //          url: "{{route('masteroperasional.store')}}" ,
        //          type:"POST",
        //          data:{
        //             _token: "{{ csrf_token() }}",
        //             code: kode_masteroperasional,
        //             name: nama_operasional,
        //             product_id:product_id,
        //          },
        //          success:function(data){
        //              // alert(JSON.stringify(data))
        //              if(data.status==0){
        //                  $.each(data.error,function(prefix,val)
        //                  {
        //                      // alert('span '+prefix+'-error');
        //                      $('span.'+prefix+'-error').text(val[0]);
        //                  });
        //              }else{
        //                 $('#tambahModal').modal('hide');
        //                 window.location.replace("http://127.0.0.1:8000/dashboard/transactionsoperasional/transactionoperasional");

        //              }
        //              //$ (document).find('span.error-text kd_operasional-error').text('salah');
        //          }
        //      });
        //  });
         //ini untuk edit ya..
    
        // ini untuk perintah update
    })
</script>
@endsection

