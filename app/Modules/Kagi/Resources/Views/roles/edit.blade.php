@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::role.role', 2) }} :: @parent
@stop

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/multi-select_v0_9_12/css/multi-select.css') }}">
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/vendors/multi-select_v0_9_12/js/jquery.multi-select.js') }}"></script>
@stop

@section('inline-scripts')
	jQuery(document).ready(function($) {
		$('#my-select').multiSelect(
			{
				selectableHeader: "<div class='bg-primary padding-md'>{{ trans('kotoba::general.available') }}</div>",
				selectionHeader: "<div class='bg-primary padding-md'>{{ trans('kotoba::general.assigned') }}</div>"
			}
		)
	});
@stop


{{-- Content --}}
@section('content')


<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/roles" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::role.command.edit') }}
	<hr>
</h1>
</div>

<div class="row">
{!! Form::model(
	$role,
	[
		'route' => ['admin.roles.update', $role->id],
		'method' => 'PATCH',
		'class' => 'form'
	]
) !!}

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-gavel fa-fw"></i></span>
		<input type="text" id="name" name="name" value="{{ $role->name }}" placeholder="{{ trans('kotoba::account.name') }}" class="form-control" autofocus="autofocus">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-bookmark fa-fw"></i></span>
		<input type="text" id="slug" name="slug" value="{{ $role->slug }}" placeholder="{{ trans('kotoba::general.slug') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i></span>
		<input type="text" id="description" name="description" value="{{ $role->description }}" placeholder="{{ trans('kotoba::general.description') }}" class="form-control">
</div>
</div>


<hr>


<h3>
	<i class="fa fa-gavel fa-fw"></i>
	{{ Lang::choice('kotoba::permission.permission', 2) }}
</h3>
<select multiple="multiple" id="my-select" name="my-select[]">
@foreach ($allPermissions as $key => $value)
	@if (isset($permissions[$key]) )
		<option value='{{ $key }}' selected>{{ $value }}</option>
	@else
		<option value='{{ $key }}'>{{ $value }}</option>
	@endif
@endforeach
</select>


<hr>


<div class="row">
<div class="col-sm-12">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>
</div>

<br>

<div class="row">
<div class="col-sm-4">
	<a href="/admin/roles" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-4">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>

<div class="col-sm-4">
	<a class="btn btn-danger btn-block action_confirm" data-method="delete" title="{{ trans('kotoba::general.command.delete') }}" onclick="">
		<i class="fa fa-trash-o fa-fw"></i>
		{{ trans('kotoba::general.command.delete') }}
	</a>
</div>
</div>

{!! Form::close() !!}

</div> <!-- ./ row -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	@include($activeTheme . '::' . '_partials.modal')
</div>

@stop
