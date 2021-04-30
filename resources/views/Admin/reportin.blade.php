@extends('adminlte::page')

@section('title', 'LAPORAN BARANG MASUK')

@section('content_header')
    <h1>LAPORAN BARANG MASUK</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('LAPORAN BARANG MASUK') }}</div>

                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBrandModal"><i class="fa fa-plus"></i>Tambah Data</button>
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
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $report->name }}</td>
                                        <td>{{ $report->qty }}</td>
                                        <td>{{ $report->created_at}}</td>
                                        
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

