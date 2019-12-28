@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])

@section('title', 'Login Page')

@section('content')
	<!-- begin login -->
	<div class="login login-with-news-feed">
		<!-- begin news-feed -->
		<div class="news-feed">
			<div class="news-image" style="background-image: url({{url("/storage/{$data->wallpaper}")}})"></div>
			<div class="news-caption">
				<h4 class="caption-title"><b>{{$data->title}} </b></h4>
				<p>
					{{$data->description}}
				</p>
			</div>
		</div>
		<!-- end news-feed -->
		<!-- begin right-content -->
		<div class="right-content">
			<!-- begin login-header -->
			<div class="login-header">
				<div class="brand text-center">
				<img src={{url("/storage/{$data->logo}")}} width="80"> <br /><b>Login {{$data->title}}</b>
					<small></small>
				</div>
				<div class="icon">
					<i class="fa fa-sign-in"></i>
				</div>
			</div>
			<!-- end login-header -->
			<!-- begin login-content -->
			<div class="login-content">
				<form action="{{ route('login') }}" method="POST" class="margin-bottom-0">
					@csrf
					<div class="form-group m-b-15">
						<input type="text" class="form-control form-control-lg" name="username" placeholder="Username" required />
					</div>
					<div class="form-group m-b-15">
						<input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required />
					</div>
					<?php
					$a = rand(0,20);
					$b = rand(0,20);
					$c = $a + $b;
					?>
					<div class="form-group m-b-15 text-center">
						<h4>CAPTCHA : {{$a }} + {{$b}} =</h4>
					<input type="text" class="form-control form-control" name="captcha" required/>
					<input type="hidden" class="form-control form-control" name="captcha2" readonly value="{{$c}}"/>
					</div>
					{{-- <div class="checkbox checkbox-css m-b-30">
						<input type="checkbox" id="remember_me_checkbox" value="" />
						<label for="remember_me_checkbox">
							Remember Me
						</label>
					</div> --}}
					<div class="login-buttons">
						<button type="submit" class="btn btn-success btn-block btn-lg">Masuk</button>
					</div>
					{{-- <div class="m-t-20 m-b-40 p-b-40 text-inverse">
						Not a member yet? Click <a href="/register/v3" class="text-success">here</a> to register.
					</div> --}}
					<hr />
					<p class="text-center text-grey-darker">
						{{-- Dev &copy; Tim Programmer Diskominfotik --}}
					</p>
				</form>
			</div>
			<!-- end login-content -->
		</div>
		<!-- end right-container -->
	</div>
	<!-- end login -->
@endsection
