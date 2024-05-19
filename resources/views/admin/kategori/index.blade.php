@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                Tambah Kategori
            </button>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td>{{ $kategori->harga }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{$kategori->id}}">
                                Edit
                            </button>

                            <!-- Form untuk hapus kategori -->
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Form untuk tambah kategori -->
                    <div class="mb-3">
                        <label for="new_nama_kategori" class="form-label">Nama Kategori:</label>
                        <input type="text" class="form-control" id="new_nama_kategori" name="nama_kategori" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_deskripsi" class="form-label">Deskripsi:</label>
                        <textarea class="form-control" id="new_deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="new_harga" class="form-label">Harga:</label>
                        <input type="number" class="form-control" id="new_harga" name="harga" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals for edit kategori -->
@foreach ($kategoris as $kategori)
<div class="modal fade" id="editKategoriModal{{$kategori->id}}" tabindex="-1" aria-labelledby="editKategoriModalLabel{{$kategori->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriModalLabel{{$kategori->id}}">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Form untuk edit kategori -->
                    <div class="mb-3">
                        <label for="edit_nama_kategori{{$kategori->id}}" class="form-label">Nama Kategori:</label>
                        <input type="text" class="form-control" id="edit_nama_kategori{{$kategori->id}}" name="nama_kategori" value="{{$kategori->nama_kategori}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi{{$kategori->id}}" class="form-label">Deskripsi:</label>
                        <textarea class="form-control" id="edit_deskripsi{{$kategori->id}}" name="deskripsi" rows="3">{{$kategori->deskripsi}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_harga{{$kategori->id}}" class="form-label">Harga:</label>
                        <input type="number" class="form-control" id="edit_harga{{$kategori->id}}" name="harga" value="{{$kategori->harga}}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
