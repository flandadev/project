@extends('layouts.master', ['title' => 'FLANDA', 'bodyClass' => 'pattern'])
@section('styles')
	{{ Html::style('/css/home.min.css') }}
	{{ Html::style('/css/events.min.css') }}
@endsection
@section('content')
	<section class="section fp no-pad">
		<a href="/" data-build="#flanda" data-local="#flanda">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 464.84 85.14" class="logo">
			    <title> FLANDA </title>
			    <g id="Layer_2" data-name="Layer 2">
			        <g id="Layer_2-2" data-name="Layer 2">
			            <polygon class="cls-1" points="295.26 3.03 295.88 0 289.71 3 295.26 3.03" />
			            <g id="Shadows">
			                <path class="cls-1" d="M17.38,3.11H75.62L72.55,17.54H31.37l-4,18.89H63.41l-3,14.27H24.35l-7.3,34.44H0Z" />
			                <path class="cls-1" d="M87.15,3h17.16L90,70.37h40.68l-3.12,14.77H69.71Z" />
			                <path class="cls-1" d="M180.38,3h19.39l11.65,82.14H192.8l-1.73-16.88H160.82l-9.25,16.88H133.63ZM168.45,54.1h20.84l-3.4-32.32Z" />
			                <path class="cls-1" d="M239,3h18L277.5,60.34,289.71,3h16L288.26,85.14H271.09L249.92,26.79,237.55,85.14h-16Z" />
			                <path class="cls-1" d="M369.39,4.78A20.11,20.11,0,0,1,381.15,15.2a30,30,0,0,1,3,13.26,65.7,65.7,0,0,1-1.31,13.6q-3.51,16.38-12.48,27.75-12.15,15.32-30.76,15.32H304.25L321.69,3h35.38A39.53,39.53,0,0,1,369.39,4.78Zm-34.1,12.48L323.92,70.87h15.83q12.15,0,19.5-12a49.11,49.11,0,0,0,5.91-15.66q2.67-12.54.17-19.25t-14.21-6.71Z" />
			                <path class="cls-1" d="M427.62,3H447l11.65,82.14H440l-1.73-16.88H408.06l-9.25,16.88H380.87ZM415.7,54.1h20.84l-3.4-32.32Z" />
			            </g>
			            <g id="TExt">
			                <path class="cls-2" d="M23.56.11H81.79L78.73,14.54H37.55l-4,18.89H69.59l-3,14.27H30.53l-7.3,34.44H6.17Z" />
			                <path class="cls-3" d="M93.33,0h17.16L96.17,67.37h40.68l-3.12,14.77H75.88Z" />
			                <path class="cls-3" d="M186.55,0h19.39l11.65,82.14H199l-1.73-16.88H167l-9.25,16.88H139.8ZM174.63,51.1h20.84l-3.4-32.32Z" />
			                <path class="cls-3" d="M245.17,0h18l20.51,57.34L295.88,0h16L294.43,82.14H277.27L256.09,23.79,243.72,82.14h-16Z" />
			                <path class="cls-3" d="M375.57,1.78A20.11,20.11,0,0,1,387.32,12.2a30,30,0,0,1,3,13.26A65.71,65.71,0,0,1,389,39.06q-3.51,16.38-12.48,27.75-12.15,15.32-30.76,15.32H310.42L327.87,0h35.38A39.53,39.53,0,0,1,375.57,1.78Zm-34.1,12.48L330.09,67.87h15.83q12.15,0,19.5-12a49.12,49.12,0,0,0,5.91-15.66Q374,27.69,371.5,21t-14.21-6.71Z" />
			                <path class="cls-3" d="M433.8,0h19.39l11.65,82.14H446.22L444.5,65.25H414.24L405,82.14H387ZM421.87,51.1h20.84l-3.4-32.32Z" />
			            </g>
			            <polygon class="cls-1" points="239 3 244.54 3 245.17 0 239 3" />
			            <polygon class="cls-1" points="288.26 85.14 294.43 82.14 288.65 82.14 288.26 85.14" />
			            <polygon class="cls-1" points="237.55 85.14 243.72 82.14 238.04 82.14 237.55 85.14" />
			            <polygon class="cls-1" points="186.55 0 184.84 3 180.38 3 186.55 0" />
			            <polygon class="cls-1" points="151.57 85.14 157.74 82.14 153.21 82.14 151.57 85.14" />
			            <polygon class="cls-1" points="211.41 85.14 217.59 82.14 210.99 82.14 211.41 85.14" />
			            <polygon class="cls-1" points="433.8 0 432.09 3 427.62 3 433.8 0" />
			            <polygon class="cls-1" points="398.81 85.14 404.99 82.14 400.46 82.14 398.81 85.14" />
			            <polygon class="cls-1" points="458.66 85.14 464.83 82.14 458.24 82.14 458.66 85.14" />
			            <polygon class="cls-1" points="321.69 3 327.23 3 327.87 0 321.69 3" />
			            <polygon class="cls-1" points="127.55 85.14 133.73 82.14 128.19 82.14 127.55 85.14" />
			            <polygon class="cls-1" points="87.15 3 92.69 3 93.33 0 87.15 3" />
			            <polygon class="cls-1" points="60.4 50.7 66.58 47.7 61.04 47.7 60.4 50.7" />
			            <polygon class="cls-1" points="72.55 17.54 78.73 14.54 73.19 14.54 72.55 17.54" />
			            <polygon class="cls-1" points="17.39 3.11 22.95 3 23.56 0.11 17.39 3.11" />
			            <polygon class="cls-1" points="17.05 85.14 23.23 82.14 17.69 82.14 17.05 85.14" />
			        </g>
			    </g>
			</svg>
		</a>
		<span class="sub-title">
			{{ isset($latestEvent->name) ? $latestEvent->name : 'STAY TUNED' }}
		</span>
	</section>
	@if (count($events))
		@foreach ($events as $event)
			<div class="section fp event">
				<div class="event--container">
					<img src="{{ $event->flyer }}" alt="{{ $event->name }}" title="{{ $event->name }}">
					@if ($event->tickets > $event->sold_tickets)
						<a title="Get tickets for {{ $event->name }}"  href="/checkout/{{ $event->event_token }}" class="buy-btn get-tickets">
							GET TICKETS
						</a>
					@endif
					<div class="event--descr">
						<p>
							{{ $event->descr }}
						</p>
					</div>
				</div>
			</div>
		@endforeach
	@endif
@endsection
@section('scripts')
	{{ Html::script('/js/sessions.js') }}
@endsection
