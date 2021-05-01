@extends('adminlte::page')

@section('title', 'Pengelolaan Barang')

@section('content_header')
    <h1>Pengelolaan Barang</h1>
@stop

@section('content')
<div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$users}}</h3>

                <p> User</p>
                </div>
                <div class="icon">
                <i class="fas fa-user"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$products}}</h3>

                <p>Pengelolaan Barang</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$categories}}</h3>

                <p>Kategori</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$brands}}</h3>

                <p>Merek</p>
                </div>
                <div class="icon">
                <i class="ion ion-bag"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>

   
@stop

@section('js')
    <script>

    </script>
@stop


