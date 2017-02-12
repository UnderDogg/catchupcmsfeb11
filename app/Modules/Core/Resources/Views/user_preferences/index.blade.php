@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.user_preference', 2) }} :: @parent
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
	<p class="pull-right">
	<a href="/admin/user_preferences/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-paperclip fa-lg"></i>
		{{ Lang::choice('kotoba::cms.user_preference', 2) }}
	<hr>
</h1>
</div>

@if (count($user_preferences))

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.value') }}</th>
			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($user_preferences as $user_preference)
			<tr>
				<td>
					{{ $user_preference->key }}
				</td>
				<td>
					{{ UserPreference::get($user_preference->key) }}
				</td>
				<td>
					<a href="/admin/user_preferences/{{ $user_preference->key }}/edit" class="btn btn-success" title="{{ trans('kotoba::button.edit') }}">
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
	{{ trans('kotoba::general.error.not_found') }}
</div>
@endif

</div>
@stop
