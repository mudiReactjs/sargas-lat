@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-3 r3_counter_box_hover">
            <div class="r3_counter_box">
                <a href="{{route('operasional.form')}}" class="">
                    <i class="pull-left fa fa-dollar icon-rounded"></i>
                        <div class="stats">
                        <h5><strong>Master Transaksi Operasional</strong></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <a href="{{route('transoperasional.index')}}">
                    <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Transaksi Operasional</strong></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="r3_counter_box">
                <a href="{{route('purchase.success')}}">
                    <i class="pull-left fa fa-money user2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Data Transaksi Operasional</strong></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
@endsection
