@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::hr.site', 2) }} :: @parent
@stop

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/chosen_v1.4.2/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen_bootstrap.css') }}">
@stop

@section('scripts')
	<script type="text/javascript" src="{{ asset('assets/vendors/chosen_v1.4.2/chosen.jquery.min.js') }}"></script>
@stop

@section('inline-scripts')
jQuery(document).ready(function($) {
	$(".chosen-select").chosen({
		width: "100%"
	});
});

function setImage(select){
	var image = document.getElementsByName("image-swap")[0];
	image.src = select.options[select.selectedIndex].label;
		if ( image.src == "" ) {
			$("#imagePreview").append("displays image here");
		}
}
@stop


{{-- Content --}}
@section('content')


<div class="row">
<h1>
	<p class="pull-right">
	<a href="/admin/sites/{{ $site->id }}" class="btn btn-default" title="{{ trans('kotoba::button.back') }}">
		<i class="fa fa-chevron-left fa-fw"></i>
		{{ trans('kotoba::button.back') }}
	</a>
	</p>
	<i class="fa fa-edit fa-lg"></i>
	{{ $site->name }}
	<hr>
</h1>
</div>

<div class="row">
{!! Form::model(
	$site,
	[
		'route' => ['admin.sites.update', $site->id],
		'method' => 'PATCH',
		'files' => 'true',
		'class' => 'form'
	]
) !!}

<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified" role="tablist">
	<li role="presentation" class="active">
		<a href="#building_info" aria-controls="building_info" role="tab" data-toggle="tab">
		<i class="fa fa-building-o fa-lg"></i>
		{{ trans('kotoba::hr.building') }}&nbsp;{{ trans('kotoba::general.information') }}
		</a>
	</li>
	<li role="presentation">
		<a href="#images" aria-controls="images" role="tab" data-toggle="tab">
		<i class="fa fa-file-image-o fa-fw"></i>
		{{ Lang::choice('kotoba::cms.image', 2) }}
		</a>
	</li>
	<li role="presentation">
		<a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
		<i class="fa fa-gears fa-lg"></i>
		{{ Lang::choice('kotoba::general.setting', 2) }}
		</a>
	</li>
</ul>

<!-- Tab panes -->
<div class="tab-content padding">

	<div role="tabpanel" class="tab-pane active" id="building_info">
	<div class="tab-content padding-md">

		<div class="row margin-top-lg">

		<div class="col-sm-6">

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-gavel fa-fw"></i></span>
					<input type="text" id="name" name="name" value="{{ $site->name }}" placeholder="{{ trans('kotoba::account.name') }}" class="form-control" autofocus="autofocus">
			</div>
			</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-road fa-fw"></i></span>
					<input type="text" id="address" name="address" value="{{ $site->address }}" placeholder="{{ trans('kotoba::account.address') }}" class="form-control">
			</div>
			</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
					<input type="text" id="city" name="city" value="{{ $site->city }}" placeholder="{{ trans('kotoba::account.city') }}" class="form-control">
			</div>
			</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-star fa-fw"></i></span>
					<input type="text" id="state" name="state" value="{{ $site->state }}" placeholder="{{ trans('kotoba::account.state') }}" class="form-control">
			</div>
			</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-paper-plane fa-fw"></i></span>
					<input type="text" id="zipcode" name="zipcode" value="{{ $site->zipcode }}" placeholder="{{ trans('kotoba::account.zipcode') }}" class="form-control">
			</div>
			</div>

		</div>

		<div class="col-sm-6">

			<div class="form-group padding-bottom-xl">
				<label for="inputContact" class="col-sm-1 control-label">{{ trans('kotoba::general.contact') }}:</label>
				<div class="col-sm-11">
					{!!
						Form::select(
							'user_id',
							$contacts,
							$site->user_id,
							array(
								'class' => 'form-control chosen-select'
							)
						)
					!!}
				</div>
			</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span>
					<input type="text" id="phone_1" name="phone_1" value="{{ $site->phone_1 }}" placeholder="{{ trans('kotoba::account.phone_1') }}" class="form-control">
			</div>
			</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-fax fa-fw"></i></span>
					<input type="text" id="phone_2" name="phone_2" value="{{ $site->phone_2 }}" placeholder="{{ trans('kotoba::account.phone_2') }}" class="form-control">
			</div>
			</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
					<input type="text" id="email" name="email" value="{{ $site->email }}" placeholder="{{ trans('kotoba::general.email') }}" class="form-control">
			</div>
			</div>

				<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-building fa-fw"></i></span>
						<input type="text" id="bld_number" name="website" value="{{ $site->bld_number }}" placeholder="{{ trans('kotoba::hr.building') }} {{ Lang::choice('kotoba::general.number', 1) }}" class="form-control">
				</div>
				</div>

		</div>

		</div><!-- ./ row -->

		<div class="row">
		<div class="col-sm-12">

			<hr>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
					<textarea id="notes" name="notes" value="{{ $site->notes }}" placeholder="{{ Lang::choice('kotoba::general.note', 2) }}" class="form-control" rows="5"></textarea>
			</div>
			</div>

		</div>
		</div><!-- ./ row -->

	</div><!-- ./ tab-content -->
	</div><!-- ./ building_info panel -->

	<div role="tabpanel" class="tab-pane" id="images">
	<div class="tab-content padding-md">

<div class="row">
<div class="col-sm-6">
<div class="padding">

	<h3>
		{{ Lang::choice('kotoba::cms.image', 1) }}
	</h3>
	<hr>

	@if ($image != null)
		{!! Form::hidden('previous_image_id', $image->id) !!}
		<div class="thumbnail">
			<img src="<?= $image->image->url('preview') ?>" class="img-rounded">
			<div class="caption">
				<h3>
					{{ $image->image_file_name }}
				</h3>
				<p>
					{{ $image->image_file_size }}
					<br>
					{{ $image->image_content_type }}
					<br>
					{{ $image->image_updated_at }}
				</p>
			</div>
		</div>
	@else
		<img src="{{ asset('/assets/images/bld.png') }}" class="img-thumbnail" />
	@endif

</div>
</div><!-- ./ col-6 -->
<div class="col-sm-6">
<div class="padding">


	<h3>
		<i class="fa fa-file-image-o fa-fw"></i>
		{{ trans('kotoba::general.command.select_an') . '&nbsp;' . Lang::choice('kotoba::cms.image', 1) }}
	</h3>
	<hr>

	<select id="image_select" name="image_id" class="form-control chosen-select" onchange="setImage(this);">
		<option value="" label="">{{ trans('kotoba::general.command.select_an') . '&nbsp;' . Lang::choice('kotoba::cms.image', 1) }}</option>
		@foreach($get_images as $get_image)
			<option value="{{ $get_image->id }}" label="../../../system/files/images/{{ $get_image->id }}/preview/{{ $get_image->image_file_name }}">{{ $get_image->image_file_name }}</option>
		@endforeach
	</select>

	<h3 class="margin-top-xl">
		{{ Lang::choice('kotoba::cms.image', 1) }}
	</h3>

	<hr>

	<div id="imagePreview">
		<img src="" name="image-swap" />
	</div>

	<br>

{{--
	<div class="form-group">
		{!! Form::label('featured_image', Lang::choice('kotoba::cms.image', 1), ['class' => 'control-label']) !!}
		<div class="imageTarget" rel="{{ $thumbnailPath }}"></div>
		{!! Form::hidden('featured_image', Input::old('featured_image'), ['id' => 'featured_image', 'class' => 'form-control hidden']) !!}
	</div>
	<div class="form-group">
		<a class="btn btn-default btn-rect btn-grad" id="changeFeaturedImage" data-toggle="modal" data-target="#featuredImageModal">{{ trans('kotoba::general.change') }}</a>
		<a class="btn btn-metis-3 btn-rect btn-grad" id="clearFeaturedImage">{{ trans('kotoba::general.clear') }}</a>
	</div>
--}}

</div>
</div><!-- ./ col-6 -->
</div><!-- ./ row -->


	</div><!-- ./ tab-content -->
	</div><!-- ./ images panel -->

	<div role="tabpanel" class="tab-pane" id="settings">
	<div class="tab-content padding-md">

		<div class="row margin-top-lg">

			<div class="col-sm-6">

				<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-globe fa-fw"></i></span>
						<input type="text" id="website" name="website" value="{{ $site->website }}" placeholder="{{ trans('kotoba::account.website') }}" class="form-control">
				</div>
				</div>

				<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-link fa-fw"></i></span>
						<input type="text" id="slug" name="slug" value="{{ $site->slug }}" placeholder="{{ trans('kotoba::general.slug') }}" class="form-control">
				</div>
				</div>

				<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-registered fa-fw"></i></span>
						<input type="text" id="theme_slug" name="theme_slug" value="{{ $site->theme_slug }}" placeholder="{{ trans('kotoba::general.slug') }} {{ Lang::choice('kotoba::general.theme', 1) }}" class="form-control">
				</div>
				</div>

			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-google fa-fw"></i></span>
					<textarea id="google_analytics" name="google_analytics" placeholder="{{ trans('kotoba::cms.google_analytics') }}" class="form-control" rows="11">{{{ $site->google_analytics }}}</textarea>
			</div>
			</div>


			{{--
			<div class="form-group padding-bottom-xl">
				<label for="inputDivision" class="col-sm-1 control-label">{{ Lang::choice('kotoba::hr.division', 1) }}:</label>
				<div class="col-sm-11">
					{!!
						Form::select(
							'division_id',
							$divisions,
							$site->division_id,
							array(
								'class' => 'form-control chosen-select'
							)
						)
					!!}
				</div>
			</div>
			--}}

		</div>

		<div class="col-sm-6">

			<div class="form-group padding-bottom-xl">
				<label for="lea_id" class="col-sm-1 control-label">{{ trans('kotoba::hr.lea') }}&nbsp;{{ Lang::choice('kotoba::general.id', 1) }}:</label>
				<div class="col-sm-11">
						<input type="text" id="lea_id" name="lea_id" value="{{ $site->lea_id }}" placeholder="{{ trans('kotoba::hr.lea_id') }} {{ Lang::choice('kotoba::general.id', 1) }}" class="form-control">
				</div>
			</div>

			<div class="form-group padding-bottom-xl">
				<label for="asset_management_name" class="col-sm-3 control-label">{{ Lang::choice('kotoba::shop.asset', 1) }}&nbsp;{{ trans('kotoba::general.management') }}&nbsp;{{ trans('kotoba::general.name') }}:</label>
				<div class="col-sm-9">
						<input type="text" id="asset_management_name" name="asset_management_name" value="{{ $site->asset_management_name }}" placeholder="{{ Lang::choice('kotoba::shop.asset', 1) }}&nbsp;{{ trans('kotoba::general.management') }}&nbsp;{{ trans('kotoba::general.name') }}" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="status_id" class="col-sm-1 control-label">{{ Lang::choice('kotoba::general.status', 1) }}:</label>
				<div class="col-sm-11">
					{!!
						Form::select(
							'status_id',
							$statuses,
							$site->status_id,
							array(
								'class' => 'form-control chosen-select'
							)
						)
					!!}
				</div>
			</div>

		</div>

		</div><!-- ./ row -->

	</div><!-- ./ tab-content -->
	</div><!-- ./ settings panel -->

</div><!-- ./ tab panes -->



<div class="form-group">
	<input class="btn btn-success btn-block" type="submit" value="{{ trans('kotoba::button.save') }}">
</div>

<div class="row">
<div class="col-sm-4">
	<a href="/admin/sites/{{ $site->id }}" class="btn btn-default btn-block" title="{{ trans('kotoba::button.cancel') }}">
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
