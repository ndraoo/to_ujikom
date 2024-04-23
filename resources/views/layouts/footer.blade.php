
     <!-- footer  section start -->
     <div class="footer_section layout_padding">
        <div class="container">
           <div class="social_icon">
              <ul>
                 <li><a href="#"><img src="/images/fb-icon.png"></a></li>
                 <li><a href="#"><img src="/images/twitter-icon.png"></a></li>
                 <li><a href="#"><img src="/images/linkedin-icon.png"></a></li>
                 <li><a href="#"><img src="/images/instagram-icon.png"></a></li>
              </ul>
           </div>
        </div>
     </div>
     <!-- footer  section end -->
     <!-- copyright section start -->
     <div class="copyright_section">
        <div class="container">
           <div class="copyright_text">Copyright 2024 All Right Reserved By PerpustakaanOnline</a></div>
        </div>
     </div>
     <!-- copyright section end -->
     <!-- Javascript files-->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

     @include('sweetalert::alert')

    <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))

        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ is_array(session('error')) ? implode("<br>", session('error')) : session('error') }}',
            confirmButtonText: 'OK'
        });

    @endif
    </script>

     <script src=" {{ asset('js/jquery.min.js')}}"></script>
     <script src="{{ asset('js/popper.min.js')}}"></script>
     <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
     <script src="{{ asset('js/jquery-3.0.0.min.js')}}"></script>
     <!-- sidebar -->
     <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
     <script src="{{ asset('js/custom.js')}}"></script>
     <!-- javascript -->
     <script src="{{ asset('js/owl.carousel.js')}}"></script>
     <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
     <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
     <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
     </script>
  </body>
</html>
