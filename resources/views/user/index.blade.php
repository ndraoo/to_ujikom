@include('layouts.header')

      <!-- arrival section start -->
      <div class="arrival_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-sm-6 col-lg-4">
                  <div class="image_1">
                     <h2 class="jesusroch_text">Test</h2>
                     <p class="movie_text">Hollywood</p>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-4">
                  <div class="image_2">
                     <h2 class="jesusroch_text">Test</h2>
                     <p class="movie_text">Hollywood</p>
                  </div>
               </div>
               <div class="col-sm-8 col-lg-4">
                  <h1 class="arrival_text">A r r i v a l</h1>
                  <div class="movie_main">
                     <div class="mins_text_1">150 mins</div>
                     <div class="mins_text">Actions</div>
                     <div class="mins_text"><img src="images/icon-1.png"><span class="icon_1">Watchlist</span></div>
                  </div>
                  <p class="long_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem</p>
                  <div class="rating_main">
                     <div class="row">
                        <div class="col-sm-6 col-lg-6">
                           <div class="icon_2"><img src="images/icon-2.png"><span class="padding_10">4.6 Revieweed</span></div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                           <div class="icon_2"><img src="images/icon-2.png"><span class="padding_10">Your Rateing</span></div>
                        </div>
                     </div>
                  </div>
                  <div class="paly_bt"><a href="#">Pinjam Sekarang!</a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- arrival section end -->

      <!-- movies section start -->
      <div class="movies_section layout_padding">
         <div class="container">
            <div class="movies_menu">
    
            </div>
            <div class="movies_section_2 layout_padding">
               <h2 class="letest_text">Letest Books</h2>
               <div class="movies_main">
                  <div class="iamge_movies_main">
                    @forelse ($buku as $row)
                    <div class="image_movies">
                        <div class="image_3">
                            <img src="{{ asset('storage/' . $row->foto) }}" class="image" >
                            <div class="middle">
                                @if (in_array($row->id, $existingPeminjaman))
                                    <div class="playnow_bt">Sudah Dipinjam</div>
                                @else
                                    <a href="{{ route('pinjam.form', $row->id) }}"><div class="playnow_bt">Pinjam Sekarang!</div></a>
                                @endif
                            <a href="{{ route('user.ulasan.create', $row->id) }}"><div class="playnow_bt2 mt-3">Ulasan</div></a>
                            </div>
                        </div>
                        <h1 class="code_text">{{ $row->judul }}</h1>
                        <p class="there_text">{{ $row->deskripsi }}</p>
                    </div>
                @empty
                    <h1 class="text-white">Tidak Ada Buku!</h1>
                @endforelse
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- movies section end -->


@include('layouts.cooming')
@include('layouts.footer')
