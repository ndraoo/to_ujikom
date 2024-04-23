@extends('partials.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="card bg-dark text-center">
                <div class="card-body">
                    Buku Perpustakaan
                </div>
            </div>
            <!-- Notifikasi menggunakan flash session data -->
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                name="judul" value="{{ old('judul') }}" placeholder="Nama Buku" required>

                            <!-- error message untuk judul -->
                            @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Buku</label>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">

                            <!-- Error message untuk foto -->
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_kategori" class="form-label">Pilih Kategori</label>
                            <select class="form-control @error('id_kategori') is-invalid @enderror" id="id_kategori" name="kategori[]" multiple required>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ in_array($item->id, old('id_kategori', [])) ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror"
                                name="penulis" value="{{ old('penulis') }}" placeholder="Penulis" required>

                            <!-- error message untuk penulis -->
                            @error('penulis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                name="penerbit" value="{{ old('penerbit') }}" placeholder="Penerbit" required>

                            <!-- error message untuk penerbits -->
                            @error('penerbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                name="tahun_terbit" value="{{ old('tahun_terbit') }}" placeholder="Tahun Terbit" required>

                            <!-- error message untuk tahun_terbits -->
                            @error('tahun_terbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                name="deskripsi" placeholder="Deskripsi" required>{{ old('deskripsi') }}</textarea>
                            <!-- error message untuk deskripsi -->
                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-md btn-primary">Tambah</button>
                        <a href="{{ route('admin.buku.index') }}" class="btn btn-md btn-secondary">Kembali</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_kategori').select2();
        });
</script>
@endsection
