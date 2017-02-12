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
				<img src="/assets/images/kantoku.gif" class="img-responsive">
			</a>
			<div class="title">
				<a href="/">
					Kantoku
				</a>
			</div>
			<div class="quote">
				Kantoku is a Rakko module that provides the ability to manage modules
			</div>
		</div>
	</div>

@stop
