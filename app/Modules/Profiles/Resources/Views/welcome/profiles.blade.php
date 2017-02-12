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
				<img src="/assets/images/usr.png" class="img-responsive">
			</a>
			<div class="title">
				<a href="/">
					Profiles
				</a>
			</div>
			<div class="quote">
				Profiles is a Rakko module that extends the ability to add User Profiles
			</div>
		</div>
	</div>

@stop
