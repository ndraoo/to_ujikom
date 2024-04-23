@include('layouts.header')
      <!-- movies section start -->
      <div class="movies_section layout_padding">
         <div class="container">
            <div class="movies_menu">
            </div>
            <div class="movies_section_2 layout_padding">
               <h2 class="letest_text text-center">Pengembalian Buku</h2>
               <div class="movies_main">
                  <div class="iamge_movies_main">
                @if ($peminjaman->isNotEmpty())
                    @foreach ($peminjaman as $p)
                        @if ($p->buku) <!-- Periksa apakah ada buku terkait -->
                            <div class="image_movies">
                                <div class="image_3">
                                    <img src="{{ asset('storage/' . $p->buku->foto) }}" class="image" style="width:100%">
                                    <div class="middle">
                                        <a href="{{ route('user.form.pengembalian', $p->id) }}"><div class="playnow_bt">Kembalikan Sekarang!</div></a>
                                    </div>
                                </div>
                                <h1 class="code_text">{{ $p->buku->judul }}</h1>
                                <p class="there_text">{{ $p->buku->deskripsi }}</p>

                            </div>
                        @endif
                    @endforeach
                @else
                    <h1 class="text-white">Tidak Ada Buku yang Dipinjam!</h1>
                @endif
                </div>
               </div>
            </div>
         </div>
      </div>
      <!-- movies section end -->

@include('layouts.cooming')
@include('layouts.footer')
