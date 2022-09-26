@extends('layout.general')
@section('css')
<style>
    input.fishermen-qty {
        width: 48%;
        float: left;
    }
    input.fishermen-sack {
        width: 48%;
        float: right

    }
    input.form-control {
        border-radius: 5px;
    }
    select.form-control {
        border-radius: 5px;
    }
    .show-card .right img{
        width: 100%;
        border-radius: 5px;
    }
    .show-card .left p {
        font-size: 12pt;
        font-weight: 600;
    }
    .show-card .right {
        padding: 0;
    }
    .show-card .left {
        padding: 0;
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
<div class="main-page" style="padding: 10px">
    <div class="row">
        <div class="col-md-12" style="margin-top: 20px;">
           <div style="padding: 15px">
                <h3 class="mb-4" style="float: left">TRANSAKSI OPERASIONAL</h3>
                <a href="{{route('fishermen.index')}}" style="float: right" class="btn btn-warning">Kembali</a>
           </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-7">
                <div class="inline-form widget-shadow">
                    <div class="form-body">
                        <div data-example-id="simple-form-inline" style="margin-top: 15px">
                            <form action="" class=" mb-4" method="GET">
                                <div class="form-group" id="alertSuccess">

                                </div>
                                 
                                <div class="form-group">
                                    <div class="form-group form-select-transaction__product">
                                        <select name="product_id" class="form-control" id="product_id">
                                            <option value="">Produk</option>
                                            @foreach ($getData['content'] as $product)
                                                <option value="{{$product['id']}}">{{$product['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                           <div class="row">
                               <div id="getMasterOperasional">
                                
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="inline-form widget-shadow">
                    <div class="form-title mb-3" id="formTitle">
                        <h4>Transaksi Operasional</h4>
                    </div>
                    <div class="form-body">
                        <form enctype="multipart/form-data" method="POST" id="formDebt">
                            @csrf
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Kode Transaksi</label>
                                        <input type="text" value="TR.23/Sep/2022/23/50/21" class="form-control" disabled="">
                                    </div>
                                </div>

                                <div id="putMasterOperasional">
                                 </div>

                                <div id="putMasterOperasionalDetail">
                                   
                                 </div>

                                  <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="jumlahbayar" class="form-control" id="jumlahbayar" placeholder="Rp"> 
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="kode_masteroperasional" class="form-control" placeholder="Metode Bayar" value=""> 
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="kode_masteroperasional" class="form-control" placeholder="Bukti Bayar" value=""> 
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-10">
                                        <center>
                                            <a href="{{route('fishermen.index')}}" style="text-justify:center" class="btn btn-danger">Bayar</a>
                                        </center>
                                    </div>
                                  </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
  var nilaimaster=[];
  var gambarmaster=[];
  $(document).ready(function(){
    $('#product_id').on('change', function() {
        $.ajaxSetup({
            headers: {
                       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
           });
        var id= $(this).val();
        $.ajax({
             url:"{{route('masteroperasional.show')}}",
             type:'POST',
             data:{
                _token: "{{ csrf_token() }}",
                 id:id
                },
             success:function(response){
                var html="";
                nilaimaster=[];

                if(response.length>0){
                    for(let i=0;i<response.length;i++){
                        nilaimaster.push(response[i]['name']); //untuk menangkan nilai name
                        html +="<div class='col-md-4 mb-4'>\
                                  <div class='card list_name_card'>\
                                  <img onclick='selectmasteroperasional("+ i +") 'style='cursor: pointer' src='http://127.0.0.1:8000/uploads/fishermen/1663943756enemipng'>\
                                 </div>\
                                <div class='text-center list_name_card_title'>\
                                  <h4>"+ response[i]['name']+"</h4>\
                                    </div>\
                                </div>"
                    }
                }
                $('#getMasterOperasional').html(html);
             }
         });
    });
  });
   function selectmasteroperasional(id){ 
       // alert(nilaimaster[id]);
       // return;
       $('#putMasterOperasionalDetail').append(
          "<div id='getPer-"+id+"'></div>"
       );
       $('#getPer-'+id).html(
        "<div id='getPer-'"+id+">"+
          "<div class='row show-card'>"+
            "<div class='col-md-3 right'>"+
             "<input type='hidden' name='' value=''>"+
                    "<img src='http://127.0.0.1:8000/uploads/fishermen/1663943756enemipng'>"+nilaimaster[id]+
                "</div>"+
                        "<div class='col-md-9 left'>"+
                                "<div class='row'>"+
                                    "<div class='col-md-12'>"+
                                    "<i class='fa fa-close text-danger' style='float:right; cursor: pointer;'  id='close-"+ id +"'></i>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row'>"+
                                    "<div class='col-md-12'>"+
                                    "<input type='number' required='' name='qty[]' id='getInput-3' class='form-control' oninput='getQty(3)' placeholder='Nominal' value='0'>"+
                                    "</div>"+
                                "</div>"+
                                "<div class='row'>"+
                                    "<div class='col-md-12'>"+
                                    "<input type='text' required='' name='keterangan[]' class='form-control' placeholder='Keterangan'>"+
                                    "</div>"+
                                "</div>"+
                           "</div>"+
                       "</div>"+
            "<div class='clearfix'>"+ 
            "</div>"+
        "</div>"
       );
       $('#close-'+id).on('click', function() {
         $('#getPer-'+id).html("");
         let qty=[];
         $("input[name='qty[]']").each(function(){
                var getqty=$(this).val();
                qty.push(getqty);
            });

         let gtotal=0;
         for(let i=0;i<qty.length;i++){
             gtotal=gtotal+parseInt(qty[i]);
         }
        // alert(gtotal);
        $('#jumlahbayar').val(gtotal);
       });
   }
   function getQty(id){
     let qty=[];
     $("input[name='qty[]']").each(function(){
        var getqty=$(this).val();
        qty.push(getqty);
     });
     let gtotal=0;
     for(let i=0;i<qty.length;i++){
        gtotal=gtotal+parseInt(qty[i]);
     }
     // alert(gtotal);
     $('#jumlahbayar').val(gtotal);
   }
</script>

<script>

</script>
@endsection
