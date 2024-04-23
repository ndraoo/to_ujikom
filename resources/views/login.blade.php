<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
    <title>Login & Sing up</title>
</head>
<body>
    <div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->
			<div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                    <form  class="form-wrapper" action="{{ route('registermasyarakat') }}" method="post">
                    @csrf
					<div class="form sign-up">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" name="nama_lengkap" placeholder="Nama Lengkap">
						</div>
						<div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="text" name="username" placeholder="Username" >
						</div>
                        <div class="input-group">
                            <i class="fa-solid fa-square-phone"></i>
                            <input type="email" name="email" placeholder="Email" >
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" placeholder="Password" >
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password_confirmation" placeholder="Confirm password">
						</div>
                        <div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="text" name="alamat" placeholder="Alamat" >
						</div>
						<button type="submit">
							Sign up
						</button>
                        </form>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
					</div>
				</div>

			</div>
			<!-- END SIGN UP -->
			<!-- SIGN IN -->

			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
					<div class="form sign-in">
                        <form action="{{ route('proses_login') }}" method="post">
                        @csrf
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" name="username" placeholder="Username" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" name="password" placeholder="Password" required>
						</div>
						<button type="submit">
							Sign in
						</button>
                        </form>
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
					</div>
				</div>
				<div class="form-wrapper">

				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome To Perpustakaan
					</h2>

				</div>
				<div class="img sign-in">

				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">

				</div>
				<div class="text sign-up">
					<h2>
						Join with us
					</h2>

				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @include('sweetalert::alert')
<!-- Script to handle alerts -->
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

    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }
       // Gunakan fungsi showErrorAlert dengan pesan error yang sesuai
       @if($errors->any())
        @foreach($errors->all() as $error)
            showErrorAlert('{{ $error }}');
        @endforeach
       @endif

    let container = document.getElementById('container')

    toggle = () => {
        container.classList.toggle('sign-in')
        container.classList.toggle('sign-up')
    }

    setTimeout(() => {
        container.classList.add('sign-in')
    }, 200)
</script>
</body>
</html>
