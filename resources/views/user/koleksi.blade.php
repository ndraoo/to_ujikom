@include('layouts.header')
      <!-- movies section start -->
      <div class="movies_section layout_padding">
         <div class="container">
            <div class="movies_menu">

            <div class="movies_section_2 layout_padding">
               <h2 class="letest_text">Koleksi Buku</h2>
               <div class="movies_main">
                  <div class="iamge_movies_main">
                    @forelse ($peminjaman as $row)
                    <div class="image_movies">
                        <div class="image_3">
                            <img src="{{ asset('storage/' . $row->buku->foto) }}" class="image" >
                        </div>
                        <h1 class="code_text">{{ $row->buku->judul }}</h1>
                        <p class="there_text">{{ $row->buku->deskripsi }}</p>
                    </div>
                @empty
                    <h1 class="text-white">Tidak Ada Koleksi Buku!</h1>
                @endforelse
                  </div>
               </div>
            </div>
            </div>
         </div>
      </div>
      <!-- movies section end -->


@include('layouts.cooming')
@include('layouts.footer')
