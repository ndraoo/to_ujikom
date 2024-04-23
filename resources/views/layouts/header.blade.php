<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Perpustakaan</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/rating.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">
      <!-- fevicon -->
      <link rel="icon" href="/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets -->
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="logo" href="#"><img src="/images/tm.jpg" style="width: 25%"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('user.index') }}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.pengembalian.form') }}">Pengembalian</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.koleksi') }}">Koleksi</a>
                  </li>
               </ul>
               @guest
               <p><a href="{{ route('login') }}" class="btn">Login</a></p>
               @else
               <div class="search_icon"><a href="{{ route('logout') }}"><img src="/images/user-icon.png"><span class="padding_left_15">Logout</span></a></div>
               @endguest
            </div>
         </nav>
      </div>
      <!-- header section end -->
      <!-- banner section end -->
      <div class="banner_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="banner_taital">Enjoy <br>The Perpustakaan Shows</div>
                  <p class="banner_text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                  <div class="see_bt"><a href="#">Pinjam Sekarang!</a></div>
               </div>
               <div class="col-md-6">
                  <div class="play_icon"><a href="#"><img src="/images/play-icon.png"></a></div>
               </div>
            </div>
         </div>
      </div>
      <!-- banner section end -->
