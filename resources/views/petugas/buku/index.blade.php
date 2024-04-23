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
                    Buku Perpustakaan
                </div>
            </div>
            <!-- Notifikasi menggunakan flash session data -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            @endif

            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('petugas.buku.create') }}" class="btn btn-md btn-primary mb-3 float-right">Tambah buku</a>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                          <table class="table table-hover">
                              <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Foto buku</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($buku as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $row->judul }}</td>
                                    <td><img src="{{ asset('storage/' . $row->foto) }}" alt="Foto buku" width="100"></td>
                                    <td>{{ $row->penulis }}</td>
                                    <td>{{ $row->penerbit }}</td>
                                    <td>{{ $row->tahun_terbit }}</td>
                                    <td class="description-cell">{{ $row->deskripsi }}</td>
                                    <td>
                                    <form action="{{ route('petugas.buku.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('petugas.buku.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> EDIT
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-confirm-delete="true">
                                            <i class="fas fa-trash"> HAPUS</i>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            </tbody>
                                @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="8">Data buku tidak tersedia</td>
                                </tr>
                                @endforelse
                              {{-- <td><span class="label label-success">Approved</span></td> --}}
                            </tr>
                          </table>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $buku->links() !!}
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
