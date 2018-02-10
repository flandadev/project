<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title> {!! isset($title) ? $title : 'Laravel' !!} </title>

	{!! Html::style('assets/bower/bootstrap/dist/css/bootstrap.min.css') !!}
	{!! Html::style('assets/bower/font-awesome/css/font-awesome.min.css') !!}
	{!! Html::style('css/master.min.css') !!}


	@if (isset($isAdmin) && $isAdmin == true)
		{!! Html::style('css/admin.min.css') !!}
		{!! Html::style('css/dashboard/stellarnav.min.css') !!}
	@endif

	@yield('styles')
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}" {{ (isset($isAdmin) && $isAdmin == true) ? "onload=getStatistics()" : '' }}>
	<div id="app">
		@if (isset($isAdmin) && $isAdmin == true)
			@php($status = App::isDownForMaintenance() ? 'off' : 'on')
    		@include('layouts.admin-nav')
			@include('layouts.sessions')
		@endif

		@yield('content')
	</div>


	{!! Html::script('assets/bower/jquery/dist/jquery.min.js') !!}
	{!! Html::script('assets/bower/popper.js/dist/umd/popper.min.js') !!}
	{!! Html::script('assets/bower/bootstrap/dist/js/bootstrap.min.js') !!}

	@if (isset($isAdmin) && $isAdmin == true)
		{!! Html::script('/js/dashboard/bootstrap-notify.js') !!}
		{!! Html::script('/js/dashboard/chartist.min.js')     !!}
		{!! Html::script('js/dashboard/stellarnav.min.js')    !!}

		<script type="text/javascript">
			function getStatistics() {
			    $.get('/api/stats').done(response => {
			        let data = JSON.parse(response);
			        let isS =  (data.active_users > 1 || data.active_users == 0) ? 's' : '';
			        let msg = data.active_users + ' active user' + isS;

			        setTimeout(function() {
			        	$('#loader').fadeOut(500);
			        	$('#stats').html(`<h3> ${msg} </h3>`);
			        }, 1500);
			    })
			}

			$(document).ready(function() {
				setTimeout(function () {
					$('.alert.alert-dismissible').fadeOut(1000);
				}, 2500);
			});

			$('#admin-navbar').stellarNav({
				theme: 'plain',
				scrollbarFix: true
			})
		</script>
	@endif
	@yield('scripts')
</body>
</html>
