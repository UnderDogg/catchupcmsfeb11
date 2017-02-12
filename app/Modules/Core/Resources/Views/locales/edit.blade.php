@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.locale', 2) }} :: @parent
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('inline-scripts')
@stop


{{-- Content --}}
@section('content')


<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/locales" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::general.command.edit') }}
	<hr>
</h1>
</div>

<div class="row">
{!! Form::model(
	$locale,
	[
		'route' => ['admin.locales.update', $locale->id],
		'method' => 'PATCH',
		'class' => 'form'
	]
) !!}

	<div class="form-group">
		<label for="title">{{ trans('kotoba::cms.locale') }}</label>
		<input type="text" class="form-control" name="locale" id="locale" value="{{ $locale->locale }}" autofocus="autofocus">
	</div>

	<div class="form-group">
		<label for="title">{{ trans('kotoba::general.name') }}</label>
		<input type="text" class="form-control" name="name" id="name" value="{{ $locale->name }}">
	</div>

	<div class="form-group">
		<label for="title">{{ trans('kotoba::cms.script') }}</label>
		<input type="text" class="form-control" name="script" id="script" value="{{ $locale->script }}">
	</div>

	<div class="form-group">
		<label for="title">{{ trans('kotoba::cms.native') }}</label>
		<input type="text" class="form-control" name="native" id="native" value="{{ $locale->native }}">
	</div>

	<div class="form-group">
		<label for="is_timed" class="col-sm-1 control-label">{{ trans('kotoba::general.active') }}</label>
		<div class="col-sm-11">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="active" name="active" value="1" {{ $locale->present()->checked($locale->active) }}>
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label for="is_timed" class="col-sm-1 control-label">{{ trans('kotoba::general.default') }}</label>
		<div class="col-sm-11">
			<div class="checkbox">
				<label>
					<input type="checkbox" id="default" name="default" value="1" {{ $locale->present()->checked($locale->default) }}>
				</label>
			</div>
		</div>
	</div>


<hr>


<div class="row">
<div class="col-sm-12">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>
</div>

<br>

<div class="row">
<div class="col-sm-4">
	<a href="/admin/locales" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-4">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>

<div class="col-sm-4">
<!-- Button trigger modal -->
	<a data-toggle="modal" data-target="#myModal" class="btn btn-default btn-block" title="{{ trans('kotoba::button.delete') }}">
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
