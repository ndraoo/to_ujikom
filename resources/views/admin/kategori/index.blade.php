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
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-md btn-primary mb-3 float-right">Tambah Kategori</a>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                          <table class="table table-hover">
                              <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($kategori as $row)
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $row->nama_kategori }}</td>
                                    <td>
                                    {{-- <form action="{{ route('admin.kategori.destroy', $row->id) }}" method="POST"> --}}
                                        <a href="{{ route('admin.kategori.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> EDIT
                                        </a>
                                        @csrf
                                        <a href="{{ route('admin.kategori.destroy', $row->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true">
                                            <i class="fas fa-trash"> </i> HAPUS
                                        </a>
                                    {{-- </form> --}}
                                    </td>
                                </tr>
                            </tbody>
                                @empty
                                <tr>
                                    <td class="text-center text-mute" colspan="8">Data Kategori Buku Tidak Tersedia</td>
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
                        {!! $kategori->links() !!}
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

