@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::general.menu', 2) }} :: @parent
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
	<a href="/admin/menus" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::general.command.create') }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::open([
	'url' => 'admin/menus',
	'method' => 'POST',
	'class' => 'form-horizontal'
]) !!}

<div class="col-sm-6">

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

		<div class="form-group">
			<label for="title">{{ trans('kotoba::general.title') }}</label>
			<input type="text" class="form-control" name="{{ 'title_'. $language->id }}" id="{{ 'title_'. $language->id }}" placeholder="{{ trans('kotoba::general.title') }}" autofocus="autofocus">
		</div>

		<div class="form-group">
			<div class="checkbox">
					{{ trans('kotoba::general.enabled') }}
					&nbsp;
					<input type="radio" name="{{ 'status_'. $language->id }}"  name="{{ 'status_'. $language->id }}" value="1">
					&nbsp;
					{{ trans('kotoba::general.disabled') }}
					&nbsp;
					<input type="radio" name="{{ 'status_'. $language->id }}"  name="{{ 'status_'. $language->id }}" value="1">
			</div>
		</div>

	</div><!-- ./ $lang panel -->
	@endforeach

	@endif
	</div><!-- tabcontent -->

</div>
<div class="col-sm-6 margin-top-xl">

	<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
			<input type="text" id="name" name="name" placeholder="{{ trans('kotoba::account.name') }}" class="form-control">
	</div>
	</div>


	<div class="form-group">
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-css3 fa-fw"></i></span>
			<input type="text" id="class" name="class" placeholder="{{ trans('kotoba::cms.class') }}" class="form-control">
	</div>
	</div>

</div>


<hr>


<div class="form-group">
<div class="col-sm-12">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>
</div>

<div class="row">
<div class="col-sm-6">
	<a href="/admin/menus" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
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
