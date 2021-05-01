@extends('adminlte::page')

@section('title', 'Kyodan.id')

@section('content_header')
    <h1>Pengelolaan Categories</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        {{ __('Pengelolaan CATEGORIES')}}
                    </div> -->
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahCATEGORIES">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
                        <table id="table-data" class="table table-borderer">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no=1; @endphp
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <!-- <td>{{ $category->id }}</td> -->
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" id="btn-update-categories" class="btn btn-success" data-toggle="modal" data-target="#updateCATEGORIES" data-id="{{ $category->id }}">Edit</button>
                                            <button type="button" id="btn-delete-categories" class="btn btn-danger" data-toggle="modal" data-target="#deleteCATEGORIES" data-id="{{ $category->id }}">Hapus</button>
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


    <!-- MODAL TAMBAH DATA CATEGORIES-->
    <div class="modal fade" id="tambahCATEGORIES" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.categories.submit') }}" method="post" enctype="multipart/form-data">
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

    <!-- MODAL EDIT/UPDATE DATA CATEGORIES-->
    <div class="modal fade" id="updateCATEGORIES" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit/Update Data Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.categories.update') }}" method="post" enctype="multipart/form-data">
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

    <!-- MODAL DELETE CATEGORIES -->
    <div class="modal fade" id="deleteCATEGORIES" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data tersebut?
                    <form method="post" action="{{ route('admin.categories.delete') }}" enctype="multipart/form-data">
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
            $(document).on('click', '#btn-update-categories', function(){
                let id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: "get",
                    url: baseurl+'/admin/ajaxadmin/dataCategories/'+id,
                    dataType: 'json',
                    success: function(res){
                        $('#update-name').val(res.name);
                        $('#update-description').val(res.description);
                        $('#edit-id').val(res.id);
                        
                    },
                });
            });

            $(document).on('click', '#btn-delete-categories', function(){
                let id = $(this).data('id');
                let cover = $(this).data('cover');
                $('#delete-id').val(id);
                console.log("hallo");
            });
        });
    </script>
@stop

