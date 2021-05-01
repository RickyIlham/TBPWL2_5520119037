@extends('adminlte::page')

@section('title', 'Kyodan.id')

@section('content_header')
    <h1> Laporan Barang Keluar</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">{{ __('  ') }}</div> -->

                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahProductModal"><i class="fa fa-minus"></i> Unduh Laporan</button>
                        <hr/>
                        <table id="table-data" class="table table-borderer">
                        <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th>QTY</th>
                                    <th>TANGGAL MASUK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($reportouts as $reportout)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $reportout->name }}</td>
                                        <td>{{ $reportout->qty }}</td>
                                        <td>{{ $reportout->created_at}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        
    </script>
@stop 