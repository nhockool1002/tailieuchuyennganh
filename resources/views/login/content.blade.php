	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('login-assets/images/img-01.jpg') }}');">
			<div class="wrap-login100 p-t-190 p-b-30">
				<form class="login100-form validate-form" method="POST" action="{{ route('postLogin') }}">
					{{ csrf_field() }}
					<div class="login100-form-avatar">
						<img src="{{ asset('login-assets/images/avatar-01.jpg') }}" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						ĐĂNG NHẬP TÀI LIỆU CHUYÊN NGÀNH
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Tài khoản">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Mật khẩu">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>
					@if(count($errors) > 0)
                        <div class="wrap-input100 validate-input m-b-10  alert alert-danger">
                            @foreach($errors->all() as $err)
                                <i class="fa fa-times" aria-hidden="true"></i> {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('failed_mesage'))
                        <div class="wrap-input100 validate-input m-b-10 alert alert-danger">
                            <i class="fa fa-times" aria-hidden="true"></i> {{session('failed_mesage')}}
                        </div>
                    @endif
                    @if(session('success_mesage'))
                        <div class="wrap-input100 validate-input m-b-10 alert alert-success">
                            <i class="fa fa-check" aria-hidden="true"></i> {{session('success_mesage')}}
                        </div>
                    @endif
					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Đăng nhập
						</button>
					</div>

					<div class="text-center w-full p-t-25 p-b-230">
						<a href="#" class="txt1">
							Quên mật khẩu ?
						</a>
					</div>

					<div class="text-center w-full">
                        <a class="txt1" href="{{ route('getRegister') }}">
							Tạo tài khoản
							<i class="fa fa-long-arrow-right"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
