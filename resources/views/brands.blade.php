@extends('adminlte::page')

@section('title', 'Kyodan.id')

@section('content_header')
    <h1>Pengelolaan Merk</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        {{ __('Pengelolaan Merk')}}
                    </div> -->
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBRANDS">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
                        <table id="table-data" class="table table-borderer">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <!-- <th>Id</th> -->
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no=1; @endphp
                                @foreach ($brands as $br)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <!-- <td>{{ $br->id }}</td> -->
                                    <td>{{ $br->name }}</td>
                                    <td>{{ $br->description }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="btn-update-brands" class="btn btn-success" data-toggle="modal" data-target="#updateBRANDS" data-id="{{ $br->id }}">Edit</button>
                                            <button type="button" id="btn-delete-brands" class="btn btn-danger" data-toggle="modal" data-target="#deleteBRANDS" data-id="{{ $br->id }}">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL TAMBAH DATA BRANDS-->
    <div class="modal fade" id="tambahBRANDS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Merk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.brands.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" required/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT/UPDATE DATA BRANDS-->
    <div class="modal fade" id="updateBRANDS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit/Update Data Merk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.brands.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="update-name">Name</label>
                            <input type="text" class="form-control" name="name" id="update-name" required/>
                        </div>
                        <div class="form-group">
                            <label for="update-description">Description</label>
                            <input type="text" class="form-control" name="description" id="update-description" required/>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="edit-id"/>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DELETE BRANDS -->
    <div class="modal fade" id="deleteBRANDS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data Merk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data tersebut?
                    <form method="post" action="{{ route('admin.brands.delete') }}" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="delete-id" value=""/>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
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
        $(function(){
            $(document).on('click', '#btn-update-brands', function(){
                let id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: "get",
                    url: baseurl+'/admin/ajaxadmin/dataBrands/'+id,
                    dataType: 'json',
                    success: function(res){
                        $('#update-name').val(res.name);
                        $('#update-description').val(res.description);
                        $('#edit-id').val(res.id);
                        
                    },
                });
            });
            $(document).on('click', '#btn-delete-brands', function(){
                let id = $(this).data('id');
                $('#delete-id').val(id);
                console.log("hallo");
            });
        });
    </script>
@stop
