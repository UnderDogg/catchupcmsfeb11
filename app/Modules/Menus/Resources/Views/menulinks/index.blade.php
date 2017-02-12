@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.link', 2) }} :: @parent
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

<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/menus" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	<a href="/admin/menulinks/create/{{ $create_id }}" class="btn btn-primary" title="{{ trans('kotoba::button.new') }}">
		<i class="fa fa-plus fa-fw"></i>
		{{ trans('kotoba::button.new') }}
	</a>
	</p>
	<i class="fa fa-chain fa-lg"></i>
	{{ Lang::choice('kotoba::cms.link', 2) }}
	<hr>
</h1>
</div>


<div class="tab-content">
@if (count($languages))

<ul class="nav nav-tabs">
	@foreach( $languages as $language)
		<li class="@if ($language->locale == $lang)active @endif">
			<a href="#{{ $language->id }}" data-target="#lang_{{ $language->id }}" data-toggle="tab">{{{ $language->name }}}</a>
		</li>
	@endforeach
</ul>

@foreach( $languages as $language)
<div role="tabpanel" class="tab-pane padding fade @if ($language->locale == $lang)in active @endif" id="lang_{{{ $language->id }}}">

	@if (count($links))

	<div class="row padding-top-md">
	<table id="table" class="table table-striped table-hover">
		<thead>
			<tr>
				<th>{{ trans('kotoba::table.title') }}</th>
				<th>{{ trans('kotoba::table.url') }}</th>
				<th>{{ trans('kotoba::table.position') }}</th>
				<th>{{ trans('kotoba::table.menu') }}</th>
				<th>{{ trans('kotoba::table.status') }}</th>
				<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($links as $link)
				<tr>
					<td>
						{{ $link->translate($language->locale)->title }}
					</td>
					<td>
						{{ $link->translate($language->locale)->url }}
					</td>
					<td>
						{{ $link->position }}
					</td>
					<td>
						{{ $link->present()->menuName($link->menu_id) }}
						{{-- $link->menu_id --}}
					</td>
					<td>
						{{ $link->present()->status( $link->translate($language->locale)->status ) }}
						{{-- $link->translate($language->locale)->status --}}
					</td>
					<td>
						<a href="/admin/menulinks/{{ $link->id }}/edit" class="btn btn-success" title="{{ trans('kotoba::button.edit') }}">
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

</div><!-- ./ $lang panel -->
@endforeach

@endif
</div><!-- tabcontent -->


@stop
