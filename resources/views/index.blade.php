@extends('main')

@section('content-page')
	<section id="hero" class="d-flex align-items-center">
		<div class="container" data-aos="zoom-out" data-aos-delay="100">
			<h1>Selamat datang di <br> <span>Gema Lintas Semesta</span></h1>
			<h2>Kirimkan paket Anda dengan mudah dan cepat</h2>

			<form action="{{ route('front.tracking.post') }}" method="POST" class="d-flex">
				@csrf

				<div class="d-inline w-50" style="">
					<input type="text" class="form-control w-100 p-3 @if(old('tracking_number')) is-invalid @endif" name="tracking_number" placeholder="Tracking Number" value="{{ old('tracking_number') }}" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" required>

					@if ($errors->has('tracking_number'))
						<span class="text-danger mt-2 d-block">{{ $errors->first('tracking_number') }}</span>
					@endif
				</div>
				<div class="d-inline">
					<button class="btn btn-primary w-100 p-3" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
						Track Now
					</button>
				</div>
			</form>
		</div>
	</section>
@endsection