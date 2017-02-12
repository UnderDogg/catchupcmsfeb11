@extends('module_info')

{{-- Web site Title --}}
@section('title')
{{ Config::get('core.title') }} :: @parent
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('inline-scripts')
@stop


{{-- Content --}}
@section('content')

	<div class="container">
		<div class="content">
			<a href="/">
				<img src="/assets/images/menus.png" class="img-responsive">
			</a>
			<div class="title">
				<a href="/">
					Menus
				</a>
			</div>
			<div class="quote">
				This module provides a way to display menus or navigational methods in your application.
				the display methods are based on vespakoen's menu package.
			</div>
		</div>
	</div>

@stop
