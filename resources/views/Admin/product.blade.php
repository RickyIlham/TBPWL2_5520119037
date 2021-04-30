@extends('adminlte::page')

@section('title', 'Pengelolaan Barang')

@section('content_header')
    <h1>Pengelolaan Barang</h1>
@stop

@section('content')
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header">

                       <button class="btn btn-primary float-left" data-toggle="modal" data-target="#tambahProdukModal"><i class="fa fa-plus"></i> Tambah Data</button>

                        <hr/>

                    </div>
                   <div class="card-body">
                       <table id="table-data" class="table table-borderer" >
                           <thead>
                               <tr>
                                   <th>NO</th>
                                   <th>NAMA BARANG</th>
                                   <th>KATEGORI</th>
                                   <th>MERK</th>
                                   <th>STOK</th>
                                   <th>FOTO</th>
                                   <th>AKSI</th>
                               </tr>
                           </thead>
                           <tbody>
                                @php $no=1; @endphp
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category->categories_id}}</td>
                                        <td>{{$product->brand->brands_id}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>
                                            @if($product->foto !== null)
                                                <img src="{{ asset('storage/foto_barang/'.$product->foto) }}" width="100px"/>
                                            @else
                                                [Gambar tidak tersedia]
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" id="btn-edit-produk" class="btn btn-success" data-toggle="modal" data-target="#editProdukModal" data-id="{{ $product->id }}">Ubah</button>
                                                <button type="button" id="btn-delete-produk" class="btn btn-danger" data-toggle="modal" data-target="#deleteProdukModal" data-id="{{ $product->id }}" data-foto="{{ $product->foto }}">Hapus</button>
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




   <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="qty">QTY</label>
                    <input type="number" id="qty" name="qty" class="form-control">
                </div>
                <div class="form-group">
                    <label for="brand_id">Merek</label>
                    <select name="brand_id" id="brand_id" class="custom-select" required>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id" class="custom-select" required>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="photo">Foto <small>*optional</small></label>
                    <input type="file" id="photo" name="photo" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  

   
@stop
@section('js')
    <script>
        $(function(){
            $("#datepicker").datepicker( {
                format: "yyyy", // Notice the Extra space at the beginning
                viewMode: "years",
                minViewMode: "years"
            });
            $(document).on('click', '#btn-delete-produk', function(){
                let id = $(this).data('id');
                let foto = $(this).data('foto');
                $('#delete-id').val(id);
                $('#delete-old-foto').val(foto);
                console.log("hallo");
            });

            $(document).on('click', '#btn-edit-produk', function(){
                let id = $(this).data('id');

                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url: baseurl+'/admin/ajaxadmin/dataProduk/'+id,
                    dataType: 'json',
                    success: function(res){
                        $('#edit-nama').val(res.nama);
                        $('#edit-categories_id').val(res.categories_id);
                        $('#edit-brands_id').val(res.brands_id);
                        $('#edit-harga').val(res.harga);
                        $('#edit-stok').val(res.stok);
                        $('#edit-id').val(res.id);
                        $('#edit-old-foto').val(res.foto);

                        if (res.foto !== null) {
                            $('#image-area').append(
                                "<img src='"+baseurl+"/storage/foto_barang/"+res.foto+"' width='200px'/>"
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

    </script>
@stop


