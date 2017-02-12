@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.user', 2) }} :: @parent
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
		stateSave: true,
		'pageLength': 25,
		"processing": true,
		"serverSide": true,
		"ajax": "{{ URL::to('admin/api/users') }}",
		"columns": [
			{
				data: 'id',
				name: 'users.id',
				searchable: false,
				visible: false
			},
			{
				data: 'name',
				name: 'users.name',
				orderable: true,
				searchable: true
			},
			{
				data: 'email',
				name: 'users.email',
				orderable: true,
				searchable: true
			},
			{
				data: 'blocked',
				name: 'users.blocked',
				orderable: true,
				searchable: false
			},
			{
				data: 'banned',
				name: 'users.banned',
				orderable: true,
				searchable: false
			},
			{
				data: 'confirmed',
				name: 'users.confirmed',
				orderable: true,
				searchable: false
			},
			{
				data: 'allow_direct',
				name: 'users.allow_direct',
				orderable: true,
				searchable: false
			},
			{
				data: 'activated',
				name: 'users.activated',
				orderable: true,
				searchable: false
			},
			{
				data: 'created_at',
				name: 'users.created_at',
				orderable: true,
				searchable: true
			},
			{
				data: 'actions',
				name: 'actions',
				orderable: false,
				searchable: false
			}
		]
	});
});
@stop


{{-- Content --}}
@section('content')


<div class="row">
<h1>
	<p class="pull-right">
	@if ( Module::exists('jinji') )
		<a href="/admin/employees/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
			<i class="fa fa-plus fa-fw"></i>
			{{ trans('kotoba::button.new') }}
		</a>
	@else
		<a href="/admin/users/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
			<i class="fa fa-plus fa-fw"></i>
			{{ trans('kotoba::button.new') }}
		</a>
	@endif
	</p>
	<i class="fa fa-users fa-lg"></i>
		{{ Lang::choice('kotoba::account.user', 2) }}
	<hr>
</h1>
</div>

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th></th>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.email') }}</th>
			<th>{{ trans('kotoba::table.blocked') }}</th>
			<th>{{ trans('kotoba::table.banned') }}</th>
			<th>{{ trans('kotoba::table.confirmed') }}</th>
			<th>{{ trans('kotoba::table.allow_direct') }}</th>
			<th>{{ trans('kotoba::table.activated') }}</th>
			<th>{{ trans('kotoba::table.created_at') }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
</div>

@stop
