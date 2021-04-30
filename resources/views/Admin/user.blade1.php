@extends('adminlte::page')

@section('title', 'Pengelolaan User')

@section('content_header')
    <h1>Pengelolaan User</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pengelolaan User') }}</div>

                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUserModal"><i class="fa fa-plus"></i>Tambah Data</button>
                        <hr/>
                        <table id="table-data" class="table table-borderer">
                        <thead>
                               <tr>
                                   <th>NO</th>
                                   <th>NAMA</th>
                                   <th>EMAIL</th>
                                   <th>PASSWORD</th>
                                   <th>LEVEL</th>
                                   <th>FOTO</th>
                                   <th>AKSI</th>
                               </tr>
                           </thead>
                           <tbody>
                                @php $no=1; @endphp
                                @foreach($Users as $user)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->password}}</td>
                                        <td>{{$user->roles_id}}</td>
                                        <td>
                                            @if($user->photo !== null)
                                                <img src="{{ asset('storage/foto_user/'.$user->photo) }}" width="100px"/>
                                            @else
                                                [Gambar tidak tersedia]
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="basic example">
                                                <button  id="btn-edit-User" class="btn btn-success" data-toggle="modal" data-target="#ubahuserModal" data-id="{{ $user->id }}">Edit</button>
                                                <button  id="btn-delete-User" class="btn btn-danger" data-toggle="modal" data-target="#deleteuserModal" data-id="{{ $user->id }}">Hapus</button>
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

    {{-- Tambah Data --}}
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <small>*optional</small></label>
                            <input type="password" id="password" name="password" value="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="photo">Foto <small>*optional</small></label>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="roles_id">Role</label>
                            <select name="roles_id" id="roles_id" class="custom-select" required>
                                <option value="">~ Pilih ~</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Data --}}
    <div class="modal fade" id="ubahuserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <small>*optional</small></label>
                            <input type="password" id="password" name="password" value="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="photo">Foto <small>*optional</small></label>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="roles_id">Role</label>
                            <select name="roles_id" id="roles_id" class="custom-select" required>
                                <option value="">~ Pilih ~</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- delete data User --}}
    <div class="modal fade" id="deleteuserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data tersebut?
                    <form action="{{ route('user.delete') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="delete-id">
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
            $("#datepicker").datepicker( {
                format: "yyyy", // Notice the Extra space at the beginning
                viewMode: "years",
                minViewMode: "years"
            });
            $(document).on('click', '#btn-delete-User', function(){
                let id = $(this).data('id');
                let photo = $(this).data('photo');
                $('#delete-id').val(id);
                $('#delete-old-photo').val(photo);
                console.log("hallo");
            });
            $(document).on('click', '#btn-edit-User', function(){
                let id = $(this).data('id');
                $('#image-area').empty();
                $.ajax({
                    type: "get",
                    url: baseurl+'/Admin/ajax/dataUser/'+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-name').val(res.name);
                        $('#edit-username').val(res.username);
                        $('#edit-email').val(res.email);
                        $('#edit-password').val(res.password);
                        $('#edit-id').val(res.id);
                        $('#edit-old-photo').val(res.photo);
                        if (res.photo !== null) {
                            $('#image-area').append(
                                "<img src='"+baseurl+"/storage/photo_user/"+res.photo+"' width='200px'/>"
                            );
                        } else {
                            $('#image-area').append('[Gambar tidak tersedia]');
                        }
                    },
                });
            });
        });
    </script>
@stop
@section('js')
    <script>
     
    </script> --}}
@stop