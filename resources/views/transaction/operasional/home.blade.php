@extends('layout.general')
@section('content')
<div class="main-page" style="padding-top: 50px;">
    <div class="row">
        <div class="col-md-4 r3_counter_box_hover">
            <div class="r3_counter_box">
                <a href="{{route('mto.index')}}" class="">
                    <i class="pull-left fa fa-dollar icon-rounded"></i>
                        <div class="stats">
                        <h5><strong>Master Transaksi Operasional</strong></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="r3_counter_box">
                <a href="{{route('to.form')}}">
                    <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Transaksi Operasional</strong></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="r3_counter_box">
                <a href="{{route('to.show')}}">
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
