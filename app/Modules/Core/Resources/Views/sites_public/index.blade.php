@extends($theme_front)

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::hr.site', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/DataTables-1.10.7/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
@stop

@section('scripts')
	<script src="{{ asset('assets/vendors/DataTables-1.10.7/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/DataTables-1.10.7/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
@stop

@section('inline-scripts')
$(document).ready(function() {
oTable =
	$('#table').DataTable({
		'pageLength': 25,
	});
});
@stop


{{-- Content --}}
@section('content')

<div class="container-fluid padding-left-xl padding-right-xl">

<div class="row">
<h1>
	<p class="pull-right">
		@if ( Auth::user() )
			@if ( (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_core')) )
				<a href="/admin/sites/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
					<i class="fa fa-plus fa-fw"></i>
					{{ trans('kotoba::button.new') }}
				</a>
			@endif
		@endif
		<a href="/staff" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
			<i class="fa fa-chevron-left fa-fw"></i>
			{{ trans('kotoba::button.back') }}
		</a>
	</p>
	<i class="fa fa-angle-double-right fa-lg"></i>
		{{ Lang::choice('kotoba::hr.site', 2) }}
	<hr>
</h1>
</div>

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.address') }}</th>
			<th>{{ trans('kotoba::table.phone') }}</th>
{{--
			<th>{{ trans('kotoba::table.website') }}</th>
--}}
			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($sites as $site)
			<tr>
				<td>{{ $site->name }}</td>
				<td>
					@if ( $site->address != 'NULL' )
						{{ $site->address }}
					@endif
				</td>
				<td>
					@if ( $site->phone_1 != 'NULL' )
						{{ $site->phone_1 }}
					@endif
				</td>
{{--
				<td>
					@if ( $site->website != 'NULL' )
						<a href="http://{{ $site->website }}" title="{{ $site->name }}">
						{{ $site->website }}
						</a>
					@endif
				</td>
--}}
				<td>
					<a href="/sites/{{ $site->id }}" class="btn btn-success" title="{{ trans('kotoba::button.view') }}">
						<i class="fa fa-search fa-fw"></i>
						{{ trans('kotoba::button.view') }}
					</a>
					@if ( $site->website != 'NULL' && !empty($site->website) )
						<a href="http://{{ $site->website }}" title="{{ $site->name }}" class="btn btn-primary">
						<i class="fa fa-sign-in fa-fw"></i>
						{{ $site->website }}
						</a>
					@endif
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>

</div> <!-- ./ row -->

</div><!-- ./container -->


@stop
