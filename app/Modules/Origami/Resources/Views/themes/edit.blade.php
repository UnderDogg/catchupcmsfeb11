@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.theme', 1) }} :: @parent
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
	<a href="/admin/themes" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
		{{ trans('kotoba::general.command.edit') }}:&nbsp;{{ Lang::choice('kotoba::cms.theme', 1) }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::open([
	'route' => array('themes.update', $slug)
]) !!}
{!! Form::hidden('activeTheme', $activeTheme) !!}


	<div class="form-group">
		<label for="name">{{ trans('kotoba::general.name') }}</label>
		<input type="text" class="form-control" name="name" id="name" value="{{ $name }}" autofocus="autofocus">
	</div>


	<div class="form-group">
		<label for="slug">{{ trans('kotoba::general.slug') }}</label>
		<input type="text" class="form-control" name="slug" id="slug" value="{{ $slug }}">
	</div>


	<div class="form-group">
		<label for="description">{{ trans('kotoba::general.description') }}</label>
		<input type="text" class="form-control" name="description" id="description" value="{{ $description }}">
	</div>


	<div class="form-group">
		<label for="author">{{ trans('kotoba::general.author') }}</label>
		<input type="text" class="form-control" name="author" id="author" value="{{ $author }}">
	</div>


	<div class="form-group">
		<label for="version">{{ trans('kotoba::general.version') }}</label>
		<input type="text" class="form-control" name="version" id="version" value="{{ $version }}">
	</div>


	<label class="checkbox-inline">
		<input type="checkbox" id="enabled" name="enabled" value="1" {{ $checked }}>
		&nbsp;{{ trans('kotoba::general.enable') }}
	</label>

</div>


<hr>


<div class="row">
<div class="col-sm-12">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>
</div>

<br>

<div class="row">
<div class="col-sm-6">
	<a href="/admin/themes" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
		<i class="fa fa-times fa-fw"></i>
		{{ trans('kotoba::button.cancel') }}
	</a>
</div>

<div class="col-sm-6">
	<input class="btn btn-default btn-block" type="reset" value="{{ trans('kotoba::button.reset') }}">
</div>
</div>


{!! Form::close() !!}

</div> <!-- ./ row -->


@stop
