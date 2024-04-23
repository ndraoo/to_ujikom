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
            <form action="{{ route('admin.generatePDF') }}" method="GET">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            <label for="start_date">Tanggal Awal Minggu:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir Minggu:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-danger mb-3">Generate Laporan</button>
                    </div>
                </div>
              </div>
            </form>
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                          <table class="table table-hover">
                              <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status Peminjaman</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($peminjaman as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $row->user->username }}</td>
                                    <td>{{ $row->buku->judul }}</td>
                                    <td>{{ $row->tanggal_peminjaman }}</td>
                                    <td>{{ $row->tanggal_pengembalian }}</td>
                                    <td>{{ $row->status_peminjaman }}</td>
                                    <td>
                                        <form action="{{ route('admin.updateStatus', $row->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if($row->status_peminjaman == 'dipinjam')
                                                    <button type="submit" name="status" value="kembali" class="btn btn-success">Kembali</button>
                                                @elseif($row->status_peminjaman == 'kembali')
                                                    <button type="submit" name="status" value="dipinjam" class="btn btn-primary">Dipinjam</button>
                                                @endif
                                            </div>
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
                        {{-- {!! $buku->links() !!} --}}
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
