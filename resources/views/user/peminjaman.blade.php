@include('layouts.header')

    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5 mb-5 shadow-lg">
                    <div class="card-header">Form Peminjaman Buku</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pinjam.store') }}">
                            @csrf

                            <input type="hidden" name="id_buku" value="{{ $buku->id }}">

                            <div class="form-group row">
                                <label for="tanggal_pengembalian" class="col-md-4 col-form-label text-md-right">Judul Buku</label>
                                <div class="col-md-6">
                                    <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tanggal_pengembalian" class="col-md-4 col-form-label text-md-right">Tanggal Pengembalian</label>
                                <div class="col-md-6">
                                    <input id="tanggal_pengembalian" type="date" class="form-control @error('tanggal_pengembalian') is-invalid @enderror" name="tanggal_pengembalian" required>
                                    @error('tanggal_pengembalian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Peminjaman
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')
