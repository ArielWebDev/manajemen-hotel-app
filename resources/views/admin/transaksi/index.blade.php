@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTransaksiModal">
                Tambah Transaksi
            </button>
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pengunjung</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Tanggal Check-in</th>
                        <th scope="col">Tanggal Check-out</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Kamar</th>
                        <th scope="col">Status Kamar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->nama_pengunjung }}</td>
                        <td>{{ $transaksi->nik }}</td>
                        <td>{{ $transaksi->tanggal_checkin }}</td>
                        <td>{{ $transaksi->tanggal_checkout }}</td>
                        <td>{{ $transaksi->biaya }}</td>
                        <td>{{ $transaksi->kamar->nomor_kamar }}</td> <!-- Menampilkan nomor kamar -->
                        <!-- Tambahkan Tombol untuk Menempatkan Transaksi -->
                        <td>
                            @if ($transaksi->status == 'selesai')
                                <span class="badge bg-success">Transaksi Selesai</span>
                            @else
                                @if ($transaksi->kamar->status === 'dipesan')
                                    <form action="{{ route('transaksi.tempatkan', $transaksi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary">Tempatkan</button>
                                    </form>
                                @elseif ($transaksi->kamar->status === 'ditempati')
                                    <form action="{{ route('transaksi.checkout', $transaksi->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-warning">Check-out</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                        
                        
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editTransaksiModal{{$transaksi->id}}">
                                Edit
                            </button>

                            <!-- Form untuk hapus transaksi -->
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="post" class="d-inline">
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

<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="tambahTransaksiModal" tabindex="-1" aria-labelledby="tambahTransaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahTransaksiModalLabel">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Form untuk tambah transaksi -->
                    <div class="mb-3">
                        <label for="new_nama_pengunjung" class="form-label">Nama Pengunjung:</label>
                        <input type="text" class="form-control" id="new_nama_pengunjung" name="nama_pengunjung" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_nik" class="form-label">NIK:</label>
                        <input type="text" class="form-control" id="new_nik" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_tanggal_checkin" class="form-label">Tanggal Check-in:</label>
                        <input type="date" class="form-control" id="new_tanggal_checkin" name="tanggal_checkin" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_tanggal_checkout" class="form-label">Tanggal Check-out:</label>
                        <input type="date" class="form-control" id="new_tanggal_checkout" name="tanggal_checkout" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_kamar_id" class="form-label">Kamar:</label>
                        <select class="form-select" id="new_kamar_id" name="kamar_id" required>
                            @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->id }}">{{$kamar->kategori->nama_kategori}}-{{ $kamar->nomor_kamar }}</option>
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

<!-- Modals for edit transaksi -->
@foreach ($transaksis as $transaksi)
<div class="modal fade" id="editTransaksiModal{{$transaksi->id}}" tabindex="-1" aria-labelledby="editTransaksiModalLabel{{$transaksi->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransaksiModalLabel{{$transaksi->id}}">Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Form untuk edit transaksi -->
                    <div class="mb-3">
                        <label for="edit_nama_pengunjung{{$transaksi->id}}" class="form-label">Nama Pengunjung:</label>
                        <input type="text" class="form-control" id="edit_nama_pengunjung{{$transaksi->id}}" name="nama_pengunjung" value="{{$transaksi->nama_pengunjung}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nik{{$transaksi->id}}" class="form-label">NIK:</label>
                        <input type="text" class="form-control" id="edit_nik{{$transaksi->id}}" name="nik" value="{{$transaksi->nik}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tanggal_checkin{{$transaksi->id}}" class="form-label">Tanggal Check-in:</label>
                        <input type="date" class="form-control" id="edit_tanggal_checkin{{$transaksi->id}}" name="tanggal_checkin" value="{{$transaksi->tanggal_checkin}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tanggal_checkout{{$transaksi->id}}" class="form-label">Tanggal Check-out:</label>
                        <input type="date" class="form-control" id="edit_tanggal_checkout{{$transaksi->id}}" name="tanggal_checkout" value="{{$transaksi->tanggal_checkout}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kamar_id{{$transaksi->id}}" class="form-label">Kamar:</label>
                        <select class="form-select" id="edit_kamar_id{{$transaksi->id}}" name="kamar_id" required>
                            @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->id }}" {{ $transaksi->kamar_id == $kamar->id ? 'selected' : '' }}>{{ $kamar->nomor_kamar }}</option>
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
