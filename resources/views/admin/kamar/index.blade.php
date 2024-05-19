@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKamarModal">
                Tambah Kamar
            </button>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor Kamar</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kamars as $kamar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kamar->nomor_kamar }}</td>
                        <td>{{ $kamar->kategori->nama_kategori }}</td>
                        <td>{{ $kamar->status }}</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editKamarModal{{$kamar->id}}">
                                Edit
                            </button>

                            <!-- Form untuk hapus kamar -->
                            <form action="{{ route('kamar.destroy', $kamar->id) }}" method="post" class="d-inline">
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

<!-- Modal Tambah Kamar -->
<div class="modal fade" id="tambahKamarModal" tabindex="-1" aria-labelledby="tambahKamarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKamarModalLabel">Tambah Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kamar.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Form untuk tambah kamar -->
                    <div class="mb-3">
                        <label for="new_nomor_kamar" class="form-label">Nomor Kamar:</label>
                        <input type="text" class="form-control" id="new_nomor_kamar" name="nomor_kamar" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_kategori_id" class="form-label">Kategori:</label>
                        <select class="form-select" id="new_kategori_id" name="kategori_id" required>
                            @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
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

<!-- Modals for edit kamar -->
@foreach ($kamars as $kamar)
<div class="modal fade" id="editKamarModal{{$kamar->id}}" tabindex="-1" aria-labelledby="editKamarModalLabel{{$kamar->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKamarModalLabel{{$kamar->id}}">Edit Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kamar.update', $kamar->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Form untuk edit kamar -->
                    <div class="mb-3">
                        <label for="edit_nomor_kamar{{$kamar->id}}" class="form-label">Nomor Kamar:</label>
                        <input type="text" class="form-control" id="edit_nomor_kamar{{$kamar->id}}" name="nomor_kamar" value="{{$kamar->nomor_kamar}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kategori_id{{$kamar->id}}" class="form-label">Kategori:</label>
                        <select class="form-select" id="edit_kategori_id{{$kamar->id}}" name="kategori_id" required>
                            @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kamar->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
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
