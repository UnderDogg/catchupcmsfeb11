@extends($theme_back)

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
		"processing": true,
		"serverSide": true,
		"ajax": "{{ URL::to('/admin/api/sites') }}",
		"columns": [
			{
				data: 'id',
				name: 'id',
				orderable: true,
				searchable: false,
				visible: false
			},
			{
				data: 'name',
				name: 'name',
				orderable: true,
				searchable: true
			},
			{
				data: 'address',
				name: 'address',
				orderable: true,
				searchable: true
			},
			{
				data: 'phone_1',
				name: 'phone_1',
				orderable: true,
				searchable: true
			},
			{
				data: 'website',
				name: 'website',
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
	@if ( Auth::user() )
		@if ( (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_core')) )
			<p class="pull-right">
			<a href="/admin/sites/create" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
				<i class="fa fa-plus fa-fw"></i>
				{{ trans('kotoba::button.new') }}
			</a>
			</p>
		@endif
	@endif
	<i class="fa fa-angle-double-right fa-lg"></i>
		{{ Lang::choice('kotoba::hr.site', 2) }}
	<hr>
</h1>
</div>

<div class="row">
<table id="table" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ trans('kotoba::table.id') }}</th>
			<th>{{ trans('kotoba::table.name') }}</th>
			<th>{{ trans('kotoba::table.address') }}</th>
			<th>{{ trans('kotoba::table.phone') }}</th>
			<th>{{ trans('kotoba::table.website') }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
</div>

</div> <!-- ./ row -->
@stop
