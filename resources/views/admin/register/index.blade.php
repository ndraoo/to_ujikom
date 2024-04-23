
@extends('partials.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="card bg-dark text-center">
                <div class="card-body col-sm-2">
                   Petugas Perpustakaan
                </div>
            </div>
            <!-- Notifikasi menggunakan flash session data -->

            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('admin.register.create') }}" class="btn btn-md btn-primary mb-3 float-right">Tambah Petugas</a>
                    <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th scope="col">Nama lengkap</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Email</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Level</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admin as $row)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $row->nama_lengkap }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->password  }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->level }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('admin.register.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('admin.register.edit', $row->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> EDIT
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> HAPUS
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center text-mute" colspan="4">Data Barang tidak tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $admin->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

