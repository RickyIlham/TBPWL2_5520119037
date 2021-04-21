@extends('adminlte::page')

@section('title', 'Pengelolaan Barang')

@section('content_header')
    <h1>Pengelolaan Buku</h1>
@stop

@section('content')
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header">

                       <button class="btn btn-primary float-left" data-toggle="modal" data-target="#tambahProdukModal"><i class="fa fa-plus"></i> Tambah Data</button>

                        <a href="{{ route('admin.print.products') }}" target="_blank" class="btn btn-success float-left"><i class="fa fa-print"></i> Cetak PDF</a>
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
                                   <th>HARGA</th>
                                   <th>STOK</th>
                                   <th>FOTO</th>
                                   <th>AKSI</th>
                               </tr>
                           </thead>
                           <tbody>
                                @php $no=1; @endphp
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$product->nama}}</td>
                                        <td>{{$product->categories_id}}</td>
                                        <td>{{$product->brands_id}}</td>
                                        <td>{{$product->harga}}</td>
                                        <td>{{$product->stok}}</td>
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
          <form method="post" action="{{ route('admin.product.submit') }}" enctype="multipart/form-data">
          @csrf
              <div class="form-group">
                  <label for="nama">Nama Barang</label>
                  <input type="text" class="form-control" name="nama" id="nama" required/>
              </div>
              <div class="form-group">
                  <label for="categories_id">Kategori</label>
                  <input type="text" class="form-control" name="categories_id" id="categories_id" required/>
              </div>
              
              <div class="form-group">
                  <label for="brands_id">Merk</label>
                  <Select class="form-control" name="brands_id" id="brands_id" required/>
                    @foreach
                    
                  </Select>
              </div>
              <div class="form-group">
                  <label for="harga">Harga</label>
                  <input min="1" type="number" id="datepicker"class="form-control" name="harga" id="harga" required/>
              </div>
              <div class="form-group">
                  <label for="stok">Stok</label>
                  <input min="1" type="number" id="datepicker"class="form-control" name="stok" id="stok" required/>
              </div>
              <div class="form-group">
                  <label for="foto">Foto</label>
                  <input type="file" class="form-control" name="foto" id="foto"/>
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

  <div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('admin.product.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="edit-nama">Judul Buku</label>
                      <input type="text" class="form-control" name="nama" id="edit-nama" required/>
                  </div>
                  <div class="form-group">
                      <label for="edit-categories_id">Kategori</label>
                      <input type="text" class="form-control" name="categories_id" id="edit-categories_id" required/>
                  </div>
                 
                  <div class="form-group">
                      <label for="edit-brands_id">Merk</label>
                      <input type="text" class="form-control" name="brands_id" id="edit-brands_id" required/>
                  </div>
                  <div class="form-group">
                  <label for="edit-harga">Harga</label>
                  <input min="1" type="number" id="datepicker"class="form-control" name="edit-harga" id="edit-harga" required/>
              </div>
              <div class="form-group">
                  <label for="edit-stok">Stok</label>
                  <input min="1" type="number" id="datepicker"class="form-control" name="edit-stok" id="edit-stok" required/>
              </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group" id="image-area"></div>
                  <div class="form-group">
                      <label for="edit-foto">Foto</label>
                      <input type="file" class="form-control" name="foto" id="edit-foto"/>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="edit-id"/>
          <input type="hidden" name="old_foto" id="edit-old-foto"/>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="deleteProdukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Data Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        Apakah anda yakin akan menghapus data tersebut?
          <form method="post" action="{{ route('admin.product.delete') }}" enctype="multipart/form-data">
              @csrf
              @method('DELETE')
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="delete-id" value=""/>
          <input type="hidden" name="old_cover" id="delete-old-foto"/>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
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


