@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.theme', 2) }} :: @parent
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
	});
});
@stop



{{-- Content --}}
@section('content')

<div class="row">
<h1>
	<i class="fa fa-gears fa-lg"></i>
		{{ trans('kotoba::general.active') }}:&nbsp;{{ $activeTheme }}
	<hr>
</h1>
</div>


@if (count($collection))

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.slug') }}</th>
			<th>{{ trans('kotoba::table.author') }}</th>
			<th>{{ trans('kotoba::table.description') }}</th>
			<th>{{ trans('kotoba::table.version') }}</th>
			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($themes as $theme)
			<tr>
				<td>{{ $collection[$theme]['name'] }}</td>
				<td>{{ $collection[$theme]['slug'] }}</td>
				<td>{{ $collection[$theme]['author'] }}</td>
				<td>{{ $collection[$theme]['description'] }}</td>
				<td>{{ $collection[$theme]['version'] }}</td>
				<td>
					<a href="/admin/themes/{{ $collection[$theme]['slug'] }}" class="btn btn-primary" title="{{ trans('kotoba::button.edit') }}">
						<i class="fa fa-pencil fa-fw"></i>
						{{ trans('kotoba::button.edit') }}
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>


@else
<div class="alert alert-info">
</div>
	{{ trans('kotoba::general.error.not_found') }}
@endif


</div>


@stop
