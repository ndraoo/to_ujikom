@include('layouts.header')
      <!-- arrival section start -->

      <div class="arrival_section layout_padding">
          <div class="container">
              <div class="row">
                <div class="col-sm-6 col-lg-4">
                @if ($buku)
                    @if ($buku->foto)
                    <img src="{{ asset('storage/' . $buku->foto) }}" alt="">
                    @else
                    <p>No Images</p>
                    @endif
                </div>
                    <div class="col-sm-8 col-lg-4">
                    <h1 class="arrival_text">{{ $buku->judul }}</h1>
                    <div class="movie_main">
                        <div class="mins_text_1">{{ $buku->penerbit }}</div>
                        <div class="mins_text">{{ $buku->tahun_terbit }}</div>
                    </div>
                    <p class="long_text">{{ $buku->deskripsi }}</p>
                @else
                    <div class="alert alert-danger" role="alert">
                        Buku tidak ditemukan.
                    </div>
                @endif
                    <div class="rating_main">

                        <form action="{{ route('ulasan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                        <textarea name="ulasan" placeholder="Tulis ulasan Anda" required class="form-control mt-3"></textarea>
                        <input class="star star-5" id="star-5" type="radio" name="rating" value="5"/>
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="rating" value="4"/>
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="rating" value="3"/>
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="rating" value="2"/>
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" name="rating" value="1"/>
                        <label class="star star-1" for="star-1"></label>
                        <button type="submit" class="btn btn-primary mt-2">Kirim Ulasan</button>
                    </form>
                        <a href="{{ route('user.index') }}" class="btn btn-danger mt-2">Kembali</a>
                </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card ml-5 justify-content-center shadow-lg">
                        <div class="card-body">
                            Ulasan
                            @foreach ($ulasan as $row)
                            <div class="card mt-2">
                                <div class="card-header">
                                    <h4>{{ $row->user->username }}</h4>
                                </div>
                                <p>{{ $row->ulasan }}</p >
                                    <h4 class="ml-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $row->rating)
                                                    &#9733;
                                                    @else
                                                    &#9734;
                                                    @endif
                                                    @endfor
                                                </h4>
                                            </div>
                                            @endforeach
                            <div class="container mt-3">
                                 {{ $ulasan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!-- arrival section end -->

      @include('layouts.footer')


