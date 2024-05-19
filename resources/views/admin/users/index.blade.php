@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                Tambah User
            </button>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">NAMA</th>
                    <th scope="col">Email</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editUserModal{{$u->id}}">
                            Edit
                        </button>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editUserModal{{$u->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$u->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModalLabel{{$u->id}}">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('users.update', $u->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Form untuk edit user -->
                                            <div class="mb-3">
                                                <label for="edit_name" class="form-label">Nama:</label>
                                                <input type="text" class="form-control" id="edit_name" name="name" value="{{$u->name}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_email" class="form-label">Email:</label>
                                                <input type="email" class="form-control" id="edit_email" name="email" value="{{$u->email}}" required>
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

                        <!-- Form untuk hapus user -->
                        <form action="{{ route('users.destroy', $u->id) }}" method="post" class="d-inline">
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

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahUserModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Form untuk tambah user -->
                    <div class="mb-3">
                        <label for="new_name" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="new_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="new_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="new_password" name="password" required>
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
@endsection
