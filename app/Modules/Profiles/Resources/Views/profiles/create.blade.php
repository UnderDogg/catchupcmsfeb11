@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::account.profile', 2) }} :: @parent
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
	<a href="/profiles" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ trans('kotoba::account.command.create') }}
	<hr>
</h1>
</div>


<div class="row">
{!! Form::open([
	'url' => 'profiles.store',
	'method' => 'POST',
	'class' => 'form'
]) !!}


<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-double-left fa-fw"></i></span>
		<input type="text" id="prefix" name="prefix" placeholder="{{ trans('kotoba::account.prefix') }}" class="form-control" autofocus="autofocus">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-left fa-fw"></i></span>
		<input type="text" id="first_name" name="first_name" placeholder="{{ trans('kotoba::account.first_name') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-arrows-h fa-fw"></i></span>
		<input type="text" id="middle_initial" name="middle_initial" placeholder="{{ trans('kotoba::account.middle_name') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-right fa-fw"></i></span>
		<input type="text" id="last_name" name="last_name" placeholder="{{ trans('kotoba::account.last_name') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-angle-double-right fa-fw"></i></span>
		<input type="text" id="suffix" name="suffix" placeholder="{{ trans('kotoba::account.suffix') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
		<input type="text" id="email_1" name="email_1" placeholder="{{ trans('kotoba::account.email_1') }}" class="form-control">
</div>
</div>
<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
		<input type="text" id="email_2" name="email_2" placeholder="{{ trans('kotoba::account.email_2') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
		<input type="text" id="phone_1" name="phone_1" placeholder="{{ trans('kotoba::account.phone_1') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-fax fa-fw"></i></span>
		<input type="text" id="phone_2" name="phone_2" placeholder="{{ trans('kotoba::account.phone_2') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-phone-square fa-fw"></i></span>
		<input type="text" id="phone_extension" name="phone_extension" placeholder="{{ trans('kotoba::account.extension') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-road fa-fw"></i></span>
		<input type="text" id="address" name="address" placeholder="{{ trans('kotoba::account.address') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
		<input type="text" id="city" name="city" placeholder="{{ trans('kotoba::account.city') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-star fa-fw"></i></span>
		<input type="text" id="state" name="state" placeholder="{{ trans('kotoba::account.state') }}" class="form-control">
</div>
</div>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-paper-plane fa-fw"></i></span>
		<input type="text" id="zipcode" name="zipcode" placeholder="{{ trans('kotoba::account.zipcode') }}" class="form-control">
</div>
</div>

<hr>

<div class="form-group">
<div class="input-group">
	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
		<input type="text" id="notes" name="notes" placeholder="{{ Lang::choice('kotoba::general.notes', 2) }}" class="form-control">
</div>
</div>


{{--
<div class="form-group">
	<label for="inputLogo" class="col-sm-2 control-label">{{ trans('lingos::account.picture') }}:</label>
	<div class="col-sm-4">
		<div class="logo-container">
			@if ($picture)
				{{ Form::hidden('picture', $profile->picture) }}

				<img
						src="{{ $profile->picture }}"
					alt="{{ Auth::user()->email }}"
					class="img-circle profile"
				/>

			@else
				<span class="logo-alt">{{ trans('lingos::account.error.logo') }}</span>
			@endif
		</div>
	</div>
	<div class="col-sm-6">
		{{ Form::file('picture') }}
	</div>
</div>
--}}



<hr>

<div class="row">
<div class="col-sm-12">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>
</div>

<br>

<div class="row">
<div class="col-sm-6">
	<a href="/profiles" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
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
