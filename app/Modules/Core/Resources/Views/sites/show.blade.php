@extends($theme_back)

{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.site', 2) }} :: @parent
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
	$('#table_rooms').dataTable({
		'pageLength': 25
	});
	$('#table_employees').dataTable({
		'pageLength': 25
	});
	$('#table_assets').dataTable({
		'pageLength': 25
	});
});
@stop


{{-- Content --}}
@section('content')


<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/sites" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	@if ( Auth::user() )
		@if ( (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_core')) )
			<a href="/admin/sites/{{ $site->id }}/edit" class="btn btn-success" title="{{ trans('kotoba::button.edit') }}">
				<i class="fa fa-pencil fa-fw"></i>
				{{ trans('kotoba::button.edit') }}
			</a>
		@endif
	@endif
	</p>
	<i class="fa fa-university fa-lg"></i>
	{{ $site->name }}
	<hr>
</h1>
</div>


{{--
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified" role="tablist">
	<li role="presentation" class="active">
		<a href="#site_info" aria-controls="site_info" role="tab" data-toggle="tab">
		<i class="fa fa-building-o fa-lg"></i>
		{{ Lang::choice('kotoba::cms.site', 1) }}&nbsp;{{ trans('kotoba::general.information') }}
		</a>
	</li>
	<li role="presentation">
		<a href="#employee_info" aria-controls="employee_info" role="tab" data-toggle="tab">
		<i class="fa fa-user fa-lg"></i>
		{{ Lang::choice('kotoba::hr.employee', 2) }}
		</a>
	</li>
	<li role="presentation">
		<a href="#rooms" aria-controls="rooms" role="tab" data-toggle="tab">
		<i class="fa fa-plug fa-lg"></i>
		{{ Lang::choice('kotoba::general.room', 2) }}
		</a>
	</li>
	<li role="presentation">
		<a href="#assets" aria-controls="assets" role="tab" data-toggle="tab">
		<i class="fa fa-cubes fa-lg"></i>
		{{ Lang::choice('kotoba::shop.asset', 2) }}
		</a>
	</li>
</ul>

<!-- Tab panes -->
<div class="tab-content padding">

	<div role="tabpanel" class="tab-pane active" id="site_info">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.site_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ user_info panel -->

	<div role="tabpanel" class="tab-pane" id="employee_info">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.employee_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ work_info panel -->

	<div role="tabpanel" class="tab-pane" id="rooms">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.room_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ published panel -->

	<div role="tabpanel" class="tab-pane" id="assets">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.asset_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ published panel -->

</div><!-- ./ tab panes -->
--}}



<div class="row">

<ul class="nav nav-pills nav-stacked col-sm-2">
	<li role="presentation" class="active">
		<a href="#site_info" aria-controls="site_info" role="tab" data-toggle="tab">
		<i class="fa fa-building-o fa-lg"></i>
		{{ Lang::choice('kotoba::cms.site', 1) }}&nbsp;{{ trans('kotoba::general.information') }}
		</a>
	</li>
	<li role="presentation">
		<a href="#employee_info" aria-controls="employee_info" role="tab" data-toggle="tab">
		<i class="fa fa-user fa-lg"></i>
		{{ Lang::choice('kotoba::hr.employee', 2) }}
		</a>
	</li>
	<li role="presentation">
		<a href="#rooms" aria-controls="rooms" role="tab" data-toggle="tab">
		<i class="fa fa-plug fa-lg"></i>
		{{ Lang::choice('kotoba::general.room', 2) }}
		</a>
	</li>
	<li role="presentation">
		<a href="#assets" aria-controls="assets" role="tab" data-toggle="tab">
		<i class="fa fa-cubes fa-lg"></i>
		{{ Lang::choice('kotoba::shop.asset', 2) }}
		</a>
	</li>
</ul>

	<div class="tab-content col-sm-10">

	<div role="tabpanel" class="tab-pane active" id="site_info">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.site_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ user_info panel -->

	<div role="tabpanel" class="tab-pane" id="employee_info">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.employee_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ work_info panel -->

	<div role="tabpanel" class="tab-pane" id="rooms">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.room_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ published panel -->

	<div role="tabpanel" class="tab-pane" id="assets">
	<div class="tab-content padding-md">
		@include('core::_partials._sites._show.asset_info')
	</div><!-- ./ tab-content -->
	</div><!-- ./ published panel -->

	</div>

</div>
<!-- /tabs -->

@stop
