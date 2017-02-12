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
				<img src="/assets/images/kagi.png" class="img-responsive">
			</a>
			<div class="title">
				<a href="/">
					Kagi
				</a>
			</div>
			<div class="quote">
				鍵 : kagi
				<br>
				noun - key also can refer to the lock itself
				<br>
				Authentication, Authorization and User Mangement Module for Rakko
			</div>
		</div>
	</div>

@stop
