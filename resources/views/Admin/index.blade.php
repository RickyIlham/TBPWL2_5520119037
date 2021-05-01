@extends('adminlte::page')

@section('title', 'Kyodan.id')

@section('content_header')
    <h1>Dasboard</h1>
@stop

@section('content')
<div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$usersco}}</h3>

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
                <h3>{{$productsco}}</h3>

                <p>Pengelolaan Barang</p>
                </div>
                <div class="icon">
                <i class="fas fa-fw fa-box"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$categoriesco}}</h3>

                <p>Kategori</p>
                </div>
                <div class="icon">
                <i class="fas fa-fw fa-folder"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$brandsco}}</h3>

                <p>Merek</p>
                </div>
                <div class="icon">
                <i class="fas fa-fw fa-pen"></i>
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


