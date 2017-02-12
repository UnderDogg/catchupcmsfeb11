@if ( Auth::user() )
@if (Auth::user()->can('manage_shisan'))
@if ( Module::exists('shisan') )


@if (count($site->assets))

<h3>
	{{ Lang::choice('kotoba::shop.asset', 2) }}
</h3>

<div class="row">
<table id="table_assets" class="table table-striped table-hover">
	<thead>
		<tr>
			<th>{{ Lang::choice('kotoba::table.item', 1) }}</th>
			<th>{{ Lang::choice('kotoba::table.room', 1) }}</th>
			<th>{{ trans("kotoba::table.asset_tag") }}</th>
			<th>{{ Lang::choice('kotoba::table.user', 1) }}</th>
			<th>{{ trans("kotoba::table.status") }}</th>

			<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($assets as $asset)
		<tr>
			<td>
				{{-- $asset->present()->itemName($asset->item_id) --}}
				{{ $asset->make }}&nbsp;{{ $asset->model }}&nbsp;{{ $asset->model_number }}
			</td>
			<td>
				{{-- $asset->present()->roomName($asset->room_id) --}}
				{{ $asset->name }}
			</td>
			<td>
				{{ $asset->asset_tag }}
			</td>
			<td>
				{{-- $asset->present()->employeeName($asset->user_id) --}}
				{{ $asset->last_name }},&nbsp;{{ $asset->first_name }}&nbsp;{{ $asset->middle_initial }}
			</td>
			<td>
				{{-- $asset->present()->techStatus($asset->tech_status_id, $locale_id) --}}
				{{ $asset->status_id == 1 ? trans('kotoba::general.enabled') : trans('kotoba::general.disabled') }}
			</td>
			<td>
				<a href="{{ URL::to('/admin/assets/' . $asset->id . '/edit' ) }}" class="btn btn-success" >
					<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
				</a>
				<a href="{{ URL::to('/admin/assets/' . $asset->id ) }}" class="btn btn-info" >
					<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>

@else
	<div class="alert alert-info">
		{{ trans('kotoba::general.no_records') }}
	</div>
@endif


@endif
@endif
@endif
