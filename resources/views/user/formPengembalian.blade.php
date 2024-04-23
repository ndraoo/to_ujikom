@include('layouts.header')
      <!-- arrival section start -->

      <div class="arrival_section layout_padding">
          <div class="container">
              <div class="row">
                <div class="col-sm-6 col-lg-4">
                @if ($peminjaman->buku)
                    @if ($peminjaman->buku->foto)
                    <img src="{{ asset('storage/' . $peminjaman->buku->foto) }}" alt="">
                    @else
                    <p>No Images</p>
                    @endif
                </div>
                    <div class="col-sm-8 col-lg-4">
                    <h1 class="arrival_text">{{ $peminjaman->buku->judul }}</h1>
                    <div class="movie_main">
                        <div class="mins_text_1">{{ $peminjaman->buku->penerbit }}</div>
                        <div class="mins_text">{{ $peminjaman->buku->tahun_terbit }}</div>
                    </div>
                    <p class="long_text">{{ $peminjaman->buku->deskripsi }}</p>
                @else
                    <div class="alert alert-danger" role="alert">
                        Buku tidak ditemukan.
                    </div>
                @endif
                <form action="{{ route('user.update.pengembalian', $peminjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" name="status_peminjaman" value="kembali" class="btn btn-success">Kembalikan</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!-- arrival section end -->

      @include('layouts.footer')


